<?php

namespace App\Livewire;

use App\Models\Customer;
use App\Rules\CpfRule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Customers extends Component
{

    public $name;
    public $cpf;
    public $phone;
    public $email;
    public $address;
    public $number;
    public $city;
    public $showModal = false;
    public $showEditModal = false;
    public $showDeleteModal = false;
    public $customerIdToEdit;
    public $customerIdToDelete;
    public $search = ''; // Propriedade para o campo de busca

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'cpf' => ['nullable', new CpfRule()],
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string|max:255',
            'number' => 'nullable|string|max:10',
            'city' => 'nullable|string|max:100',
        ];
    }

    protected function messages()
    {
        return [
            'name.required' => 'O campo nome não pode estar vazio.',
            'name.string' => 'O nome deve ser um texto válido.',
            'name.max' => 'O nome não pode ter mais de 255 caracteres.',
            'email.email' => 'O e-mail informado não é válido.',
            'address.max' => 'O endereço não pode ter mais de 255 caracteres.',
            'number.max' => 'O número não pode ter mais de 10 caracteres.',
            'city.max' => 'A cidade não pode ter mais de 100 caracteres.',
        ];
    }

    protected $listeners = [
        'customerAdded' => '$refresh',
        'customerUpdated' => '$refresh',
        'customerDeleted' => '$refresh',
    ];

    public function render()
    {
        $user = Auth::user();
        $shop = $user->shop;

        //Filtra clientes do shop do usuário
        $customers = Customer::where('id_shop', $shop->id)
            ->when($this->search, function ($query) {
                $searchTerm = '%' . $this->search . '%';
                // Usa uma função SQL para ignorar acentos (MySQL/PostgreSQL)
                $query->whereRaw("LOWER(name) LIKE LOWER(?)", [$searchTerm]);
            })
            ->get();

        return view('livewire.customers', [
            'customers' => $customers,
        ]);
    }

    public function openModal()
    {
        $this->reset(['name', 'cpf', 'phone', 'email', 'address', 'number', 'city']);
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function save()
    {
        Log::info('Iniciando save', [
            'name' => $this->name,
            'cpf' => $this->cpf,
            'phone' => $this->phone,
            'email' => $this->email,
            'address' => $this->address,
            'number' => $this->number,
            'city' => $this->city,
        ]);


        Log::info('Antes da validação');
        $this->validate();
        Log::info('Validação concluída');

        $shop = Auth::user()->shop;
        if (!$shop) {
            Log::error('Shop não encontrado para o usuário', ['user_id' => Auth::user()->id]);
            $this->addError('general', 'Nenhuma loja associada ao usuário.');
            return;
        }

        Log::info('Shop obtido', ['shop_id' => $shop->id]);

        $cleanCpf = $this->cpf ? preg_replace('/[^0-9]/', '', $this->cpf) : null;

        try {
            $customer = Customer::create([
                'name' => $this->name,
                'id_shop' => $shop->id,
                'cpf' => $cleanCpf,
                'phone' => $this->phone,
                'email' => $this->email,
                'address' => $this->address,
                'number' => $this->number,
                'city' => $this->city,
            ]);
            Log::info('Cliente criado', ['id' => $customer->id]);

            $this->closeModal();
            $this->dispatch('customerAdded');
        } catch (\Exception $e) {
            Log::error('Erro ao salvar cliente', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            $this->addError('general', 'Erro ao salvar cliente: ' . $e->getMessage());
        }
    }

    // Modal de exclusão
    public function openDeleteModal($customerId)
    {
        $this->customerIdToDelete = $customerId;
        $this->showDeleteModal = true;
    }

    public function closeDeleteModal()
    {
        $this->showDeleteModal = false;
        $this->reset(['customerIdToDelete']);
    }

    public function delete()
    {
        $customer = Customer::findOrFail($this->customerIdToDelete);
        $customer->delete();

        $this->closeDeleteModal();
        $this->dispatch('customerDeleted');
    }

    public function openEditModal($customerId)
    {
        $this->showEditModal = true;
        $customer = Customer::findOrFail($customerId);
        $this->customerIdToEdit = $customer->id;
        $this->name = $customer->name;
        $this->cpf = $customer->cpf;
        $this->phone = $customer->phone;
        $this->email = $customer->email;
        $this->address = $customer->address;
        $this->number = $customer->number;
        $this->city = $customer->city;
    }

    public function closeEditModal()
    {
        $this->showEditModal = false;
        $this->reset(['customerIdToEdit', 'name', 'cpf', 'phone', 'email', 'address', 'number', 'city']);
    }

    public function update()
    {
        $this->validate();

        $customer = Customer::findOrFail($this->customerIdToEdit);
        $customer->update([
            'name' => $this->name,
            'cpf' => $this->cpf,
            'phone' => $this->phone,
            'email' => $this->email,
            'address' => $this->address,
            'number' => $this->number,
            'city' => $this->city,
        ]);

        $this->closeEditModal();
        $this->dispatch('customerUpdated');
    }
}
