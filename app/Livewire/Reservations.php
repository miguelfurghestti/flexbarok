<?php

namespace App\Livewire;

use App\Models\Court;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Reservations extends Component
{
    public $owner_name;
    public $id_court;
    public $date;
    public $use_grill;
    public $status;

    public $showModal = false;
    public $showEditModal = false;
    public $showDeleteModal = false;

    public $reservationIdToEdit;
    public $reservationIdToDelete;

    protected function rules()
    {
        return [
            'owner_name' => 'required|string|max:255',
            'id_court'   => 'required|integer|exists:courts,id',
            'date'       => 'required|date|after_or_equal:today',
            'use_grill'  => 'required|boolean',
            'status'     => 'required|string|in:pendente,confirmado,cancelado',
        ];
    }

    protected function messages()
    {
        return [
            'owner_name.required' => 'O campo nome não pode estar vazio.',
            'owner_name.string'   => 'O nome deve ser um texto válido.',
            'owner_name.max'      => 'O nome não pode ter mais de 255 caracteres.',

            'id_court.required'   => 'É necessário selecionar uma quadra.',
            'id_court.integer'    => 'O ID da quadra deve ser um número inteiro.',
            'id_court.exists'     => 'A quadra selecionada não existe.',

            'date.required'       => 'A data da reserva é obrigatória.',
            'date.date'           => 'O campo data deve ser uma data válida.',
            'date.after_or_equal' => 'A data deve ser hoje ou uma data futura.',

            'use_grill.required'  => 'Informe se deseja utilizar a churrasqueira.',
            'use_grill.boolean'   => 'O valor deve ser 0 (Não) ou 1 (Sim).',

            'status.required'     => 'O campo status é obrigatório.',
            'status.string'       => 'O status deve ser um texto válido.',
            'status.in'           => 'O status deve ser: pendente, confirmado ou cancelado.',
        ];
    }

    protected $listeners = [
        'reservationAdded'   => '$refresh',
        'reservationUpdated' => '$refresh',
        'reservationDeleted' => '$refresh',
    ];

    public function mount()
    {
        $this->date = now()->format('Y-m-d');
    }


    public function render()
    {
        $user = Auth::user();
        $shop = $user->shop;

        $reservations = Reservation::where('id_shop', $shop->id)->get();
        $courts = Court::where('id_shop', $shop->id)->get();

        return view('livewire.reservations', compact('reservations', 'courts'));
    }

    //Modal de Agendamento
    public function openModal()
    {
        $this->reset(['owner_name', 'id_court', 'date', 'use_grill', 'status']);
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

            $reservation = new Reservation();
            $reservation->fill([
                'owner_name' => $this->owner_name,
                'id_shop' => $shop->id,
                'id_court' => $this->id_court,
                'date' => $this->date,
                'use_grill' => $this->use_grill,
                'status' => $this->status,
            ]);

            dd($reservation);

            // $reservation->save();

            $this->reset(['owner_name', 'id_court', 'date', 'use_grill', 'status']);
            $this->closeModal();
            $this->dispatch('reservationAdded');
        } catch (\Exception $e) {
            $this->addError('general', 'Erro ao agendar a reserva. Tente novamente.');
        }
    }
}
