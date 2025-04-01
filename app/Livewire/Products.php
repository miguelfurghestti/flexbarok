<?php

namespace App\Livewire;

use App\Models\Products as ModelsProducts;
use App\Models\ProductsCategorys;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Products extends Component
{
    public $slug;
    public $category;
    public $products = [];

    public function mount($slug)
    {
        $this->slug = $slug;
        $this->loadData();
    }

    public $name;
    public $image;
    public $description;
    public $price;
    public $qty;

    public $showModal = false;
    public $showEditModal = false;
    public $showDeleteModal = false;

    public $productIdToEdit;
    public $productIdToDelete;

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'price' => 'required|string|max:10',
            'description' => 'nullable|string|max:255',
            'image' => 'nullable|string|max:255',
            'qty' => 'nullable|string|max:10',
        ];
    }

    protected $listeners = [
        'productAdded' => '$refresh',
        'productUpdated' => '$refresh',
        'productDeleted' => '$refresh',
    ];


    public function loadData()
    {
        $user = Auth::user();
        $shop = $user->shop;
        // Buscar a categoria pelo slug
        $this->category = ProductsCategorys::where('slug', $this->slug)
            ->where('id_shop', $shop->id)
            ->first(); // Usar first() em vez de firstOrFail() para evitar exceção

        // Se a categoria não for encontrada, encerra a função
        if (!$this->category) {
            session()->flash('error', 'Categoria não encontrada.');
            return;
        }

        // Buscar produtos relacionados à categoria
        $this->products = ModelsProducts::where('id_category', $this->category->id)
            ->where('id_shop', $shop->id)
            ->get();
    }

    public function render()
    {
        return view('livewire.products');
    }

    public function openModal()
    {
        $this->reset(['name', 'description', 'price', 'image']);
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function save()
    {
        $this->validate();

        $shop = Auth::user()->shop;
        if (!$shop) {
            $this->addError('general', 'Nenhuma loja associada ao usuário.');
            return;
        }

        try {
            $product = ModelsProducts::create([
                'name' => $this->name,
                'id_shop' => $shop->id,
                'id_category' => $this->category,
                'price' => $this->price,
                'description' => $this->description,
                'qty' => $this->qty,
                'image' => $this->image,
            ]);

            $this->closeModal();
            $this->dispatch('productAdded');
        } catch (\Exception $e) {
            $this->addError('general', 'Erro ao salvar cliente: ' . $e->getMessage());
        }
    }
}
