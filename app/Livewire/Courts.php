<?php

namespace App\Livewire;

use App\Models\Court;
use App\Models\Sport;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Courts extends Component
{
    public $name;
    public $id_sport;
    public $showModal = false;
    public $showEditModal = false;
    public $showDeleteModal = false;
    public $courtIdToEdit;
    public $courtIdToDelete;

    protected $rules = [
        'name' => 'required|string|max:255',
        'id_sport' => 'required',
    ];

    protected $listeners = [
        'courtAdded' => '$refresh',
        'courtUpdated' => '$refresh',
        'courtDeleted' => '$refresh',
    ];

    public function render()
    {
        $user = Auth::user();
        $shop = $user->shop;
        $sports = Sport::all();
        $courts = Court::where('id_shop', $shop->id)->get();

        return view('livewire.courts', compact('courts', 'sports'));
    }

    public function openModal()
    {
        $this->reset(['name', 'id_sport']);
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

        Court::create([
            'name' => $this->name,
            'id_shop' => $shop->id,
            'id_sport' => $this->id_sport,
            'status' => 'ativa',
        ]);

        $this->closeModal();
        $this->dispatch('courtAdded');
    }

    public function openEditModal($courtId)
    {
        $this->showEditModal = true;
        $court = Court::findOrFail($courtId);
        $this->courtIdToEdit = $court->id;
        $this->name = $court->name;
        $this->id_sport = $court->id_sport;
    }

    public function closeEditModal()
    {
        $this->showEditModal = false;
        $this->reset(['courtIdToEdit', 'name', 'id_sport']);
    }

    public function update()
    {
        $this->validate();

        $court = Court::findOrFail($this->courtIdToEdit);
        $court->update([
            'name' => $this->name,
            'id_sport' => $this->id_sport,
        ]);

        $this->closeEditModal();
        $this->dispatch('courtUpdated');
    }

    // Modal de exclusão
    public function openDeleteModal($courtId)
    {
        $this->courtIdToDelete = $courtId;
        $this->showDeleteModal = true;
    }

    public function closeDeleteModal()
    {
        $this->showDeleteModal = false;
        $this->reset(['courtIdToDelete']);
    }

    public function delete()
    {
        $court = Court::findOrFail($this->courtIdToDelete);
        $court->delete();

        $this->closeDeleteModal();
        $this->dispatch('courtDeleted');
    }
}
