<?php

namespace App\Livewire;

use App\Models\Products as ModelsProducts;
use App\Models\ProductsCategorys;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class Products extends Component
{

    use WithFileUploads;

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
    public $imagePath;

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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:8192',
            'qty' => 'nullable|max:10',
        ];
    }

    protected function messages()
    {
        return [
            'name.required' => 'O campo nome não pode estar vazio.',
            'name.string' => 'O nome deve ser um texto válido.',
            'name.max' => 'O nome não pode ter mais de 255 caracteres.',

            'price.required' => 'O campo preço é obrigatório.',
            'price.string' => 'O preço deve ser um valor válido.',
            'price.max' => 'O preço não pode ter mais de 10 caracteres.',

            'description.string' => 'A descrição deve ser um texto válido.',
            'description.max' => 'A descrição não pode ter mais de 255 caracteres.',

            'image.image' => 'O arquivo enviado deve ser uma imagem.',
            'image.mimes' => 'Formato inválido. Apenas JPEG, PNG, JPG, GIF e WEBP são permitidos.',
            'image.max'   => 'A imagem não pode ter mais que 8MB.',

            'qty.max' => 'A quantidade não pode ter mais de 10 caracteres.',
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
            ->first();

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
            $imagePath = $this->image ? $this->image->store('products', 'public') : 'img/no-photo.png';

            if (!$this->category) {
                throw new \Exception('Categoria não encontrada.');
            }

            $product = new ModelsProducts();
            $product->fill([
                'name'        => $this->name,
                'id_shop'     => $shop->id,
                'id_category' => $this->category->id,
                'price'       => $this->formatPrice($this->price),
                'description' => $this->description,
                'qty'         => $this->qty,
                'image'       => $imagePath,
            ]);

            $product->save();

            $this->loadData();
            $this->reset(['name', 'price', 'description', 'qty', 'image']);
            $this->closeModal();
            $this->dispatch('productAdded');
        } catch (\Exception $e) {
            $this->addError('general', 'Erro ao salvar produto. Tente novamente.');
        }
    }

    public function openEditModal($productId)
    {
        $product = ModelsProducts::findOrFail($productId);

        $this->productIdToEdit = $product->id;
        $this->name = $product->name;
        $this->price = $product->price;
        $this->qty = $product->qty;
        $this->description = $product->description;
        $this->imagePath = $product->image;

        $this->showEditModal = true;
    }

    public function closeEditModal()
    {
        $this->showEditModal = false;
        $this->reset(['productIdToEdit', 'name', 'description', 'price', 'image']);
    }

    public function update()
    {
        $this->validate();

        $product = ModelsProducts::findOrFail($this->productIdToEdit);

        // Verifica se um novo arquivo de imagem foi enviado
        if ($this->image) {
            // Deleta a imagem antiga se não for a padrão
            if ($product->image && $product->image !== 'img/no-photo.png') {
                Storage::disk('public')->delete($product->image);
            }

            // Armazena a nova imagem e obtém o caminho
            $imagePath = $this->image->store('products', 'public');
        } else {
            // Mantém a imagem existente
            $imagePath = $product->image;
        }

        $product->update([
            'name'        => $this->name,
            'price'       => $this->formatPrice($this->price),
            'description' => $this->description,
            'qty'         => $this->qty,
            'image'       => $imagePath,
        ]);

        $this->closeEditModal();
        $this->dispatch('productUpdated');
    }

    // Modal de exclusão
    public function openDeleteModal($productId)
    {
        $this->productIdToDelete = $productId;
        $this->showDeleteModal = true;
    }

    public function closeDeleteModal()
    {
        $this->showDeleteModal = false;
        $this->reset(['productIdToDelete', 'name', 'description', 'price', 'image']);
    }

    public function delete()
    {
        $product = ModelsProducts::findOrFail($this->productIdToDelete);

        // Tenta deletar imagem do produto
        if ($product->image) {
            if (Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            } else {
                Log::warning('Imagem não encontrada no storage: ' . $product->image);
            }
        }

        $product->delete();

        $this->closeDeleteModal();
        $this->dispatch('productDeleted');
    }

    private function formatPrice($value)
    {
        // Remove espaços em branco
        $value = trim($value);

        // Remove símbolos monetários (R$, $, etc.)
        $value = preg_replace('/[^\d,\.]/', '', $value);

        // Se contiver vírgula, assume que é separador decimal e substitui por ponto
        if (str_contains($value, ',')) {
            $value = str_replace('.', '', $value); // Remove separadores de milhar (ponto)
            $value = str_replace(',', '.', $value); // Substitui vírgula por ponto
        }

        // Garante que seja um número válido e converte para float com 2 casas decimais
        return number_format((float) $value, 2, '.', '');
    }
}
