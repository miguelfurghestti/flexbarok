@extends('shop.layout')

@section('conteudo')

@if ($showModal)
<!-- Overlay Escuro com Desfoque -->
<div class="fixed inset-0 bg-black bg-opacity-70 backdrop-blur-sm flex items-center justify-center z-50">
    <div class="bg-zinc-900 p-6 rounded-xl shadow-xl text-center flex flex-col items-center w-96">
        <h2 class="text-lg font-semibold mb-4 text-white flex flex-row gap-2 items-center">
            <x-fas-rocket class="w-5 h-5 text-pgreen group-hover:text-white transition duration-300" stroke-width="2" />
            <span>Seu cadastro está quase pronto!</span>
        </h2>
        <p class="text-zinc-400 mb-6">Cadastre sua empresa para começar a gerenciar seu negócio.</p>


        <button
            class="bg-pgreen text-black px-4 py-2 rounded-lg hover:bg-white transition"
            onclick="window.location.href='{{ route('shop.create') }}'">
            Adicionar Comércio
        </button>
    </div>
</div>
@endif

@if($items->isEmpty())
<main class="flex items-center justify-center p-4 gap-5 font-['Montserrat'] h-screen overflow-y-scroll place-content-start [&::-webkit-scrollbar]:w-2
  [&::-webkit-scrollbar-track]:bg-gray-100
  [&::-webkit-scrollbar-thumb]:bg-gray-300
  dark:[&::-webkit-scrollbar-track]:bg-neutral-700
  dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500 pb-28">
    <div class="text-center text-lg mt-4 text-gray-500">
        Você ainda não tem nenhuma {{ $type_sell }} cadastrada.
        <a href="#" class="text-pgreen underline">Cadastre aqui.</a>
    </div>
    @else
    <main class="grid grid-cols-6 p-4 gap-5 font-['Montserrat'] h-screen overflow-y-scroll place-content-start [&::-webkit-scrollbar]:w-2
  [&::-webkit-scrollbar-track]:bg-gray-100
  [&::-webkit-scrollbar-thumb]:bg-gray-300
  dark:[&::-webkit-scrollbar-track]:bg-neutral-700
  dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500 pb-28">
        @foreach($items as $item)
        @if($item->status == 'pending')
        <div class="bg-zinc-800 border-zinc-200 border rounded-2xl p-2 flex flex-col items-center gap-5 text-white max-h-48 justify-between">
            <div class="flex flex-col items-center gap-2  justify-between h-full">
                <h3 class="text-xs font-semibold">COMANDA</h3>
                <h1 class="text-5xl font-semibold">01</h1>
                <span class="flex flex-row gap-2 items-baseline">
                    <p class="text-xs">R$</p>
                    <p class="text-xl font-semibold">1.232,00</p>
                </span>
            </div>

            <span class="text-xs font-semibold">LIBERADA</span>
        </div>

        @endif

        @if($item->status == 'completed')
        <div class="bg-pgreen rounded-2xl p-2 flex flex-col items-center gap-5 max-h-48 justify-between">
            <div class="flex flex-col items-center gap-2 justify-between h-full">
                <h3 class="text-xs font-semibold">COMANDA</h3>
                <h1 class="text-5xl font-semibold">01</h1>
                <span class="flex flex-row gap-2 items-baseline">
                    <p class="text-xs">R$</p>
                    <p class="text-xl font-semibold">1.232,00</p>
                </span>
            </div>

            <span class="text-xs font-semibold">ABERTA</span>
        </div>
        @endif

        @if($item->status == 'cancelled')
        <div class="bg-red-400 rounded-2xl p-2 flex flex-col items-center gap-5 max-h-48 justify-between">
            <div class="flex flex-col items-center gap-2 justify-between h-full">
                <h3 class="text-xs font-semibold">COMANDA</h3>
                <h1 class="text-5xl font-semibold">01</h1>
                <span class="flex flex-row gap-2 items-baseline">
                    <p class="text-xs">R$</p>
                    <p class="text-xl font-semibold">1.232,00</p>
                </span>
            </div>

            <span class="text-xs font-semibold">FECHADA</span>
        </div>
        @endif

        @endforeach
        </ul>
        @endif

        {{-- @for($i=1; $i<=30; $i++)
        <div class="bg-pgreen rounded-2xl p-2 flex flex-col items-center gap-5 max-h-48 justify-between">
        <div class="flex flex-col items-center gap-2 justify-between h-full">
            <h3 class="text-xs font-semibold">COMANDA</h3>
            <h1 class="text-5xl font-semibold">01</h1>
            <span class="flex flex-row gap-2 items-baseline">
                <p class="text-xs">R$</p>
                <p class="text-xl font-semibold">1.232,00</p>
            </span>
        </div>

        <span class="text-xs font-semibold">ABERTA</span>
        </div>
        @endfor

        <div class="bg-red-400 rounded-2xl p-2 flex flex-col items-center gap-5 max-h-48 justify-between">
            <div class="flex flex-col items-center gap-2 justify-between h-full">
                <h3 class="text-xs font-semibold">COMANDA</h3>
                <h1 class="text-5xl font-semibold">01</h1>
                <span class="flex flex-row gap-2 items-baseline">
                    <p class="text-xs">R$</p>
                    <p class="text-xl font-semibold">1.232,00</p>
                </span>
            </div>

            <span class="text-xs font-semibold">FECHADA</span>
        </div>

        <div class="bg-zinc-800 border-zinc-200 border rounded-2xl p-2 flex flex-col items-center gap-5 text-white max-h-48 justify-between">
            <div class="flex flex-col items-center gap-2  justify-between h-full">
                <h3 class="text-xs font-semibold">COMANDA</h3>
                <h1 class="text-5xl font-semibold">01</h1>
                <span class="flex flex-row gap-2 items-baseline">
                    <p class="text-xs">R$</p>
                    <p class="text-xl font-semibold">1.232,00</p>
                </span>
            </div>

            <span class="text-xs font-semibold">FECHADA</span>
        </div> --}}


    </main>
    @endsection