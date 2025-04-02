<div>
    <div class="flex flex-row justify-between">
        <h1 class="text-white text-2xl font-['Open Sans']">{{ $category->name }}</h1>
        <button wire:click="openModal" class="bg-pgreen flex flex-row gap-2 px-3 py-2 rounded-full items-center font-['Open Sans'] font-bold text-sm select-none">
            Cadastrar Produto
        </button>
    </div>

    <!-- Lista de Produtos -->
    <div class="flex flex-col w-full gap-2 rounded-lg">
        @if($products->isEmpty())
        <div class="text-center text-lg mt-4 text-gray-500">
            Nenhum produto encontrado!
        </div>
        @else
        <div class="grid 2xl:grid-cols-6 xl:grid-cols-4 sm:grid-cols-2 gap-4 mt-4">
            @foreach($products as $product)
            <div class="bg-white p-3 flex flex-col gap-2 items-center text-white justify-between">
                <img class="h-48 w-96 object-cover" 
     src="{{ $product->image === 'img/no-photo.png' ? asset('img/' . 'no-photo.png') : asset('storage/' . $product->image) }}" 
     alt="{{ $product->name }}">

                <h1 class="text-black font-semibold text-lg">{{ $product->name }}</h1>
                <div class="flex flex-row gap-3">
                    <span class="text-black">R$ {{ $product->price }}</span>
                    <span class="text-black">Estoque: {{ $product->qty }}</span>
                </div>  
                <div class="flex flex-row gap-3">
                    <button wire:click="save" class="bg-blue-400 text-blue-950 text-sm p-2 hover:bg-white transition">Editar</button>
                    <button wire:click="closeModal" class="bg-red-400 text-red-950 text-sm p-2 hover:bg-white transition">Excluir</button>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>

    <!-- Modal de Cadastro -->
    @if($showModal)
    <div class="fixed inset-0 bg-black bg-opacity-70 backdrop-blur-sm flex items-center justify-center z-50">
        <div class="bg-zinc-900 p-6 rounded-xl shadow-xl text-center flex flex-col items-center w-96">
            <h2 class="text-lg font-semibold mb-3 text-white flex flex-row gap-2 items-center">
                Cadastrar Produto
            </h2>
            <p class="text-zinc-400 text-sm mb-3">Preencha os dados e cadastre o produto</p>

            <div class="flex flex-col gap-3 w-full">
                <div class="flex flex-col w-full gap-1">
                    <input type="text" name="name" wire:model="name" placeholder="Nome do Produto" class="rounded-md p-2 text-black text-sm" required>
                    @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>

                <div class="flex flex-row w-full gap-2 justify-between">
                    <div class="flex flex-col w-auto">
                        <label for="price" class="flex mb-2 text-sm font-medium text-gray-900 dark:text-white">Preço</label>
                        <input type="text" name="price" wire:model="price" value="{{ old('price') }}" placeholder="Preço" class="rounded-md p-2 w-36 text-sm">
                        @error('price') <span class="text-red-900 text-sm border bg-red-300 border-red-700 p-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex flex-col w-full">
                        <label for="qty" class="flex mb-2 text-sm font-medium text-gray-900 dark:text-white">Estoque</label>
                        <input type="text" name="qty" wire:model="qty" value="{{ old('qty') }}" placeholder="Quantidade" class="rounded-md p-2 w-full text-sm">
                        @error('qty') <span class="text-red-900 text-sm border bg-red-300 border-red-700 p-1">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="flex flex-col w-full gap-1">
                    <label for="description" class="flex mb-2 text-sm font-medium text-gray-900 dark:text-white">Descrição</label>
                    <textarea id="description" name="description" wire:model="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300" placeholder="Digite a descrição do produto..."></textarea>
                    @error('description') <span class="text-red-500">{{ $message }}</span> @enderror

                </div>

                <div class="flex flex-col w-full gap-1">
                    <label for="image" class="flex mb-2 text-sm font-medium text-gray-900 dark:text-white">Foto do produto</label>
                    <input name="image" wire:model="image" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="file_input_help" id="image" type="file">
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">SVG, PNG, JPG or GIF (MAX. 800x400px).</p>
                    @error('image') <span class="text-red-500">{{ $message }}</span> @enderror
                    
                </div>

            </div>

            <div class="flex flex-row gap-3 mt-3">
                <button wire:click="closeModal" class="bg-red-400 text-black px-4 py-2 rounded-lg hover:bg-white transition">Cancelar</button>
                <button wire:click="save" class="bg-pgreen text-black px-4 py-2 rounded-lg hover:bg-white transition">Cadastrar</button>
            </div>
        </div>
    </div>
    @endif