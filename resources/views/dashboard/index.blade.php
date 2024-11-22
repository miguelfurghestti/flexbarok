@extends('dashboard.layout')

@section('conteudo')
<main class="grid grid-cols-6 p-4 gap-3 font-['Montserrat'] overflow-y-scroll">

    @for($i=1; $i<=30; $i++)
        <div class="bg-pgreen rounded-2xl p-2 flex flex-col items-center gap-5">
        <div class="flex flex-col items-center gap-2">
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

        <div class="bg-red-400 rounded-2xl p-2 flex flex-col items-center gap-5">
            <div class="flex flex-col items-center gap-2">
                <h3 class="text-xs font-semibold">COMANDA</h3>
                <h1 class="text-5xl font-semibold">01</h1>
                <span class="flex flex-row gap-2 items-baseline">
                    <p class="text-xs">R$</p>
                    <p class="text-xl font-semibold">1.232,00</p>
                </span>
            </div>

            <span class="text-xs font-semibold">FECHADA</span>
        </div>

        <div class="bg-zinc-800 border-zinc-200 border rounded-2xl p-2 flex flex-col items-center gap-5 text-white">
            <div class="flex flex-col items-center gap-2">
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
