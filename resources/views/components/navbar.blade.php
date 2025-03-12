<aside class="bg-zinc-900 text-white flex flex-col items-center justify-between h-screen">

    <div class="w-full">
        <a href="" class="w-full py-3 bg-[#B1EE81] flex flex-col items-center">
            {{-- <x-jam-home class="w-[38px] h-[50px] text-zinc-800" stroke-width="1" /> --}}
            <span class="text-zinc-800 font-semibold text-sm">INÍCIO</span>
        </a>

        <a href="/comandas" class="w-full py-3 flex flex-col items-center hover:bg-zinc-950 transition duration-500">
            {{-- <x-hugeicons-note-edit class="w-[38px] h-[50px] text-[#B1EE81]" stroke-width="1" /> --}}
            <span class="text-white font-semibold text-xs">COMANDAS</span>
        </a>

        <a href="/quadras" class="w-full py-3 flex flex-col items-center hover:bg-zinc-950 transition duration-500">
            {{-- <x-tabler-soccer-field class="w-[42px] h-[50px] text-[#B1EE81]" stroke-width="1" /> --}}
            <span class="text-white font-semibold text-xs">QUADRAS</span>
        </a>

        <a href="/clientes" class="w-full py-3 flex flex-col items-center hover:bg-zinc-950 transition duration-500">
            {{-- <x-tabler-user-square-rounded class="w-[42px] h-[50px] text-[#B1EE81]" stroke-width="1" /> --}}
            <span class="text-white font-semibold text-xs">CLIENTES</span>
        </a>

        <a href="" class="w-full py-3 flex flex-col items-center hover:bg-zinc-950 transition duration-500">
            {{-- <x-tabler-calendar-check class="w-[42px] h-[50px] text-[#B1EE81]" stroke-width="1" /> --}}
            <span class="text-white font-semibold text-xs">RESERVAS</span>
        </a>

        <a href="" class="w-full py-3 flex flex-col items-center hover:bg-zinc-950 transition duration-500">
            {{-- <x-hugeicons-dish-01 class="w-[42px] h-[50px] text-[#B1EE81]" stroke-width="1" /> --}}
            <span class="text-white font-semibold text-xs">CARDÁPIO</span>
        </a>
    </div>

    <div class="w-full flex flex-col items-center gap-3 justify-center py-3">
        <a href="" class="flex flex-row items-center gap-1 group transition duration-300">
            {{-- <x-tabler-settings class="w-5 h-5 text-zinc-500 group-hover:text-white transition duration-300" stroke-width="1" /> --}}
            <span class="text-xs text-zinc-500 group-hover:text-white transition duration-300">
                AJUSTES
            </span>
        </a>


        <a href="" class="flex flex-row items-center gap-1 group transition duration-300">
            {{-- <x-tabler-help class="w-5 h-5 text-zinc-500 group-hover:text-white transition duration-300" stroke-width="1" /> --}}
            <span class="text-xs text-zinc-500 group-hover:text-white transition duration-300">AJUDA</span>
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>

        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="flex flex-row items-center gap-1 group transition duration-300">
            <span class="text-xs text-zinc-500 group-hover:text-white transition duration-300">SAIR</span>
        </a>
    </div>

</aside>