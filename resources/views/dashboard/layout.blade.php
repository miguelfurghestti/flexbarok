<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>FlexBar</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">

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

    <div class="grid grid-cols-[110px_1fr_325px] h-screen">
        @include("components.navbar")

        <div>
            <div class="grid grid-cols-[200px_1fr] py-9 bg-zinc-900">
                <section class="bg-zinc-900 flex justify-center">
                    <img src="img/logo.png" alt="Logo FlexBar">
                </section>

                <div>
                    Pesquisa
                </div>
            </div>

            <main>
                @yield('conteudo')
            </main>
        </div>

        <!-- Barra lateral direita -->
        <aside class="bg-zinc-900">
            <div class="p-4">
                <h2 class="text-lg font-semibold">Informações</h2>
                <p>Este é o painel da direita.</p>
            </div>
        </aside>

    </div>
</body>

</html>
