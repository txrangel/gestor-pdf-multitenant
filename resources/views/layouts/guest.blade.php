<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    class="{{ session('theme', 'light') === 'dark' ? 'dark' : '' }}">

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

<body class="fi-body fi-panel-app min-h-screen font-normal antialiased">
    <div class="fi-simple-layout flex min-h-screen flex-col items-center">
        <!-- Botões de tema flutuantes -->
        <div id="theme-toggle"
            class="fixed top-4 right-4 p-2 bg-white/80 dark:bg-zinc-800/80 rounded-full shadow-md flex space-x-2 z-50 backdrop-blur-sm border border-white/20 dark:border-zinc-700/50">
            <button id="theme-dark" title="Modo escuro"
                class="flex items-center justify-center w-8 h-8 rounded-full hover:bg-zinc-100 dark:hover:bg-zinc-700 transition-colors duration-200">
                <i class="fas fa-moon text-zinc-600 dark:text-zinc-300"></i>
            </button>
            <button id="theme-light" title="Modo claro"
                class="flex items-center justify-center w-8 h-8 rounded-full hover:bg-zinc-100 dark:hover:bg-zinc-700 transition-colors duration-200">
                <i class="fas fa-sun text-zinc-600 dark:text-zinc-300"></i>
            </button>
            <button id="theme-system" title="Seguir sistema"
                class="flex items-center justify-center w-8 h-8 rounded-full hover:bg-zinc-100 dark:hover:bg-zinc-700 transition-colors duration-200">
                <i class="fas fa-desktop text-zinc-600 dark:text-zinc-300"></i>
            </button>
        </div>

        <!-- Conteúdo principal -->
        <div class="w-full flex flex-grow items-center justify-center bg-[color:var(--primary-color-75)]" style="background-color: var(--primary-color-75)">
            <main class="w-full max-w-md rounded-2xl shadow-xl overflow-hidden backdrop-blur-md transition-all duration-300 hover:shadow-2xl">
                {{ $slot }}
            </main>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const htmlElement = document.documentElement;
            
            // Aplica cores do tenant dinamicamente
            function updateTenantColors() {
                const primary = "{{ tenant()->primary_color ?? '#4f46e5' }}";
                const primary75 = "{{ tenant()->primary_color ? Illuminate\Support\Str::finish(tenant()->primary_color, 'bf') : '#4f46e5bf' }}";
                const secondary = "{{ tenant()->secundary_color ?? '#ec4899' }}";
                
                document.documentElement.style.setProperty('--primary-color', primary);
                document.documentElement.style.setProperty('--primary-color-75', primary75);
                document.documentElement.style.setProperty('--secondary-color', secondary);
            }
            
            // Função para aplicar o tema
            function applyTheme(theme) {
                if (theme === 'dark') {
                    htmlElement.classList.add('dark');
                    localStorage.setItem('theme', 'dark');
                } else if (theme === 'light') {
                    htmlElement.classList.remove('dark');
                    localStorage.setItem('theme', 'light');
                } else {
                    localStorage.removeItem('theme');
                    if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
                        htmlElement.classList.add('dark');
                    } else {
                        htmlElement.classList.remove('dark');
                    }
                }
                updateTenantColors();
            }

            // Configuração inicial
            updateTenantColors();
            const savedTheme = localStorage.getItem('theme');
            if (savedTheme) {
                applyTheme(savedTheme);
            } else {
                applyTheme('system');
            }

            // Event listeners para os botões
            document.getElementById('theme-dark').addEventListener('click', () => applyTheme('dark'));
            document.getElementById('theme-light').addEventListener('click', () => applyTheme('light'));
            document.getElementById('theme-system').addEventListener('click', () => applyTheme('system'));

            // Alternar visibilidade da senha
            const togglePassword = document.querySelector('#togglePassword');
            if (togglePassword) {
                togglePassword.addEventListener('click', function() {
                    const password = document.querySelector('#password');
                    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                    password.setAttribute('type', type);
                    
                    const icon = this.querySelector('i');
                    icon.classList.toggle('fa-eye');
                    icon.classList.toggle('fa-eye-slash');
                });
            }
        });
    </script>
</body>
</html>