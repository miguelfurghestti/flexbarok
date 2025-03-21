<?php

namespace App\Livewire;

use Livewire\Component;

class Products extends Component
{
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

    public function render()
    {
        return view('livewire.products');
    }
}