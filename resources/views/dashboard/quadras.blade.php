@extends('dashboard.layout')

@section('conteudo')
<main class="flex flex-col p-4 gap-5 font-['Montserrat'] h-screen overflow-y-scroll [&::-webkit-scrollbar]:w-2
  [&::-webkit-scrollbar-track]:bg-gray-100
  [&::-webkit-scrollbar-thumb]:bg-gray-300
  dark:[&::-webkit-scrollbar-track]:bg-neutral-700
  dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500 pb-28">

    <div class="flex flex-row justify-between">
        <h1 class="text-white text-2xl font-['Open Sans']">Quadras</h1>
        <a href="/quadras/nova-quadra" class="bg-pgreen flex flex-row gap-2 px-3 py-2 rounded-lg items-center font-['Open Sans'] font-semibold text-sm select-none">
            <x-tabler-square-plus />
            Cadastrar Quadra
        </a>
    </div>

    <div class="flex flex-col gap-3">

        @for($i=1; $i<=10; $i++)
            <div class="flex flex-row justify-between w-full items-center bg-zinc-900 rounded-lg px-2 py-3">
            <span class="flex flex-row w-full gap-2">
                <img src="/icones/icon-soccer.png" alt="">
                <p class="text-white">Quadra Fut 01</p>
            </span>

            <div class="flex flex-row gap-2">
                <span class="text-white flex flex-row gap-1 items-center">
                    <x-tabler-edit stroke-width="1" class="text-pgreen" /> Editar
                </span>
                <span class="text-white flex flex-row gap-1 items-center">
                    <x-tabler-trash stroke-width="1" class="text-red-400" /> Excluir
                </span>
            </div>
    </div>
    @endfor

    </div>



</main>
@endsection