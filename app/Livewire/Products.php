<?php

namespace App\Livewire;

use App\Models\Products as ModelsProducts;
use App\Models\ProductsCategorys;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
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
            'image' => 'nullable|image|max:8192',
            'qty' => 'nullable|string|max:10',
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

            'image.image' => 'O arquivo deve ser uma imagem válida.',
            'image.max' => 'A imagem não pode ter mais de 8MB.',

            'qty.string' => 'A quantidade deve ser um valor válido.',
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
        Log::info('Iniciando método save()');

        $this->validate();
        Log::info('Validação concluída');

        $shop = Auth::user()->shop;

        if (!$shop) {
            Log::error('Erro: Nenhuma loja associada ao usuário.');
            $this->addError('general', 'Nenhuma loja associada ao usuário.');
            return;
        }

        try {
            Log::info('Salvando imagem...');
            $imagePath = null;
            if ($this->image) {
                $imagePath = $this->image->store('products', 'public');
            }

            Log::info('Criando produto no banco de dados...');
            Log::info('Categoria carregada', ['category' => $this->category]);
            $product = ModelsProducts::create([
                'name' => $this->name,
                'id_shop' => $shop->id,
                'id_category' => $this->category->id ?? null,
                'price' => $this->price,
                'description' => $this->description,
                'qty' => $this->qty,
                'image' => $imagePath,
            ]);

            Log::info('Produto criado com sucesso: ', ['id' => $product->id]);

            $this->loadData();

            $this->reset(['name', 'price', 'description', 'qty', 'image']);

            $this->closeModal();
            $this->dispatch('productAdded');
        } catch (\Exception $e) {
            Log::error('Erro ao salvar produto: ' . $e->getMessage());
            $this->addError('general', 'Erro ao salvar produto: ' . $e->getMessage());
        }
    }
}
