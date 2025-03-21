<div>
    <!-- Botão para abrir o modal -->
    <div class="flex flex-row justify-between">
        <h1 class="text-white text-2xl font-['Open Sans']">Selecione a Categoria</h1>
        <button wire:click="openModal" class="bg-pgreen flex flex-row gap-2 px-3 py-2 rounded-full items-center font-['Open Sans'] font-bold text-sm select-none">
            Cadastrar Categoria
        </button>
    </div>

    <!-- Lista de Quadras -->
    <div class="grid grid-cols-4 gap-4 mt-4">

        @if($productCategorys->isEmpty())
            <div class="text-center text-lg mt-4 text-gray-500">
                Ainda não tem nenhuma categoria cadastrada!
            </div>
        @else
            @php
                // Mapeamento das cores
                $colors = [
                    '#CFDDDB',
                    '#E4CDED',
                    '#C2DBE9',
                    '#C9CAEF',
                    '#DDD5CF',
                    '#EDEDCD',
                    '#CDD8ED',
                    '#EDCDCD',
                ];
                $totalColors = count($colors);
            @endphp

            @foreach ($productCategorys as $index => $category)
                        @php
                            $colorIndex = $index % $totalColors;
                            $currentColor = $colors[$colorIndex];
                        @endphp
                
                        <div class="flex flex-row justify-between bg-[{{ $currentColor }}] text-zinc-900 px-3 py-5 rounded-2xl">
                            <div class="flex flex-col justify-start gap-8">
                                <x-dynamic-component 
                                    :component="'fas-' . $category->icon" 
                                    class="w-[30px] h-[30px] text-zinc-700" 
                                />
                                <div class="flex flex-col">
                                    <h1 class="font-semibold"><a href="/cardapio/{{ $category->slug }}">{{ $category->name }}</a></h1>
                                    <p class="text-xs font-medium">{{ $category->products->count() ?? '0' }} itens</p>
                                </div>
                            </div>
                            <div class="flex flex-col justify-between h-full">
                                <x-fas-pen wire:click="openEditModal({{ $category->id }})" class="w-[15px] h-[15px] text-zinc-700 cursor-pointer" />
                                <x-fas-trash wire:click="openDeleteModal({{ $category->id }})" class="w-[15px] h-[15px] text-zinc-700 cursor-pointer" />
                            </div>
                        </div>
            @endforeach
        @endif
      

    </div>  

    <!-- Modal de Cadastro -->
    @if($showModal)
        <div class="fixed inset-0 bg-black bg-opacity-70 backdrop-blur-sm flex items-center justify-center z-50">
            <div class="bg-zinc-900 p-6 rounded-xl shadow-xl text-center flex flex-col items-center w-96">
                <h2 class="text-lg font-semibold mb-3 text-white flex flex-row gap-2 items-center">
                    Cadastrar Categoria
                </h2>
                <p class="text-zinc-400 text-sm mb-3">Preencha os dados e cadastre a categoria</p>

                <div class="flex flex-col gap-3 w-full">
                    <div class="flex flex-col w-full gap-1">
                        <input type="text" name="name" wire:model="name" placeholder="Nome da Categoria" class="rounded-md p-2 text-black" required>
                        @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <h1 class="text-zinc-400 text-sm">Selecione o ícone desta categoria</h1>
                    <div class="grid grid-cols-4 gap-3">
                        
                        <div class="flex items-center px-4 border border-zinc-600 rounded-sm cursor-pointer">
                            <input checked id="bowl-food" type="radio" wire:model="icon" value="bowl-food" name="bordered-radio" class="w-4 h-4  bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
                            <label for="bowl-food" class="py-4 ms-2 text-sm font-medium text-gray-900"><x-fas-bowl-food class="w-4 h-4 text-[#B1EE81]" /></label>
                        </div>

                        <div class="flex items-center ps-4 border border-zinc-600 rounded-sm">
                            <input id="utensils" type="radio" wire:model="icon" value="utensils" name="bordered-radio" class="w-4 h-4 bg-gray-100 border-gray-300 focus:ring-blue-500focus:ring-2">
                            <label for="utensils" class="py-4 ms-2 text-sm font-medium text-gray-900"><x-fas-utensils class="w-4 h-4 text-[#B1EE81]" /></label>
                        </div>

                        <div class="flex items-center px-4 border border-zinc-600 rounded-sm">
                            <input id="burger" type="radio" wire:model="icon" value="burger" name="bordered-radio" class="w-4 h-4 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
                            <label for="burger" class="py-4 ms-2 text-sm font-medium text-gray-900"><x-fas-burger class="w-4 h-4 text-[#B1EE81]" /></label>
                        </div>
                        
                        <div class="flex items-center ps-4 border border-zinc-600 rounded-sm">
                            <input id="mug-hot" type="radio" wire:model="icon" value="mug-hot" name="bordered-radio" class="w-4 h-4 bg-gray-100 border-gray-300 focus:ring-blue-500focus:ring-2">
                            <label for="mug-hot" class="py-4 ms-2 text-sm font-medium text-gray-900"><x-fas-mug-hot class="w-4 h-4 text-[#B1EE81]" /></label>
                        </div>

                        <div class="flex items-center ps-4 border border-zinc-600 rounded-sm">
                            <input id="fish" type="radio" wire:model="icon" value="fish" name="bordered-radio" class="w-4 h-4 bg-gray-100 border-gray-300 focus:ring-blue-500focus:ring-2">
                            <label for="fish" class="py-4 ms-2 text-sm font-medium text-gray-900"><x-fas-fish class="w-4 h-4 text-[#B1EE81]" /></label>
                        </div>

                        <div class="flex items-center ps-4 border border-zinc-600 rounded-sm">
                            <input id="martini-glass" type="radio" wire:model="icon" value="martini-glass" name="bordered-radio" class="w-4 h-4 bg-gray-100 border-gray-300 focus:ring-blue-500focus:ring-2">
                            <label for="martini-glass" class="py-4 ms-2 text-sm font-medium text-gray-900"><x-fas-martini-glass class="w-4 h-4 text-[#B1EE81]" /></label>
                        </div>

                        <div class="flex items-center ps-4 border border-zinc-600 rounded-sm">
                            <input id="wine-glass-empty" type="radio" wire:model="icon" value="wine-glass-empty" name="bordered-radio" class="w-4 h-4 bg-gray-100 border-gray-300 focus:ring-blue-500focus:ring-2">
                            <label for="wine-glass-empty" class="py-4 ms-2 text-sm font-medium text-gray-900"><x-fas-wine-glass-empty class="w-4 h-4 text-[#B1EE81]" /></label>
                        </div>

                        <div class="flex items-center ps-4 border border-zinc-600 rounded-sm">
                            <input id="glass-water" type="radio" wire:model="icon" value="glass-water" name="bordered-radio" class="w-4 h-4 bg-gray-100 border-gray-300 focus:ring-blue-500focus:ring-2">
                            <label for="glass-water" class="py-4 ms-2 text-sm font-medium text-gray-900"><x-fas-glass-water class="w-4 h-4 text-[#B1EE81]" /></label>
                        </div>

                        <div class="flex items-center ps-4 border border-zinc-600 rounded-sm">
                            <input id="ice-cream" type="radio" wire:model="icon" value="ice-cream" name="bordered-radio" class="w-4 h-4 bg-gray-100 border-gray-300 focus:ring-blue-500focus:ring-2">
                            <label for="ice-cream" class="py-4 ms-2 text-sm font-medium text-gray-900"><x-fas-ice-cream class="w-4 h-4 text-[#B1EE81]" /></label>
                        </div>

                        <div class="flex items-center ps-4 border border-zinc-600 rounded-sm">
                            <input id="bowl-rice" type="radio" wire:model="icon" value="bowl-rice" name="bordered-radio" class="w-4 h-4 bg-gray-100 border-gray-300 focus:ring-blue-500focus:ring-2">
                            <label for="bowl-rice" class="py-4 ms-2 text-sm font-medium text-gray-900"><x-fas-bowl-rice class="w-4 h-4 text-[#B1EE81]" /></label>
                        </div>

                        <div class="flex items-center ps-4 border border-zinc-600 rounded-sm">
                            <input id="pizza-slice" type="radio" wire:model="icon" value="pizza-slice" name="bordered-radio" class="w-4 h-4 bg-gray-100 border-gray-300 focus:ring-blue-500focus:ring-2">
                            <label for="pizza-slice" class="py-4 ms-2 text-sm font-medium text-gray-900"><x-fas-pizza-slice class="w-4 h-4 text-[#B1EE81]" /></label>
                        </div>

                        <div class="flex items-center ps-4 border border-zinc-600 rounded-sm">
                            <input id="drumstick-bite" type="radio" wire:model="icon" value="drumstick-bite" name="bordered-radio" class="w-4 h-4 bg-gray-100 border-gray-300 focus:ring-blue-500focus:ring-2">
                            <label for="drumstick-bite" class="py-4 ms-2 text-sm font-medium text-gray-900"><x-fas-drumstick-bite class="w-4 h-4 text-[#B1EE81]" /></label>
                        </div>

                        <div class="flex items-center ps-4 border border-zinc-600 rounded-sm">
                            <input id="shrimp" type="radio" wire:model="icon" value="shrimp" name="bordered-radio" class="w-4 h-4 bg-gray-100 border-gray-300 focus:ring-blue-500focus:ring-2">
                            <label for="shrimp" class="py-4 ms-2 text-sm font-medium text-gray-900"><x-fas-shrimp class="w-4 h-4 text-[#B1EE81]" /></label>
                        </div>

                        <div class="flex items-center ps-4 border border-zinc-600 rounded-sm">
                            <input id="store" type="radio" wire:model="icon" value="store" name="bordered-radio" class="w-4 h-4 bg-gray-100 border-gray-300 focus:ring-blue-500focus:ring-2">
                            <label for="store" class="py-4 ms-2 text-sm font-medium text-gray-900"><x-fas-store class="w-4 h-4 text-[#B1EE81]" /></label>
                        </div>

                        <div class="flex items-center ps-4 border border-zinc-600 rounded-sm">
                            <input id="bottle-water" type="radio" wire:model="icon" value="bottle-water" name="bordered-radio" class="w-4 h-4 bg-gray-100 border-gray-300 focus:ring-blue-500focus:ring-2">
                            <label for="bottle-water" class="py-4 ms-2 text-sm font-medium text-gray-900"><x-fas-bottle-water class="w-4 h-4 text-[#B1EE81]" /></label>
                        </div>

                        <div class="flex items-center ps-4 border border-zinc-600 rounded-sm">
                            <input id="hotdog" type="radio" wire:model="icon" value="hotdog" name="bordered-radio" class="w-4 h-4 bg-gray-100 border-gray-300 focus:ring-blue-500focus:ring-2">
                            <label for="hotdog" class="py-4 ms-2 text-sm font-medium text-gray-900"><x-fas-hotdog class="w-4 h-4 text-[#B1EE81]" /></label>
                        </div>

                    </div>

                </div>

                <div class="flex flex-row gap-3 mt-3">
                    <button wire:click="closeModal" class="bg-red-400 text-black px-4 py-2 rounded-lg hover:bg-white transition">Cancelar</button>
                    <button wire:click="save" class="bg-pgreen text-black px-4 py-2 rounded-lg hover:bg-white transition">Cadastrar</button>
                </div>
            </div>
        </div>
    @endif

    <!-- Modal de Cadastro -->
    @if($showEditModal)
        <div class="fixed inset-0 bg-black bg-opacity-70 backdrop-blur-sm flex items-center justify-center z-50">
            <div class="bg-zinc-900 p-6 rounded-xl shadow-xl text-center flex flex-col items-center w-96">
                <h2 class="text-lg font-semibold mb-3 text-white flex flex-row gap-2 items-center">
                    Cadastrar Categoria
                </h2>
                <p class="text-zinc-400 text-sm mb-3">Preencha os dados e cadastre a categoria</p>

                <div class="flex flex-col gap-3 w-full">
                    <div class="flex flex-col w-full gap-1">
                        <input type="text" name="name" wire:model="name" placeholder="Nome da Categoria" class="rounded-md p-2 text-black" required>
                        @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <h1 class="text-zinc-400 text-sm">Selecione o ícone desta categoria</h1>
                    <div class="grid grid-cols-4 gap-3">
                        
                        <div class="flex items-center px-4 border border-zinc-600 rounded-sm cursor-pointer">
                            <input checked id="bowl-food" type="radio" wire:model="icon" value="bowl-food" name="bordered-radio" class="w-4 h-4  bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
                            <label for="bowl-food" class="py-4 ms-2 text-sm font-medium text-gray-900"><x-fas-bowl-food class="w-4 h-4 text-[#B1EE81]" /></label>
                        </div>

                        <div class="flex items-center ps-4 border border-zinc-600 rounded-sm">
                            <input id="utensils" type="radio" wire:model="icon" value="utensils" name="bordered-radio" class="w-4 h-4 bg-gray-100 border-gray-300 focus:ring-blue-500focus:ring-2">
                            <label for="utensils" class="py-4 ms-2 text-sm font-medium text-gray-900"><x-fas-utensils class="w-4 h-4 text-[#B1EE81]" /></label>
                        </div>

                        <div class="flex items-center px-4 border border-zinc-600 rounded-sm">
                            <input id="burger" type="radio" wire:model="icon" value="burger" name="bordered-radio" class="w-4 h-4 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
                            <label for="burger" class="py-4 ms-2 text-sm font-medium text-gray-900"><x-fas-burger class="w-4 h-4 text-[#B1EE81]" /></label>
                        </div>
                        
                        <div class="flex items-center ps-4 border border-zinc-600 rounded-sm">
                            <input id="mug-hot" type="radio" wire:model="icon" value="mug-hot" name="bordered-radio" class="w-4 h-4 bg-gray-100 border-gray-300 focus:ring-blue-500focus:ring-2">
                            <label for="mug-hot" class="py-4 ms-2 text-sm font-medium text-gray-900"><x-fas-mug-hot class="w-4 h-4 text-[#B1EE81]" /></label>
                        </div>

                        <div class="flex items-center ps-4 border border-zinc-600 rounded-sm">
                            <input id="fish" type="radio" wire:model="icon" value="fish" name="bordered-radio" class="w-4 h-4 bg-gray-100 border-gray-300 focus:ring-blue-500focus:ring-2">
                            <label for="fish" class="py-4 ms-2 text-sm font-medium text-gray-900"><x-fas-fish class="w-4 h-4 text-[#B1EE81]" /></label>
                        </div>

                        <div class="flex items-center ps-4 border border-zinc-600 rounded-sm">
                            <input id="martini-glass" type="radio" wire:model="icon" value="martini-glass" name="bordered-radio" class="w-4 h-4 bg-gray-100 border-gray-300 focus:ring-blue-500focus:ring-2">
                            <label for="martini-glass" class="py-4 ms-2 text-sm font-medium text-gray-900"><x-fas-martini-glass class="w-4 h-4 text-[#B1EE81]" /></label>
                        </div>

                        <div class="flex items-center ps-4 border border-zinc-600 rounded-sm">
                            <input id="wine-glass-empty" type="radio" wire:model="icon" value="wine-glass-empty" name="bordered-radio" class="w-4 h-4 bg-gray-100 border-gray-300 focus:ring-blue-500focus:ring-2">
                            <label for="wine-glass-empty" class="py-4 ms-2 text-sm font-medium text-gray-900"><x-fas-wine-glass-empty class="w-4 h-4 text-[#B1EE81]" /></label>
                        </div>

                        <div class="flex items-center ps-4 border border-zinc-600 rounded-sm">
                            <input id="glass-water" type="radio" wire:model="icon" value="glass-water" name="bordered-radio" class="w-4 h-4 bg-gray-100 border-gray-300 focus:ring-blue-500focus:ring-2">
                            <label for="glass-water" class="py-4 ms-2 text-sm font-medium text-gray-900"><x-fas-glass-water class="w-4 h-4 text-[#B1EE81]" /></label>
                        </div>

                        <div class="flex items-center ps-4 border border-zinc-600 rounded-sm">
                            <input id="ice-cream" type="radio" wire:model="icon" value="ice-cream" name="bordered-radio" class="w-4 h-4 bg-gray-100 border-gray-300 focus:ring-blue-500focus:ring-2">
                            <label for="ice-cream" class="py-4 ms-2 text-sm font-medium text-gray-900"><x-fas-ice-cream class="w-4 h-4 text-[#B1EE81]" /></label>
                        </div>

                        <div class="flex items-center ps-4 border border-zinc-600 rounded-sm">
                            <input id="bowl-rice" type="radio" wire:model="icon" value="bowl-rice" name="bordered-radio" class="w-4 h-4 bg-gray-100 border-gray-300 focus:ring-blue-500focus:ring-2">
                            <label for="bowl-rice" class="py-4 ms-2 text-sm font-medium text-gray-900"><x-fas-bowl-rice class="w-4 h-4 text-[#B1EE81]" /></label>
                        </div>

                        <div class="flex items-center ps-4 border border-zinc-600 rounded-sm">
                            <input id="pizza-slice" type="radio" wire:model="icon" value="pizza-slice" name="bordered-radio" class="w-4 h-4 bg-gray-100 border-gray-300 focus:ring-blue-500focus:ring-2">
                            <label for="pizza-slice" class="py-4 ms-2 text-sm font-medium text-gray-900"><x-fas-pizza-slice class="w-4 h-4 text-[#B1EE81]" /></label>
                        </div>

                        <div class="flex items-center ps-4 border border-zinc-600 rounded-sm">
                            <input id="drumstick-bite" type="radio" wire:model="icon" value="drumstick-bite" name="bordered-radio" class="w-4 h-4 bg-gray-100 border-gray-300 focus:ring-blue-500focus:ring-2">
                            <label for="drumstick-bite" class="py-4 ms-2 text-sm font-medium text-gray-900"><x-fas-drumstick-bite class="w-4 h-4 text-[#B1EE81]" /></label>
                        </div>

                        <div class="flex items-center ps-4 border border-zinc-600 rounded-sm">
                            <input id="shrimp" type="radio" wire:model="icon" value="shrimp" name="bordered-radio" class="w-4 h-4 bg-gray-100 border-gray-300 focus:ring-blue-500focus:ring-2">
                            <label for="shrimp" class="py-4 ms-2 text-sm font-medium text-gray-900"><x-fas-shrimp class="w-4 h-4 text-[#B1EE81]" /></label>
                        </div>

                        <div class="flex items-center ps-4 border border-zinc-600 rounded-sm">
                            <input id="store" type="radio" wire:model="icon" value="store" name="bordered-radio" class="w-4 h-4 bg-gray-100 border-gray-300 focus:ring-blue-500focus:ring-2">
                            <label for="store" class="py-4 ms-2 text-sm font-medium text-gray-900"><x-fas-store class="w-4 h-4 text-[#B1EE81]" /></label>
                        </div>

                        <div class="flex items-center ps-4 border border-zinc-600 rounded-sm">
                            <input id="bottle-water" type="radio" wire:model="icon" value="bottle-water" name="bordered-radio" class="w-4 h-4 bg-gray-100 border-gray-300 focus:ring-blue-500focus:ring-2">
                            <label for="bottle-water" class="py-4 ms-2 text-sm font-medium text-gray-900"><x-fas-bottle-water class="w-4 h-4 text-[#B1EE81]" /></label>
                        </div>

                        <div class="flex items-center ps-4 border border-zinc-600 rounded-sm">
                            <input id="hotdog" type="radio" wire:model="icon" value="hotdog" name="bordered-radio" class="w-4 h-4 bg-gray-100 border-gray-300 focus:ring-blue-500focus:ring-2">
                            <label for="hotdog" class="py-4 ms-2 text-sm font-medium text-gray-900"><x-fas-hotdog class="w-4 h-4 text-[#B1EE81]" /></label>
                        </div>

                    </div>

                </div>

                <div class="flex flex-row gap-3 mt-3">
                    <button wire:click="closeEditModal" class="bg-red-400 text-black px-4 py-2 rounded-lg hover:bg-white transition">Cancelar</button>
                    <button wire:click="update" class="bg-pgreen text-black px-4 py-2 rounded-lg hover:bg-white transition">Atualizar</button>
                </div>
            </div>
        </div>
    @endif

    <!-- Modal de Confirmação de Exclusão -->
    @if($showDeleteModal)
        <div class="fixed inset-0 bg-black bg-opacity-70 backdrop-blur-sm flex items-center justify-center z-50">
            <div class="bg-zinc-900 p-6 rounded-xl shadow-xl text-center flex flex-col items-center w-96">
                <h2 class="text-lg font-semibold mb-3 text-white flex flex-row gap-2 items-center">
                    Confirmar Exclusão
                </h2>
                <p class="text-zinc-400 text-sm mb-3">Tem certeza que deseja excluir esta categoria?</p>
                <p class="text-red-500 font-semibold leading-tight">ATENÇÃO: Todos os produtos desta categoria serão excluídos.</p>

                <div class="flex flex-row gap-3 mt-3">
                    <button wire:click="closeDeleteModal" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition">Cancelar</button>
                    <button wire:click="delete" class="bg-red-400 text-black px-4 py-2 rounded-lg hover:bg-red-500 transition">Excluir</button>
                </div>
            </div>
        </div>
    @endif

    
</div>

