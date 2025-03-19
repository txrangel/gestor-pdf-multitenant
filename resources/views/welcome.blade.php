<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <script src="https://kit.fontawesome.com/83b4e7d16f.js" crossorigin="anonymous"></script>
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen bg-zinc-300 dark:bg-zinc-700 p-4">
        <!-- Conteúdo Principal -->
        <main class="transition-all duration-300 ease-in-out pl-12 md:pl-48">
            <div class="text-white">
                @if(tenant())
                    <h1>Bem vindo a empresa {{tenant()->name}}</h1>
                    <a href="/app" class="text-blue-500 underline underline-offset-2">Acessar Painel</a>
                @else
                    <h1>Bem vindo a gestão de empresas.</h1>
                    <a href="/admin" class="text-blue-500 underline underline-offset-2">Acessar Painel</a>
                @endif
            </div>
        </main>
    </body>
</html>