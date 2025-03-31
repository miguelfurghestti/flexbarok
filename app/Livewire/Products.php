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
            'price' => 'required',
        ];
    }

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
        $this->reset(['name', 'description', 'price',]);
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }
}
