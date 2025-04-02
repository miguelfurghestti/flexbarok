<?php

namespace App\Livewire;

use App\Models\ProductsCategorys;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class ProductCategories extends Component
{

    public $name;
    public $icon;
    public $showModal = false;
    public $showEditModal = false;
    public $showDeleteModal = false;
    public $productCategoryIdToEdit;
    public $productCategoryIdToDelete;

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'icon' => 'required',
        ];
    }

    protected function messages()
    {
        return [
            'name.required' => 'O campo nome não pode estar vazio.',
            'name.string' => 'O nome deve ser um texto válido.',
            'name.max' => 'O nome não pode ter mais de 255 caracteres.',
            'icon.required' => 'O ícone é obrigatório.',
        ];
    }

    protected $listeners = [
        'productCategoryAdded' => '$refresh',
        'productCategoryUpdated' => '$refresh',
        'productCategoryDeleted' => '$refresh',
    ];

    public function render()
    {
        $user = Auth::user();
        $shop = $user->shop;

        $productCategorys = ProductsCategorys::where('id_shop', $shop->id)->get();

        return view('livewire.product-categories', compact('productCategorys'));
    }

    public function openModal()
    {
        $this->reset(['name', 'icon']);
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
            $productCategory = ProductsCategorys::create([
                'name' => $this->name,
                'icon' => $this->icon,
                'id_shop' => $shop->id,
            ]);

            $this->closeModal();
            $this->dispatch('productCategoryAdded');
        } catch (\Exception $e) {
            $this->addError('general', 'Erro ao salvar cliente: ' . $e->getMessage());
        }
    }

    public function openEditModal($productCategoryId)
    {
        $this->showEditModal = true;
        $productCategory = ProductsCategorys::findOrFail($productCategoryId);
        $this->productCategoryIdToEdit = $productCategory->id;
        $this->name = $productCategory->name;
        $this->icon = $productCategory->icon;
    }

    public function closeEditModal()
    {
        $this->showEditModal = false;
        $this->reset(['productCategoryIdToEdit', 'name', 'icon']);
    }

    public function update()
    {
        $this->validate();

        $productCategory = ProductsCategorys::findOrFail($this->productCategoryIdToEdit);
        $productCategory->update([
            'name' => $this->name,
            'icon' => $this->icon,
        ]);

        $this->closeEditModal();
        $this->dispatch('productCategoryUpdated');
    }

    // Modal de exclusão
    public function openDeleteModal($productCategoryId)
    {
        $this->productCategoryIdToDelete = $productCategoryId;
        $this->showDeleteModal = true;
    }

    public function closeDeleteModal()
    {
        $this->showDeleteModal = false;
        $this->reset(['productCategoryIdToDelete']);
    }

    public function delete()
    {
        $productCategory = ProductsCategorys::findOrFail($this->productCategoryIdToDelete);

        // Percorre todos os produtos da categoria
        foreach ($productCategory->products as $product) {
            if ($product->image) {
                Log::info('Tentando excluir imagem: ' . $product->image);
                if (Storage::disk('public')->exists($product->image)) {
                    Storage::disk('public')->delete($product->image);
                    Log::info('Imagem excluída: ' . $product->image);
                } else {
                    Log::warning('Imagem não encontrada no storage: ' . $product->image);
                }
            }
        }

        $productCategory->delete();

        $this->closeDeleteModal();
        $this->dispatch('productCategoryDeleted');
    }
}
