@extends('shop.layout')

@section('conteudo')
<main class="grid grid-cols-6 p-4 gap-5 font-['Montserrat'] h-screen overflow-y-scroll place-content-start [&::-webkit-scrollbar]:w-2
  [&::-webkit-scrollbar-track]:bg-gray-100
  [&::-webkit-scrollbar-thumb]:bg-gray-300
  dark:[&::-webkit-scrollbar-track]:bg-neutral-700
  dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500 pb-28">

    @for($i=1; $i<=30; $i++)
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
        </div>


</main>
@endsection