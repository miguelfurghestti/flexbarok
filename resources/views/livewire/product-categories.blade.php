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
      
        <div class="flex flex-col justify-start bg-green-100 text-zinc-900 p-3 rounded-2xl gap-8">
            <x-fas-wine-glass-empty class="w-[30px] h-[30px] text-zinc-700" />
            <div class="flex flex-col">
                <h1 class="font-semibold">Bebidas</h1>
                <p class="text-xs font-medium">15 items</p>
            </div>
        </div>
        
        <div class="flex flex-col justify-start bg-green-100 text-zinc-900 p-3 rounded-2xl gap-8">
            <x-fas-wine-glass-empty class="w-[30px] h-[30px] text-zinc-700" />
            <div class="flex flex-col">
                <h1 class="font-semibold">Bebidas</h1>
                <p class="text-xs font-medium">15 items</p>
            </div>
        </div>

        <div class="flex flex-col justify-start bg-green-100 text-zinc-900 p-3 rounded-2xl gap-8">
            <x-fas-wine-glass-empty class="w-[30px] h-[30px] text-zinc-700" />
            <div class="flex flex-col">
                <h1 class="font-semibold">Bebidas</h1>
                <p class="text-xs font-medium">15 items</p>
            </div>
        </div>

        <div class="flex flex-col justify-start bg-green-100 text-zinc-900 p-3 rounded-2xl gap-8">
            <x-fas-wine-glass-empty class="w-[30px] h-[30px] text-zinc-700" />
            <div class="flex flex-col">
                <h1 class="font-semibold">Bebidas</h1>
                <p class="text-xs font-medium">15 items</p>
            </div>
        </div>

        <div class="flex flex-col justify-start bg-green-100 text-zinc-900 p-3 rounded-2xl gap-8">
            <x-fas-wine-glass-empty class="w-[30px] h-[30px] text-zinc-700" />
            <div class="flex flex-col">
                <h1 class="font-semibold">Bebidas</h1>
                <p class="text-xs font-medium">15 items</p>
            </div>
        </div>

        <div class="flex flex-col justify-start bg-green-100 text-zinc-900 p-3 rounded-2xl gap-8">
            <x-fas-wine-glass-empty class="w-[30px] h-[30px] text-zinc-700" />
            <div class="flex flex-col">
                <h1 class="font-semibold">Bebidas</h1>
                <p class="text-xs font-medium">15 items</p>
            </div>
        </div>

    </div>  

    <!-- Modal de Cadastro -->
    @if(!$showModal)
        <div class="fixed inset-0 bg-black bg-opacity-70 backdrop-blur-sm flex items-center justify-center z-50">
            <div class="bg-zinc-900 p-6 rounded-xl shadow-xl text-center flex flex-col items-center w-96">
                <h2 class="text-lg font-semibold mb-3 text-white flex flex-row gap-2 items-center">
                    <x-fas-table-list  class="w-[42px] h-[50px] text-[#B1EE81]" />
                    Cadastrar Categoria
                </h2>
                <p class="text-zinc-400 text-sm mb-3">Preencha os dados e cadastre a categoria</p>

                <div class="flex flex-col gap-3 w-full">
                    <div class="flex flex-col w-full gap-1">
                        <input type="text" name="name" wire:model="name" placeholder="Nome da Categoria" class="rounded-md p-2 text-black" required>
                        @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <h1>Selecione o ícone da categoria</h1>
                    <div class="grid grid-cols-4 gap-3 mt-3">
                        
                        <div for="bordered-radio-1" class="flex items-center px-4 border border-gray-200 rounded-sm cursor-pointer">
                            <input checked id="bordered-radio-1" type="radio" value="" name="bordered-radio" class="w-4 h-4  bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
                            <label for="bordered-radio-1" class="py-4 ms-2 text-sm font-medium text-gray-900"><x-fas-bowl-food  class="w-4 h-4 text-[#B1EE81]" /></label>
                        </div>

                        <div class="flex items-center ps-4 border border-gray-200 rounded-sm">
                            <input id="bordered-radio-2" type="radio" value="" name="bordered-radio" class="w-4 h-4 bg-gray-100 border-gray-300 focus:ring-blue-500focus:ring-2">
                            <label for="bordered-radio-2" class="py-4 ms-2 text-sm font-medium text-gray-900"><x-fas-utensils  class="w-4 h-4 text-[#B1EE81]" /></label>
                        </div>

                        <div class="flex items-center px-4 border border-gray-200 rounded-sm">
                            <input checked id="bordered-radio-3" type="radio" value="" name="bordered-radio" class="w-4 h-4 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
                            <label for="bordered-radio-3" class="py-4 ms-2 text-sm font-medium text-gray-900"><x-fas-burger  class="w-4 h-4 text-[#B1EE81]" /></label>
                        </div>
                        
                        <div class="flex items-center ps-4 border border-gray-200 rounded-sm">
                            <input id="bordered-radio-4" type="radio" value="" name="bordered-radio" class="w-4 h-4 bg-gray-100 border-gray-300 focus:ring-blue-500focus:ring-2">
                            <label for="bordered-radio-4" class="py-4 ms-2 text-sm font-medium text-gray-900"><x-fas-mug-hot  class="w-4 h-4 text-[#B1EE81]" /></label>
                        </div>

                        <div class="flex items-center ps-4 border border-gray-200 rounded-sm">
                            <input id="bordered-radio-4" type="radio" value="" name="bordered-radio" class="w-4 h-4 bg-gray-100 border-gray-300 focus:ring-blue-500focus:ring-2">
                            <label for="bordered-radio-4" class="py-4 ms-2 text-sm font-medium text-gray-900"><x-fas-fish  class="w-4 h-4 text-[#B1EE81]" /></label>
                        </div>

                        <div class="flex items-center ps-4 border border-gray-200 rounded-sm">
                            <input id="bordered-radio-4" type="radio" value="" name="bordered-radio" class="w-4 h-4 bg-gray-100 border-gray-300 focus:ring-blue-500focus:ring-2">
                            <label for="bordered-radio-4" class="py-4 ms-2 text-sm font-medium text-gray-900"><x-fas-mug-hot  class="w-4 h-4 text-[#B1EE81]" /></label>
                        </div>

                        <div class="flex items-center ps-4 border border-gray-200 rounded-sm">
                            <input id="bordered-radio-4" type="radio" value="" name="bordered-radio" class="w-4 h-4 bg-gray-100 border-gray-300 focus:ring-blue-500focus:ring-2">
                            <label for="bordered-radio-4" class="py-4 ms-2 text-sm font-medium text-gray-900"><x-fas-mug-hot  class="w-4 h-4 text-[#B1EE81]" /></label>
                        </div>

                        <div class="flex items-center ps-4 border border-gray-200 rounded-sm">
                            <input id="bordered-radio-4" type="radio" value="" name="bordered-radio" class="w-4 h-4 bg-gray-100 border-gray-300 focus:ring-blue-500focus:ring-2">
                            <label for="bordered-radio-4" class="py-4 ms-2 text-sm font-medium text-gray-900"><x-fas-mug-hot  class="w-4 h-4 text-[#B1EE81]" /></label>
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

    
</div>

