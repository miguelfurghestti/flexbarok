<div>
    <div class="flex flex-row justify-between">
        <h1 class="text-white text-2xl font-['Open Sans']">Clientes</h1>
        <button wire:click="openModal" href="/clientes/novo-cliente" class="bg-pgreen flex flex-row gap-2 px-3 py-2 rounded-full items-center font-['Open Sans'] font-bold text-sm select-none">
            {{-- <x-tabler-user-filled class="w-[18px] h-[18px]" /> --}}
            Cadastrar Cliente
        </button>
    </div>

    <div class="flex flex-row p-3 rounded-lg gap-2 bg-gray-400 mt-4">
        {{-- <x-tabler-search class="w-[25px] h-[25px] text-gray-200" stroke-width="2" /> --}}
        <input 
        wire:model.live="search"
        class="placeholder-gray-200 bg-transparent w-full outline-none" 
        type="text" 
        name="search" 
        placeholder="Pesquise pelo nome">
    </div>

    <div class="flex flex-col w-full gap-2 rounded-lg px-2 py-3">

        @if($customers->isEmpty())
            <div class="text-center text-lg mt-4 text-gray-500">
                Nenhum cliente encontrado!
            </div>
        @else
            @foreach($customers as $customer)
            <div class="w-full flex flex-row justify-between border-b p-1 border-zinc-800">
                <p class="text-white">{{ $customer->name }}</p>

                <div class="flex flex-row gap-2">
                    <button wire:click="openEditModal({{ $customer->id }})" class="text-white flex flex-row gap-1 text-sm items-center">
                        <x-fas-pen-to-square class="w-4 h-4 text-gray-500"/>
                        Editar
                    </button>
                    <button wire:click="openDeleteModal({{ $customer->id }})" class="text-white flex flex-row gap-1 text-sm items-center">
                        <x-fas-trash class="w-4 h-4 text-gray-500"/>
                        Excluir
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
                    {{-- <x-tabler-user-square-rounded class="w-[42px] h-[50px] text-[#B1EE81]" stroke-width="1" /> --}}
                    Cadastrar Cliente
                </h2>
                <p class="text-zinc-400 text-sm mb-3">Preencha os dados e cadastre</p>

                <div class="flex flex-col gap-2 w-full">
                    <div class="flex flex-col w-full gap-1">
                        <span class="text-zinc-300 text-xs text-left">Nome*</span>
                        <input type="text" name="name" wire:model="name" value="{{ old('name') }}" placeholder="Digite o nome do cliente" class="rounded-md p-2" required>
                        @error('name') <span class="text-red-900 text-sm border bg-red-300 border-red-700 p-1">{{ $message }}</span> @enderror
                    </div>
    
                    <div class="flex flex-col w-full gap-1">
                        <span class="text-zinc-300 text-xs text-left">CPF</span>
                        <input type="text" name="cpf" wire:model="cpf" value="{{ old('cpf') }}" placeholder="000.000.000-00" class="rounded-md p-2">
                        @error('cpf') <span class="text-red-900 text-sm border bg-red-300 border-red-700 p-1">{{ $message }}</span> @enderror
                    </div>
    
                    <div class="flex flex-row w-full gap-2 justify-between">
                        <div class="flex flex-col w-auto">
                            <span class="text-zinc-300 text-xs text-left">Fone</span>
                            <input type="text" name="phone" wire:model="phone" value="{{ old('phone') }}" placeholder="Telefone" class="rounded-md p-2 w-36">
                            @error('phone') <span class="text-red-900 text-sm border bg-red-300 border-red-700 p-1">{{ $message }}</span> @enderror
                        </div>
    
                        <div class="flex flex-col w-full">
                            <span class="text-zinc-300 text-xs text-left">E-mail</span>
                            <input type="email" name="email" wire:model="email" value="{{ old('email') }}" placeholder="E-mail" class="rounded-md p-2 w-full">
                            @error('email') <span class="text-red-900 text-sm border bg-red-300 border-red-700 p-1">{{ $message }}</span> @enderror
                        </div>
                    </div>
    
                    <div class="flex w-full gap-2">
                        <div class="flex flex-col w-full">
                            <label class="text-zinc-300 text-xs text-left">Endereço</label>
                            <input type="text" name="address" wire:model="address" value="{{ old('address') }}" placeholder="Endereço" class="rounded-md p-2 w-full">
                            @error('address') <span class="text-red-900 text-sm border bg-red-300 border-red-700 p-1">{{ $message }}</span> @enderror
                        </div>
                    
                        <div class="flex flex-col w-auto">
                            <label class="text-zinc-300 text-xs text-left">Nº</label>
                            <input type="text" name="number" wire:model="number" value="{{ old('number') }}" placeholder="1234" class="rounded-md p-2 w-14">
                            @error('number') <span class="text-red-900 text-sm border bg-red-300 border-red-700 p-1">{{ $message }}</span> @enderror
                        </div>
                    </div>
    
                    <div class="flex flex-col w-full gap-1">
                        <div class="flex flex-col w-full">
                            <label class="text-zinc-300 text-xs text-left">Cidade</label>
                            <input type="text" name="city" wire:model="city" value="{{ old('city') }}" placeholder="Cidade" class="rounded-md p-2">
                            @error('city') <span class="text-red-900 text-sm border bg-red-300 border-red-700 p-1">{{ $message }}</span> @enderror
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

    <!-- Modal de Edição -->
    @if($showEditModal)
        <div class="fixed inset-0 bg-black bg-opacity-70 backdrop-blur-sm flex items-center justify-center z-50">
            <div class="bg-zinc-900 p-6 rounded-xl shadow-xl text-center flex flex-col items-center w-96">
                <h2 class="text-lg font-semibold mb-3 text-white flex flex-row gap-2 items-center">
                    {{-- <x-tabler-user-square-rounded class="w-[42px] h-[50px] text-[#B1EE81]" stroke-width="1" /> --}}
                    Editar Cliente
                </h2>
                <p class="text-zinc-400 text-sm mb-3">Atualize os dados do cliente</p>

                <div class="flex flex-col gap-2 w-full">
                    <div class="flex flex-col w-full gap-1">
                        <span class="text-zinc-300 text-xs text-left">Nome*</span>
                        <input type="text" name="name" wire:model="name" value="{{ old('name') }}" placeholder="Digite o nome do cliente" class="rounded-md p-2" required>
                        @error('name') <span class="text-red-900 text-sm border bg-red-300 border-red-700 p-1">{{ $message }}</span> @enderror
                    </div>
    
                    <div class="flex flex-col w-full gap-1">
                        <span class="text-zinc-300 text-xs text-left">CPF</span>
                        <input type="text" name="cpf" wire:model="cpf" value="{{ old('cpf') }}" placeholder="000.000.000-00" class="rounded-md p-2">
                        @error('cpf') <span class="text-red-900 text-sm border bg-red-300 border-red-700 p-1">{{ $message }}</span> @enderror
                    </div>
    
                    <div class="flex flex-row w-full gap-2 justify-between">
                        <div class="flex flex-col w-auto">
                            <span class="text-zinc-300 text-xs text-left">Fone</span>
                            <input type="text" name="phone" wire:model="phone" value="{{ old('phone') }}" placeholder="Telefone" class="rounded-md p-2 w-36">
                            @error('phone') <span class="text-red-900 text-sm border bg-red-300 border-red-700 p-1">{{ $message }}</span> @enderror
                        </div>
    
                        <div class="flex flex-col w-full">
                            <span class="text-zinc-300 text-xs text-left">E-mail</span>
                            <input type="email" name="email" wire:model="email" value="{{ old('email') }}" placeholder="E-mail" class="rounded-md p-2 w-full">
                            @error('email') <span class="text-red-900 text-sm border bg-red-300 border-red-700 p-1">{{ $message }}</span> @enderror
                        </div>
                    </div>
    
                    <div class="flex w-full gap-2">
                        <div class="flex flex-col w-full">
                            <label class="text-zinc-300 text-xs text-left">Endereço</label>
                            <input type="text" name="address" wire:model="address" value="{{ old('address') }}" placeholder="Endereço" class="rounded-md p-2 w-full">
                            @error('address') <span class="text-red-900 text-sm border bg-red-300 border-red-700 p-1">{{ $message }}</span> @enderror
                        </div>
                    
                        <div class="flex flex-col w-auto">
                            <label class="text-zinc-300 text-xs text-left">Nº</label>
                            <input type="text" name="number" wire:model="number" value="{{ old('number') }}" placeholder="1234" class="rounded-md p-2 w-14">
                            @error('number') <span class="text-red-900 text-sm border bg-red-300 border-red-700 p-1">{{ $message }}</span> @enderror
                        </div>
                    </div>
    
                    <div class="flex flex-col w-full gap-1">
                        <div class="flex flex-col w-full">
                            <label class="text-zinc-300 text-xs text-left">Cidade</label>
                            <input type="text" name="city" wire:model="city" value="{{ old('city') }}" placeholder="Cidade" class="rounded-md p-2">
                            @error('city') <span class="text-red-900 text-sm border bg-red-300 border-red-700 p-1">{{ $message }}</span> @enderror
                        </div>
                    </div>
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
                <p class="text-zinc-400 text-sm mb-3">Tem certeza que deseja excluir este cliente?</p>

                <div class="flex flex-row gap-3 mt-3">
                    <button wire:click="closeDeleteModal" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition">Cancelar</button>
                    <button wire:click="delete" class="bg-red-400 text-black px-4 py-2 rounded-lg hover:bg-red-500 transition">Excluir</button>
                </div>
            </div>
        </div>
    @endif
</div>



