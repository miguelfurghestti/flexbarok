<div>
    <!-- Botão para abrir o modal -->
    <div class="flex flex-row justify-between">
        <h1 class="text-white text-2xl font-['Open Sans']">{{ $category->name }}</h1>
        <button  class="bg-pgreen flex flex-row gap-2 px-3 py-2 rounded-full items-center font-['Open Sans'] font-bold text-sm select-none">
            Cadastrar Produto
        </button>
    </div>

    <!-- Lista de Quadras -->
    <div class="flex flex-col gap-3 mt-4">
        {{ $products }}
    </div>

    
</div>