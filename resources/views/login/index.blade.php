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
<body class="bg-zinc-950 flex items-center justify-center h-screen">


    <div class="bg-zinc-800 rounded-xl p-6 w-96 border border-zinc-500">
        <h1 class="text-white text-xl font-medium mb-5">Faça o seu acesso</h1>
        <form action="" class="flex flex-col gap-3">
            <div class="flex flex-col">
                <span class="text-white">Email*</span>
                <input type="text" class="rounded p-2 text-sm" placeholder="Digite seu email">
            </div>

            <div class="flex flex-col">
                <span class="text-white">Senha*</span>
                <input type="password" class="rounded p-2 text-sm" placeholder="Sua senha">
            </div>

            <button class="bg-zinc-600 text-white font-medium rounded p-2 mt-5">Acessar FlexBar</button>
        </form>
    </div>

</body>
</html>