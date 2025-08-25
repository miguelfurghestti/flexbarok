<?php

namespace App\Livewire;

use App\Models\Order;
use App\Models\OrderProducts;
use App\Models\Products;
use App\Models\ProductsCategorys;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Orders extends Component
{
    use WithPagination;

    // Propriedades para listagem
    public $search = '';
    public $statusFilter = '';
    public $quickStatusFilter = '';

    // Contadores de status
    public $openCount = 0;
    public $closedCount = 0;
    public $cancelledCount = 0;

    // Paginação
    public $perPage = 20;

    // Propriedades para modal de comanda
    public $showOrderModal = false;
    public $showAddProductModal = false;
    public $currentOrder = null;

    // Propriedades para nova comanda
    public $newOrderName = '';
    public $newOrderNumber = '';

    // Propriedades para adicionar produto
    public $selectedProduct = '';
    public $productQuantity = 1;
    public $productNotes = '';
    public $selectedCategory = '';

    protected $listeners = [
        'orderUpdated' => '$refresh',
        'productAddedToOrder' => 'loadOrderProducts',
    ];

    public function mount()
    {
        // Os dados serão carregados automaticamente pelo método render()
    }

    public function openNewOrder()
    {
        $this->reset(['newOrderName', 'newOrderNumber']);
        $this->showOrderModal = true;
    }

    public function createOrder()
    {
        $this->validate([
            'newOrderName' => 'required|string|max:255',
            'newOrderNumber' => 'nullable|string|max:50',
        ]);

        $user = Auth::user();
        $shop = $user->shop;

        if (!$shop) {
            session()->flash('error', 'Nenhuma loja associada ao usuário.');
            return;
        }

        try {
            $order = new Order();
            $order->order_number = $this->newOrderNumber ?: 'CMD-' . time();
            $order->order_owner_name = $this->newOrderName;
            $order->id_shop = $shop->id;
            $order->status = 'open';
            $order->opened_at = now();
            $order->total_amount = 0;
            $order->save();

            $this->showOrderModal = false;
            session()->flash('success', 'Comanda criada com sucesso!');
        } catch (\Exception $e) {
            session()->flash('error', 'Erro ao criar comanda. Tente novamente.');
        }
    }

    public function openOrder($orderId)
    {
        $this->currentOrder = Order::with('products.product')->findOrFail($orderId);
        $this->showOrderModal = true;
    }

    public function openAddProductModal()
    {
        $this->reset(['selectedProduct', 'productQuantity', 'productNotes', 'selectedCategory']);
        $this->showAddProductModal = true;
    }

    public function addProductToOrder()
    {
        $this->validate([
            'selectedProduct' => 'required|exists:products,id',
            'productQuantity' => 'required|integer|min:1',
        ]);

        if (!$this->currentOrder) {
            return;
        }

        $product = Products::find($this->selectedProduct);
        $user = Auth::user();
        $shop = $user->shop;

        try {
            $orderProduct = new OrderProducts();
            $orderProduct->id_order = $this->currentOrder->id;
            $orderProduct->id_shop = $shop->id;
            $orderProduct->id_product = $product->id;
            $orderProduct->quantity = $this->productQuantity;
            $orderProduct->unit_price = $product->price;
            $orderProduct->notes = $this->productNotes;
            $orderProduct->save();

            // Atualizar total da comanda
            $this->currentOrder->total_amount = $this->currentOrder->calculateTotal();
            $this->currentOrder->save();

            $this->showAddProductModal = false;
            session()->flash('success', 'Produto adicionado com sucesso!');
        } catch (\Exception $e) {
            session()->flash('error', 'Erro ao adicionar produto. Tente novamente.');
        }
    }

    public function updateProductQuantity($orderProductId, $action)
    {
        $orderProduct = OrderProducts::findOrFail($orderProductId);

        if ($action === 'increase') {
            $orderProduct->quantity++;
        } elseif ($action === 'decrease' && $orderProduct->quantity > 1) {
            $orderProduct->quantity--;
        }

        $orderProduct->save();

        // Atualizar total da comanda
        $this->currentOrder->total_amount = $this->currentOrder->calculateTotal();
        $this->currentOrder->save();

        session()->flash('success', 'Quantidade atualizada com sucesso!');
    }

    public function removeProductFromOrder($orderProductId)
    {
        try {
            $orderProduct = OrderProducts::findOrFail($orderProductId);
            $orderProduct->delete();

            // Atualizar total da comanda
            $this->currentOrder->total_amount = $this->currentOrder->calculateTotal();
            $this->currentOrder->save();

            session()->flash('success', 'Produto removido com sucesso!');
        } catch (\Exception $e) {
            session()->flash('error', 'Erro ao remover produto. Tente novamente.');
        }
    }

    public function closeOrder()
    {
        if (!$this->currentOrder) {
            return;
        }

        try {
            $this->currentOrder->status = 'closed';
            $this->currentOrder->closed_at = now();
            $this->currentOrder->save();

            $this->showOrderModal = false;
            session()->flash('success', 'Comanda fechada com sucesso!');
        } catch (\Exception $e) {
            session()->flash('error', 'Erro ao fechar comanda. Tente novamente.');
        }
    }

    public function cancelOrder()
    {
        if (!$this->currentOrder) {
            return;
        }

        try {
            $this->currentOrder->status = 'cancelled';
            $this->currentOrder->closed_at = now();
            $this->currentOrder->save();

            $this->showOrderModal = false;
            session()->flash('success', 'Comanda cancelada com sucesso!');
        } catch (\Exception $e) {
            session()->flash('error', 'Erro ao cancelar comanda. Tente novamente.');
        }
    }

    public function reopenOrder()
    {
        if (!$this->currentOrder) {
            return;
        }

        try {
            $this->currentOrder->status = 'open';
            $this->currentOrder->closed_at = null;
            $this->currentOrder->save();

            session()->flash('success', 'Comanda reaberta com sucesso!');
        } catch (\Exception $e) {
            session()->flash('error', 'Erro ao reabrir comanda. Tente novamente.');
        }
    }

    public function reopenOrderFromList($orderId)
    {
        try {
            $order = Order::findOrFail($orderId);
            $order->status = 'open';
            $order->closed_at = null;
            $order->save();

            session()->flash('success', 'Comanda reaberta com sucesso!');
        } catch (\Exception $e) {
            session()->flash('error', 'Erro ao reabrir comanda. Tente novamente.');
        }
    }

    public function closeModal()
    {
        $this->showOrderModal = false;
        $this->showAddProductModal = false;
        $this->currentOrder = null;
        $this->reset(['newOrderName', 'newOrderNumber', 'selectedProduct', 'productQuantity', 'productNotes', 'selectedCategory']);
    }

    public function closeAddProductModal()
    {
        $this->showAddProductModal = false;
        $this->reset(['selectedProduct', 'productQuantity', 'productNotes', 'selectedCategory']);
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedStatusFilter()
    {
        $this->resetPage();
    }

    public function filterByStatus($status)
    {
        $this->quickStatusFilter = $status;
        $this->statusFilter = ''; // Limpar filtro do select
        $this->resetPage();
    }

    public function clearQuickFilter()
    {
        $this->quickStatusFilter = '';
        $this->resetPage();
    }

    public function updatedSelectedCategory()
    {
        $this->selectedProduct = '';
    }

    public function onCategoryChange()
    {
        $this->selectedProduct = '';
    }

    public function render()
    {
        $user = Auth::user();
        $shop = $user->shop;

        if (!$shop) {
            return view('livewire.orders', [
                'orders' => collect(),
                'categories' => collect(),
                'products' => collect()
            ]);
        }

        $query = Order::byShop($shop->id);

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('order_number', 'like', '%' . $this->search . '%')
                    ->orWhere('order_owner_name', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->statusFilter) {
            $query->where('status', $this->statusFilter);
        }

        if ($this->quickStatusFilter) {
            $query->where('status', $this->quickStatusFilter);
        }

        $orders = $query->orderBy('created_at', 'desc')->paginate($this->perPage);

        // Carregar contadores de status
        $this->openCount = Order::byShop($shop->id)->where('status', 'open')->count();
        $this->closedCount = Order::byShop($shop->id)->where('status', 'closed')->count();
        $this->cancelledCount = Order::byShop($shop->id)->where('status', 'cancelled')->count();

        $categories = ProductsCategorys::where('id_shop', $shop->id)->get();

        return view('livewire.orders', [
            'orders' => $orders,
            'categories' => $categories,
            'products' => collect()
        ]);
    }
}
