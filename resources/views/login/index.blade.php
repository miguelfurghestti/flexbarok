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


    <div class="flex flex-col items-center gap-7">
        <img class="w-1/3" src="img/logo-large.png" alt="">

        <div class="bg-zinc-800 rounded-xl p-8 w-[420px] border border-zinc-500">
            <h1 class="text-white text-2xl font-semibold mb-5">Faça o seu acesso</h1>
            <form method="POST" class="flex flex-col gap-3" action="{{ route('login') }}">
                @csrf

                <div class="flex flex-col gap-2">
                    <span class="text-white text-sm font-semibold">Seu email*</span>
                    <input type="email" name="email" id="email" class="rounded-md p-3 text-base bg-zinc-600 text-zinc-200 placeholder-zinc-400 border border-zinc-500" placeholder="Digite seu email" required>
                </div>

                <div class="flex flex-col gap-2">
                    <span class="text-white text-sm font-semibold">Senha*</span>
                    <input type="password" name="password" id="password" class="rounded-md p-3 text-base bg-zinc-600 text-zinc-200 placeholder-zinc-400 border border-zinc-500" placeholder="Sua senha" required>
                </div>

                <button type="submit" class="bg-pgreen text-green-950 font-semibold rounded-md p-2 mt-5">Acessar</button>
                <span class="text-zinc-300 text-sm">Perdeu o seu acesso? Entre em contato <a href="#" class="font-semibold text-pgreen">aqui</a></span>
            </form>
        </div>

       

        @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    </div>

</body>
</html>