@extends('shop.layout')

@section('conteudo')

<div class="fixed inset-0 bg-black bg-opacity-70 backdrop-blur-sm flex items-center justify-center z-50">
    <div class="bg-zinc-900 p-6 rounded-xl shadow-xl text-center flex flex-col items-center">
        <h2 class="text-lg font-semibold mb-4 text-white flex flex-row gap-2 items-center">
            <x-heroicon-o-rocket-launch class="w-5 h-5 text-pgreen group-hover:text-white transition duration-300" stroke-width="2" /> 
            <span>Finalize seu cadastro</span>
        </h2>
        <p class="text-zinc-400 mb-6">Preencha com os dados da sua empresa.</p>
        
        <form action="{{ route('shop.store') }}" method="post">
            @csrf

        
        <div class="flex flex-col gap-2 w-full">
            <div class="flex flex-col w-full gap-1">
                <span class="text-zinc-300 text-xs text-left">Nome da empresa*</span>
                <input type="text" name="name" placeholder="Digite o nome da sua empresa" class="rounded-md p-2" required>
            </div>

            <div class="flex flex-col w-full gap-1">
                <span class="text-zinc-300 text-xs text-left">CNPJ*</span>
                <input type="text" name="cnpj" placeholder="00.000.000/0000-00" class="rounded-md p-2" required>
            </div>

            <div class="flex flex-row w-full gap-2 justify-between">
                <div class="flex flex-col w-auto">
                    <span class="text-zinc-300 text-xs text-left">Fone</span>
                    <input type="text" name="phone" placeholder="Telefone" class="rounded-md p-2 w-36" required>
                </div>

                <div class="flex flex-col w-full">
                    <span class="text-zinc-300 text-xs text-left">E-mail</span>
                    <input type="email" name="email" placeholder="E-mail" class="rounded-md p-2 w-full" required>
                </div>
            </div>

            <div class="flex w-full gap-2">
                <div class="flex flex-col w-full">
                    <label class="text-zinc-300 text-xs text-left">Endereço</label>
                    <input type="text" name="address" placeholder="Endereço" class="rounded-md p-2 w-full" required>
                </div>
            
                <div class="flex flex-col w-auto">
                    <label class="text-zinc-300 text-xs text-left">Nº</label>
                    <input type="text" name="number" placeholder="1234" class="rounded-md p-2 w-14" required>
                </div>
            </div>

            <div class="flex w-full gap-2">
                <div class="flex flex-col w-full">
                    <label class="text-zinc-300 text-xs text-left">Cidade</label>
                    <input type="text" name="city" placeholder="Cidade" class="rounded-md p-2" required>
                </div>
            
                <div class="flex flex-col w-full">
                    <label class="text-zinc-300 text-xs text-left">Site</label>
                    <input type="text" name="website" placeholder="www.site.com.br" class="rounded-md p-2">
                </div>
            </div>

            <label class="text-zinc-300 text-sm text-center">Funcionamento do seu estabelecimento:</label>

            <div class="flex w-full gap-8 items-center justify-center">
                
                <div class="inline-flex items-center">
                  <label class="relative flex cursor-pointer items-center rounded-full p-2" for="on" data-ripple-dark="true">
                    <input
                      name="type_sell"
                      type="radio"
                      class="peer h-5 w-5 cursor-pointer appearance-none rounded-full border border-slate-300 checked:border-slate-400 transition-all"
                      id="mesas"
                      value="mesas"
                    />
                    <span class="absolute bg-pgreen w-3 h-3 rounded-full opacity-0 peer-checked:opacity-100 transition-opacity duration-200 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2"></span>
                  </label>

                  <label class="text-white cursor-pointer text-sm" for="on">Mesas</label>
                </div>

                <div class="inline-flex items-center">
                  <label class="relative flex cursor-pointer items-center rounded-full p-2" for="off">
                    <input
                      name="type_sell"
                      type="radio"
                      class="peer h-5 w-5 cursor-pointer appearance-none rounded-full border border-slate-300 checked:border-slate-400 transition-all"
                      id="comandas"
                      value="comandas"
                    />
                    <span class="absolute bg-pgreen w-3 h-3 rounded-full opacity-0 peer-checked:opacity-100 transition-opacity duration-200 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2"></span>
                  </label>
                  <label class="text-white cursor-pointer text-sm" for="off">Comandas</label>
                </div>
              </div>

        </div>
        
        <button type="submit" class="bg-pgreen text-black px-4 py-2 rounded-lg hover:bg-white transition mt-4">
             Cadastrar
        </button>
    </form>
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