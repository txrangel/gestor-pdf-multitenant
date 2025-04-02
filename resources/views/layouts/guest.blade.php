<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="{{ session('theme', 'light') === 'dark' ? 'dark' : '' }}">
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

        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const htmlElement = document.documentElement;
                const themeDropdown = document.getElementById('theme-dropdown');

                // Função para atualizar o tema com base na escolha do usuário
                function setTheme(theme) {
                    if (theme === 'dark') {
                        htmlElement.classList.add('dark');
                        localStorage.setItem('theme', 'dark');
                    } else if (theme === 'light') {
                        htmlElement.classList.remove('dark');
                        localStorage.setItem('theme', 'light');
                    } else {
                        localStorage.removeItem('theme'); // Remove preferência para seguir o sistema
                        if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
                            htmlElement.classList.add('dark');
                        } else {
                            htmlElement.classList.remove('dark');
                        }
                    }
                }

                // Aplica o tema salvo ou segue o sistema
                if (localStorage.getItem('theme')) {
                    setTheme(localStorage.getItem('theme'));
                } else {
                    setTheme('system');
                }

                // Evento para cada botão do menu suspenso
                document.getElementById('theme-dark').addEventListener('click', () => setTheme('dark'));
                document.getElementById('theme-light').addEventListener('click', () => setTheme('light'));
                document.getElementById('theme-system').addEventListener('click', () => setTheme('system'));

                // Mostrar/Ocultar o menu suspenso ao passar o mouse
                document.getElementById('theme-toggle').addEventListener('mouseenter', () => {
                    themeDropdown.classList.remove('hidden');
                });

                document.getElementById('theme-toggle').addEventListener('mouseleave', () => {
                    themeDropdown.classList.add('hidden');
                });
            });
        </script>
    </head>
    <body class="fi-body fi-panel-app min-h-screen bg-white font-normal text-zinc-950 antialiased dark:bg-zinc-950 dark:text-white">
        <div class="fi-simple-layout flex min-h-screen flex-col items-center">
            <div id="theme-toggle" class="absolute top-2 right-2 p-2 bg-zinc-200 dark:bg-zinc-800 rounded-full shadow-md flex space-x-2">
                <button id="theme-dark" class="flex items-center justify-center w-8 h-8 rounded-full hover:bg-zinc-200 dark:hover:bg-zinc-700">
                    <i class="fas fa-moon text-l"></i>
                </button>
                <button id="theme-light" class="flex items-center justify-center w-8 h-8 rounded-full hover:bg-zinc-200 dark:hover:bg-zinc-700">
                    <i class="fas fa-sun text-l"></i>
                </button>
                <button id="theme-system" class="flex items-center justify-center w-8 h-8 rounded-full hover:bg-zinc-200 dark:hover:bg-zinc-700">
                    <i class="fas fa-desktop text-l"></i>
                </button>
            </div>
            <div class="fi-simple-main-ctn flex w-full flex-grow items-center justify-center">
                <main class="fi-simple-main my-16 w-full bg-white px-6 py-12 shadow-sm ring-1 ring-zinc-950/5 dark:bg-zinc-900 dark:ring-white/10 sm:rounded-xl sm:px-12 max-w-lg">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>
