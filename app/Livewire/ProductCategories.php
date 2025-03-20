<?php

namespace App\Livewire;

use App\Models\ProductsCategorys;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
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

        $categorys = ProductsCategorys::where('id_shop', $shop->id)->get();

        return view('livewire.product-categories', compact('categorys'));
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
}
