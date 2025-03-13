@extends('shop.layout')

@section('conteudo')
<main class="flex flex-col p-4 gap-5 font-['Montserrat'] h-screen overflow-y-scroll [&::-webkit-scrollbar]:w-2
  [&::-webkit-scrollbar-track]:bg-gray-100
  [&::-webkit-scrollbar-thumb]:bg-gray-300
  dark:[&::-webkit-scrollbar-track]:bg-neutral-700
  dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500 pb-28">

  <livewire:product-categories wire:lazy />
  
</main>
<script>
    Livewire.on('productCategoryAdded', () => {
        // Força a atualização do componente
        Livewire.dispatch('refreshComponent');
    });
  </script>
@endsection