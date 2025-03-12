<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>FlexBar</title>
    @livewireStyles
    <link rel="icon" href="{{ url('favicon.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                fontFamily: {
                    sans: ['"Open Sans"', 'sans-serif']
                },
                extend: {
                    colors: {
                        pgreen: '#B1EE81',
                        fgray: '#34373E'
                    }
                }
            }
        }
    </script>
    
</head>

<body class="bg-zinc-950">

    <div class="grid grid-cols-[110px_1fr_325px] h-screen overflow-hidden">
        @include("components.navbar")

        <div>
            <div class="grid grid-cols-[200px_1fr] bg-zinc-900">
                <section class="bg-zinc-900 h-24 flex items-center justify-center">
                    <img src="{{ asset('img/logo.png') }}" alt="Logo FlexBar" class="h-5">
                </section>

                <div class="bg-zinc-800 items-center grid grid-cols-[30px_1fr] px-4 gap-2">

                    {{-- <x-ionicon-search-sharp class="text-white" /> --}}

                    <form action="">
                        <input type="text" placeholder="NÚMERO DA COMANDA OU NOME DO CLIENTE" class="w-full bg-transparent border-0 outline-none text-sm text-white py-2 placeholder-zinc-500">
                    </form>

                </div>
            </div>

            @yield('conteudo')
        </div>

        <!-- Barra lateral direita -->
        <aside class="bg-zinc-900 h-screen">
            <div class="p-4">
                <h2 class="text-sm font-semibold text-white text-center font-['Montserrat']">QUADRAS EM USO</h2>
                <!-- <p class="text-zinc-300 text-sm text-center">Nenhuma quadra em uso neste momento.</p> -->

                <div class="flex flex-col gap-3 mt-2">
                    <div class="w-full bg-zinc-950 rounded-lg p-2 flex flex-col">
                        <div class="flex flex-row items-center justify-between border-b border-zinc-800 pb-2">
                            <div class="flex flex-row items-center gap-2">
                                <img src="/icones/ico-futebol.png" alt="">
                                <p class="text-white">Quadra 02</p>
                            </div>

                            <div class="flex flex-row items-center gap-2">
                                <span class="bg-pgreen px-2 py-[2px] rounded text-fgray">20:30</span>
                                <span class="bg-red-400 text-red-900 px-2 py-[2px] rounded">21:30</span>
                            </div>
                        </div>
                        <p class="text-zinc-500 pt-1">Time do Felipe</p>
                    </div>

                    <div class="w-full bg-zinc-950 rounded-lg p-2 flex flex-col">
                        <div class="flex flex-row items-center justify-between border-b border-zinc-800 pb-2">
                            <div class="flex flex-row items-center gap-2">
                                <img src="/icones/ico-volei.png" alt="">
                                <p class="text-white">Quadra 02</p>
                            </div>

                            <div class="flex flex-row items-center gap-2">
                                <span class="bg-pgreen px-2 py-[2px] rounded text-fgray">20:30</span>
                                <span class="bg-red-400 text-red-900 px-2 py-[2px] rounded">21:30</span>
                            </div>
                        </div>
                        <p class="text-zinc-500 pt-1">Time do Felipe</p>
                    </div>
                </div>

            </div>

            <div class="p-4">
                <h2 class="text-sm font-semibold text-white text-center font-['Montserrat']">QUADRAS LIVRES</h2>
                <p class="text-zinc-300 text-sm text-center">Nenhuma quadra em uso neste momento.</p>

                <div class="w-full bg-zinc-500 rounded-lg p-2 flex flex-col">
                    <div class="flex flex-row items-center justify-between border-b border-zinc-600 pb-2">
                        <div class="flex flex-row items-center gap-2">
                            <img src="/icones/ico-volei.png" alt="">
                            <p class="text-zinc-700">Quadra 02</p>
                        </div>
                    </div>
                    <p class="text-zinc-700 pt-1">Time do Felipe</p>
                </div>

                <a href="#" class="bg-pgreen flex text-base justify-center p-2 text-zinc-900 mt-4 select-none">Adicionar nova quadra</a>

            </div>

        </aside>

    </div>
    @livewireScripts
</body>

</html>