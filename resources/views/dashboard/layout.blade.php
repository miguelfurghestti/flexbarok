<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>FlexBar</title>
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
                    sans: ['"PT Sans"', 'sans-serif']
                },
                extend: {
                    colors: {
                        pgreen: '#B1EE81',
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
                    <img src="img/logo.png" alt="Logo FlexBar" class="h-5">
                </section>

                <div class="bg-zinc-800 items-center grid grid-cols-[30px_1fr] px-4 gap-2">

                    <x-ionicon-search-sharp class="text-white" />

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
                <h2 class="text-lg font-semibold">Informações</h2>
                <p>Este é o painel da direita.</p>
            </div>
        </aside>

    </div>
</body>

</html>
