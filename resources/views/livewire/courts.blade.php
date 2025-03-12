<div>
    <!-- Botão para abrir o modal -->
    <div class="flex flex-row justify-between">
        <h1 class="text-white text-2xl font-['Open Sans']">Quadras</h1>
        <button wire:click="openModal" class="bg-pgreen flex flex-row gap-2 px-3 py-2 rounded-full items-center font-['Open Sans'] font-bold text-sm select-none">
            {{-- <x-solar-add-square-bold class="w-[20px] h-[20px]" /> --}}
            Cadastrar Quadra
        </button>
    </div>

    <!-- Lista de Quadras -->
    <div class="flex flex-col gap-3 mt-4">
        @if($courts->isEmpty())
            <div class="text-center text-lg mt-4 text-gray-500">
                Ainda não tem nenhuma quadra cadastrada!
            </div>
        @else
            @foreach ($courts as $court)
                <div class="flex flex-row justify-between w-full items-center bg-zinc-900 rounded-lg px-2 py-3">
                    <span class="flex flex-row w-full gap-2">
                        @php
                            // Mapeamento dos IDs de esportes para ícones
                            $icones = [
                                1 => 'ico-futebol.png',
                                2 => 'ico-volei.png',
                                3 => 'ico-beach-tenis.png',
                                4 => 'ico-tenis.png',
                                5 => 'ico-basquete.png',
                                6 => 'ico-handebol.png',
                                7 => 'ico-futevolei.png',
                            ];
                            // Define o ícone com base no id_sport da quadra
                            $iconeEsporte = $icones[$court->id_sport] ?? 'ico-default.png'; // Ícone padrão caso o id_sport não exista no mapeamento
                        @endphp
                        <img src="/icones/{{ $iconeEsporte }}" alt="{{ $court->name }}">
                        <p class="text-white">[{{ $court->sport->name }}] - {{ $court->name }}</p>
                    </span>
                    <div class="flex flex-row gap-2">
                        <button wire:click="openEditModal({{ $court->id }})" class="text-white flex flex-row gap-1 items-center">
                            {{-- <x-tabler-edit stroke-width="1" class="text-pgreen" /> Editar --}}
                        </button>
                        <button wire:click="openDeleteModal({{ $court->id }})" class="text-white flex flex-row gap-1 items-center">
                            {{-- <x-tabler-trash stroke-width="1" class="text-red-400" /> Excluir --}}
                        </button>
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
                    {{-- <x-tabler-soccer-field class="w-[42px] h-[50px] text-[#B1EE81]" stroke-width="1" /> --}}
                    Cadastrar Quadra
                </h2>
                <p class="text-zinc-400 text-sm mb-3">Preencha os dados e cadastre</p>

                <div class="flex flex-col gap-3 w-full">
                    <div class="flex flex-col w-full gap-1">
                        <input type="text" name="name" wire:model="name" placeholder="Nome da Quadra" class="rounded-md p-2 text-black" required>
                        @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <!-- Select padrão -->
                    <select wire:model="id_sport" class="bg-zinc-500 text-white text-base rounded-lg p-2">
                        <option value="">Escolha um esporte</option>
                        @foreach ($sports as $sport)
                            <option value="{{ $sport->id }}">{{ $sport->name }}</option>
                        @endforeach
                    </select>
                    @error('id_sport') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>

                <div class="flex flex-row gap-3 mt-3">
                    <button wire:click="closeModal" class="bg-red-400 text-black px-4 py-2 rounded-lg hover:bg-white transition">Cancelar</button>
                    <button wire:click="save" class="bg-pgreen text-black px-4 py-2 rounded-lg hover:bg-white transition">Cadastrar</button>
                </div>
            </div>
        </div>
    @endif

    <!-- Modal de Edição -->
    @if($showEditModal)
        <div class="fixed inset-0 bg-black bg-opacity-70 backdrop-blur-sm flex items-center justify-center z-50">
            <div class="bg-zinc-900 p-6 rounded-xl shadow-xl text-center flex flex-col items-center w-96">
                <h2 class="text-lg font-semibold mb-3 text-white flex flex-row gap-2 items-center">
                    {{-- <x-tabler-edit class="w-[42px] h-[50px] text-[#B1EE81]" stroke-width="1" /> --}}
                    Editar Quadra
                </h2>
                <p class="text-zinc-400 text-sm mb-3">Atualize os dados da quadra</p>

                <div class="flex flex-col gap-3 w-full">
                    <div class="flex flex-col w-full gap-1">
                        <input type="text" name="name" wire:model="name" placeholder="Nome da Quadra" class="rounded-md p-2 text-black" required>
                        @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <select wire:model="id_sport" class="bg-zinc-500 text-white text-base rounded-lg p-2">
                        <option value="">Escolha um esporte</option>
                        @foreach ($sports as $sport)
                            <option value="{{ $sport->id }}">{{ $sport->name }}</option>
                        @endforeach
                    </select>
                    @error('id_sport') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>

                <div class="flex flex-row gap-3 mt-3">
                    <button wire:click="closeEditModal" class="bg-red-400 text-black px-4 py-2 rounded-lg hover:bg-white transition">Cancelar</button>
                    <button wire:click="update" class="bg-pgreen text-black px-4 py-2 rounded-lg hover:bg-white transition">Salvar</button>
                </div>
            </div>
        </div>
    @endif

    <!-- Modal de Confirmação de Exclusão -->
    @if($showDeleteModal)
        <div class="fixed inset-0 bg-black bg-opacity-70 backdrop-blur-sm flex items-center justify-center z-50">
            <div class="bg-zinc-900 p-6 rounded-xl shadow-xl text-center flex flex-col items-center w-96">
                <h2 class="text-lg font-semibold mb-3 text-white flex flex-row gap-2 items-center">
                    {{-- <x-tabler-trash class="w-[42px] h-[50px] text-red-400" stroke-width="1" /> --}}
                    Confirmar Exclusão
                </h2>
                <p class="text-zinc-400 text-sm mb-3">Tem certeza que deseja excluir esta quadra?</p>

                <div class="flex flex-row gap-3 mt-3">
                    <button wire:click="closeDeleteModal" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition">Cancelar</button>
                    <button wire:click="delete" class="bg-red-400 text-black px-4 py-2 rounded-lg hover:bg-red-500 transition">Excluir</button>
                </div>
            </div>
        </div>
    @endif
</div>



