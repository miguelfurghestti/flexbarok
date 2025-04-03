<div>
    <div class="flex flex-row justify-between">
        <h1 class="text-white text-2xl font-['Open Sans']">Reservas</h1>
        <button wire:click="openModal" class="bg-pgreen flex flex-row gap-2 px-3 py-2 rounded-full items-center font-['Open Sans'] font-bold text-sm select-none">
            Agendar Reserva
        </button>
    </div>

    <!-- Lista de Reservas -->
    <div class="flex flex-col gap-3 mt-4">
        @if(!$reservations->isEmpty())
            <div class="text-center text-lg mt-4 text-gray-500">
                Ainda não tem nenhuma reserva cadastrada!
            </div>
        @else
        <div class="grid 2xl:grid-cols-6 xl:grid-cols-4 sm:grid-cols-2 gap-4 mt-4">
           
            <article class="bg-white p-4 flex flex-col gap-4 text-white justify-between rounded-2xl shadow-lg">
                <!-- Cabeçalho -->
                <header class="flex items-center border rounded-lg p-2 border-zinc-300 font-semibold text-sm w-auto max-w-max">
                    <x-far-calendar class="w-4 h-4 text-zinc-800" />
                    <p class="text-zinc-800 ml-2">00/00/0000</p>
                </header>
            
                <!-- Informações do Usuário -->
                <section class="flex flex-col leading-5">
                    <h1 class="text-zinc-800 font-semibold text-sm">Miguel S Furghestti</h1>
                    <p class="text-zinc-800 text-sm">Quadra Fut 02</p>
                </section>
            
                <!-- Ícones e Status -->
                <footer class="flex flex-row justify-between items-center">
                    <img src="icones/ico-futebol.png" alt="Ícone Futebol" class="w-6 h-6">
                    <div class="flex flex-row gap-1 items-center">
                        <x-fas-fire class="w-4 h-4 text-zinc-800" />
                        <p class="text-zinc-800">Sim</p>
                    </div>
                </footer>
            </article>

            <article class="bg-white p-4 flex flex-col gap-4 text-white justify-between rounded-2xl shadow-lg">
                <!-- Cabeçalho -->
                <header class="flex items-center border rounded-lg p-2 border-zinc-300 font-semibold text-sm w-auto max-w-max">
                    <x-far-calendar class="w-4 h-4 text-zinc-800" />
                    <p class="text-zinc-800 ml-2">00/00/0000</p>
                </header>
            
                <!-- Informações do Usuário -->
                <section class="flex flex-col leading-5">
                    <h1 class="text-zinc-800 font-semibold text-sm">Miguel S Furghestti</h1>
                    <p class="text-zinc-800 text-sm">Quadra Fut 02</p>
                </section>
            
                <!-- Ícones e Status -->
                <footer class="flex flex-row justify-between items-center">
                    <img src="icones/ico-futebol.png" alt="Ícone Futebol" class="w-6 h-6">
                    <div class="flex flex-row gap-1 items-center">
                        <x-fas-fire class="w-4 h-4 text-zinc-800" />
                        <p class="text-zinc-800">Sim</p>
                    </div>
                </footer>
            </article>

            @foreach ($reservations as $reservation)
            @php
                $icones = [
                    1 => 'ico-futebol.png',
                    2 => 'ico-volei.png',
                    3 => 'ico-beach-tenis.png',
                    4 => 'ico-tenis.png',
                    5 => 'ico-basquete.png',
                    6 => 'ico-handebol.png',
                    7 => 'ico-futevolei.png',
                ];
                $iconeEsporte = $icones[$reservation->id_court->id_sport] ?? 'ico-default.png'; // Ícone padrão caso o id_sport não exista no mapeamento
            @endphp
            <article class="bg-white p-4 flex flex-col gap-4 text-white justify-between rounded-2xl shadow-lg">
                <!-- Cabeçalho -->
                <header class="flex items-center border rounded-lg p-2 border-zinc-300 font-semibold text-sm w-auto max-w-max">
                    <x-far-calendar class="w-4 h-4 text-zinc-800" />
                    <p class="text-zinc-800 ml-2">{{ $reservation->date }}</p>
                </header>
            
                <!-- Informações do Usuário -->
                <section class="flex flex-col leading-5">
                    <h1 class="text-zinc-800 font-semibold text-sm">{{ $reservation->owner_name }}</h1>
                    <p class="text-zinc-800 text-sm">{{ $reservation->id_court }}</p>
                </section>
            
                <!-- Ícones e Status -->
                <footer class="flex flex-row justify-between items-center">
                    <img src="icones/ico-futebol.png" alt="Ícone Futebol" class="w-6 h-6">
                    <div class="flex flex-row gap-1 items-center">
                        <x-fas-fire class="w-4 h-4 text-zinc-800" />
                        <p class="text-zinc-800">{{ $reservation->use_grill }}</p>
                    </div>
                </footer>
            </article>
            @endforeach
        </div>
        @endif
    </div>

    <!-- Modal de Cadastro -->
    @if($showModal)
    <div class="fixed inset-0 bg-black bg-opacity-70 backdrop-blur-sm flex items-center justify-center z-50">
        <div class="bg-zinc-900 p-6 rounded-xl shadow-xl text-center flex flex-col items-center w-96">
            <h2 class="text-lg font-semibold mb-3 text-white flex flex-row gap-2 items-center">
                Reservar Quadra
            </h2>
            <p class="text-zinc-400 text-sm mb-3">Preencha os dados e reserve a quadra</p>

            <div class="flex flex-col gap-3 w-full">
                <div class="flex flex-col w-full gap-1">
                    <input type="text" name="owner_name" wire:model="owner_name" placeholder="Nome do Responsável" class="rounded-md p-2 text-black" required>
                    @error('owner_name') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>

                <div class="flex flex-col w-full gap-1">
                    <!-- Select padrão -->
                        @if($courts->isEmpty())
                            <div class="text-center text-sm text-gray-500">
                                Para continuar, <a href="" class="font-semibold text-pgreen">cadastre uma quadra</a>
                            </div>
                        @else
                        <select wire:model="id_court" class="bg-zinc-500 text-white text-base rounded-lg p-2">
                                <option value="">Escolha uma quadra</option>
                            @foreach ($courts as $court)
                                <option value="{{ $court->id }}">{{ $court->name }}</option>
                            @endforeach
                        </select>
                        @endif

                    @error('id_court') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>

                <div class="flex flex-col w-full gap-1">
                    <input type="date" name="date" wire:model="date" value="2025-04-03" class="rounded-md p-2 text-black" required>
                    {{ old('date', now()->format('d-m-Y')) }}
                    @error('date') <span class="text-red-500">{{ $message }}</span> @enderror
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

