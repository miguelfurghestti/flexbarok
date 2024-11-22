<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>FlexBar</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
          theme: {
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

    @yield('conteudo')

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