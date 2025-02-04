@extends('shop.layout')

@section('conteudo')

<div class="fixed inset-0 bg-black bg-opacity-70 backdrop-blur-sm flex items-center justify-center z-50">
    <div class="bg-zinc-900 p-6 rounded-xl shadow-xl text-center flex flex-col items-center w-3/12">
        <h2 class="text-lg font-semibold mb-4 text-white flex flex-row gap-2 items-center">
            <x-heroicon-o-rocket-launch class="w-5 h-5 text-pgreen group-hover:text-white transition duration-300" stroke-width="2" /> 
            <span>Finalize seu cadastro</span>
        </h2>
        <p class="text-zinc-400 mb-6">Preencha com os dados da sua empresa.</p>
        
        <div class="flex flex-col gap-2">
            <div class="flex flex-col w-full gap-1">
                <span class="text-zinc-300 text-xs text-left">Nome da empresa</span>
                <input type="text" placeholder="Digite o nome da sua empresa" class="rounded-md p-2">
            </div>

            <div class="flex flex-row w-full gap-1 justify-between">
                <div class="flex flex-col">
                    <span class="text-zinc-300 text-xs text-left">Fone</span>
                    <input type="text" placeholder="Telefone comercial" class="rounded-md p-2" required>
                </div>

                <div class="flex flex-col">
                    <span class="text-zinc-300 text-xs text-left">E-mail</span>
                    <input type="email" placeholder="E-mail" class="rounded-md p-2" required>
                </div>
            </div>

            <div class="flex w-full gap-2">
                <div class="flex flex-col w-full">
                    <label class="text-zinc-300 text-xs text-left">Endereço</label>
                    <input type="text" placeholder="Endereço" class="rounded-md p-2 w-full" required>
                </div>
            
                <div class="flex flex-col w-auto">
                    <label class="text-zinc-300 text-xs text-left">Nº</label>
                    <input type="text" placeholder="1234" class="rounded-md p-2 w-14" required>
                </div>
            </div>

        </div>

        
        <button 
            class="bg-pgreen text-black px-4 py-2 rounded-lg hover:bg-white transition mt-4"
            onclick="window.location.href='#'">
             Cadastrar
        </button>
    </div>
</div>

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