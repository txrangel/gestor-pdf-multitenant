<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>GPED | Gestor de Pedidos Automatizados</title>
    <meta name="description"
        content="Automatize a criação de pedidos no seu ERP com o GPED. Processe PDFs, gere JSON/CSV e integre diretamente com Protheus.">

    <!-- Favicon (adicione depois de criar a logo) -->
    <!-- <link rel="icon" href="{{ asset('favicon.ico') }}"> -->

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

<body class="bg-white dark:bg-zinc-700 antialiased">
    @if (session('sucess'))
        @include('components.alerts.sucess')
    @endif
    @if (session('error'))
        @include('components.alerts.error')
    @endif
    <!-- Navbar -->
    <nav class="bg-white dark:bg-zinc-900 w-full z-40 border-b border-zinc-200 dark:border-zinc-600 fixed top-0">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Logo + Nome -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="/" class="text-2xl font-bold text-blue-700 dark:text-blue-400">GPED</a>
                </div>

                <!-- Menu Desktop -->
                <div class="hidden md:block">
                    <div class="ml-10 flex items-center space-x-8">
                        <a href="#sobre"
                            class="text-zinc-700 dark:text-zinc-300 hover:text-blue-600 dark:hover:text-blue-400 transition">Sobre</a>
                        <a href="#servicos"
                            class="text-zinc-700 dark:text-zinc-300 hover:text-blue-600 dark:hover:text-blue-400 transition">Serviços</a>
                        <a href="#contato"
                            class="text-zinc-700 dark:text-zinc-300 hover:text-blue-600 dark:hover:text-blue-400 transition">Contato</a>
                        {{-- <a href="/login" class="text-blue-700 dark:text-blue-400 hover:underline">Login</a> --}}
                        <div id="theme-toggle"
                            class="p-2 bg-zinc-200 dark:bg-zinc-800 rounded-full shadow-md flex space-x-2">
                            <button id="theme-dark"
                                class="flex items-center justify-center w-8 h-8 rounded-full hover:bg-zinc-200 dark:hover:bg-zinc-700">
                                <i class="fas fa-moon text-l dark:text-white"></i>
                            </button>
                            <button id="theme-light"
                                class="flex items-center justify-center w-8 h-8 rounded-full hover:bg-zinc-200 dark:hover:bg-zinc-700">
                                <i class="fas fa-sun text-l dark:text-white"></i>
                            </button>
                            <button id="theme-system"
                                class="flex items-center justify-center w-8 h-8 rounded-full hover:bg-zinc-200 dark:hover:bg-zinc-700">
                                <i class="fas fa-desktop text-l dark:text-white"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Botão Contato (Mobile) -->
                <div class="md:hidden">
                    <a href="#contato"
                        class="bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium">Contato</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Conteúdo Principal -->
    <main class="pt-20">
        <!-- Seção Hero -->
        <section id="principal"
            class="py-20 bg-gradient-to-r from-blue-50 to-zinc-50 dark:from-zinc-800 dark:to-zinc-900">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid md:grid-cols-2 gap-12 items-center">
                    <div>
                        <h1 class="text-4xl md:text-5xl font-bold text-zinc-900 dark:text-white mb-6">
                            Automatize a criação de pedidos no seu ERP
                        </h1>
                        <p class="text-lg text-zinc-600 dark:text-zinc-300 mb-8">
                            O GPED transforma PDFs de pedidos em dados estruturados (JSON/CSV) e os integra
                            automaticamente ao Protheus, eliminando erros manuais e economizando tempo.
                        </p>
                        <div class="flex space-x-4">
                            <a href="#contato"
                                class="bg-blue-700 hover:bg-blue-800 text-white px-6 py-3 rounded-lg font-medium transition">
                                <i class="fas fa-paper-plane mr-2"></i> Solicitar Demonstração
                            </a>
                            <a href="#servicos"
                                class="border border-blue-700 text-blue-700 dark:text-blue-400 dark:border-blue-400 px-6 py-3 rounded-lg font-medium transition">
                                <i class="fas fa-info-circle mr-2"></i> Saiba Mais
                            </a>
                        </div>
                    </div>
                    <div class="hidden md:block">
                        <img src="{{ asset('img/dashboard.jpg') }}" alt="Dashboard GPED" class="rounded-lg shadow-xl">
                    </div>
                </div>
            </div>
        </section>

        <!-- Seção Sobre -->
        <section id="sobre" class="py-20 bg-white dark:bg-zinc-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-3xl font-bold text-zinc-900 dark:text-white">O que é o GPED?</h2>
                    <p class="mt-4 text-zinc-600 dark:text-zinc-300 max-w-3xl mx-auto">
                        O GPED é um gestor de pedidos que automatiza o processamento de arquivos PDF, extrai dados e os
                        prepara para integração com sistemas ERP como o Protheus.
                    </p>
                </div>
                <div class="grid md:grid-cols-3 gap-8">
                    <div class="bg-zinc-50 dark:bg-zinc-700 p-6 rounded-lg shadow-sm">
                        <div class="text-blue-700 dark:text-blue-400 text-3xl mb-4">
                            <i class="fas fa-file-pdf"></i>
                        </div>
                        <h3 class="text-xl font-semibold mb-2 dark:text-white">Processamento de PDFs</h3>
                        <p class="text-zinc-600 dark:text-zinc-300">
                            Extrai automaticamente dados de pedidos em PDF e os converte em formatos estruturados.
                        </p>
                    </div>
                    <div class="bg-zinc-50 dark:bg-zinc-700 p-6 rounded-lg shadow-sm">
                        <div class="text-blue-700 dark:text-blue-400 text-3xl mb-4">
                            <i class="fas fa-cogs"></i>
                        </div>
                        <h3 class="text-xl font-semibold mb-2 dark:text-white">Integração com ERP</h3>
                        <p class="text-zinc-600 dark:text-zinc-300">
                            Envia os dados diretamente para o Protheus via WebService ou gera arquivos CSV para
                            importação manual.
                        </p>
                    </div>
                    <div class="bg-zinc-50 dark:bg-zinc-700 p-6 rounded-lg shadow-sm">
                        <div class="text-blue-700 dark:text-blue-400 text-3xl mb-4">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h3 class="text-xl font-semibold mb-2 dark:text-white">Controle de Acessos</h3>
                        <p class="text-zinc-600 dark:text-zinc-300">
                            Permissões personalizadas para garantir segurança e organização no processamento de pedidos.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Seção Serviços -->
        <section id="servicos" class="py-20 bg-zinc-50 dark:bg-zinc-900">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-3xl font-bold text-zinc-900 dark:text-white">Como o GPED Funciona?</h2>
                    <p class="mt-4 text-zinc-600 dark:text-zinc-300 max-w-3xl mx-auto">
                        Veja o passo a passo para automatizar seus pedidos:
                    </p>
                </div>
                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div
                        class="bg-white dark:bg-zinc-800 p-6 rounded-lg shadow-sm border border-zinc-200 dark:border-zinc-700">
                        <div class="text-blue-700 dark:text-blue-400 text-2xl mb-4 font-bold">1</div>
                        <h3 class="text-lg font-semibold mb-2 dark:text-white">Upload do PDF</h3>
                        <p class="text-zinc-600 dark:text-zinc-300">
                            O usuário faz upload do PDF do pedido recebido do cliente.
                        </p>
                    </div>
                    <div
                        class="bg-white dark:bg-zinc-800 p-6 rounded-lg shadow-sm border border-zinc-200 dark:border-zinc-700">
                        <div class="text-blue-700 dark:text-blue-400 text-2xl mb-4 font-bold">2</div>
                        <h3 class="text-lg font-semibold mb-2 dark:text-white">Processamento Automático</h3>
                        <p class="text-zinc-600 dark:text-zinc-300">
                            O GPED extrai os dados do PDF e os converte em JSON ou CSV.
                        </p>
                    </div>
                    <div
                        class="bg-white dark:bg-zinc-800 p-6 rounded-lg shadow-sm border border-zinc-200 dark:border-zinc-700">
                        <div class="text-blue-700 dark:text-blue-400 text-2xl mb-4 font-bold">3</div>
                        <h3 class="text-lg font-semibold mb-2 dark:text-white">Integração com ERP</h3>
                        <p class="text-zinc-600 dark:text-zinc-300">
                            Os dados são enviados automaticamente para o Protheus via WebService.
                        </p>
                    </div>
                    <div
                        class="bg-white dark:bg-zinc-800 p-6 rounded-lg shadow-sm border border-zinc-200 dark:border-zinc-700">
                        <div class="text-blue-700 dark:text-blue-400 text-2xl mb-4 font-bold">4</div>
                        <h3 class="text-lg font-semibold mb-2 dark:text-white">Opção Manual</h3>
                        <p class="text-zinc-600 dark:text-zinc-300">
                            Caso necessário, o usuário pode baixar um CSV para importação manual.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Seção Contato -->
        <section id="contato" class="py-16 bg-white dark:bg-zinc-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-4">
                    <h2 class="text-3xl font-bold text-zinc-900 dark:text-white">Entre em Contato</h2>
                    <p class="mt-2 text-zinc-600 dark:text-zinc-300 max-w-3xl mx-auto">
                        Solicite uma demonstração ou tire suas dúvidas sobre o GPED.
                    </p>
                </div>
                <div class="grid md:grid-cols-2 gap-12">
                    <div class="space-y-2">
                        <h3 class="text-xl font-semibold dark:text-white mb-2">Formulário de Contato</h3>
                        <form action="{{ route('contact.submit') }}" method="POST" class="space-y-2">
                            @csrf
                            <div>
                                <label for="name"
                                    class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1">Nome</label>
                                <input type="text" id="name" name="name" required
                                    class="w-full px-4 py-2 border border-zinc-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-zinc-700 dark:border-zinc-600 dark:text-white">
                            </div>
                            <div>
                                <label for="company"
                                    class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1">Empresa</label>
                                <input type="text" id="company" name="company" required
                                    class="w-full px-4 py-2 border border-zinc-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-zinc-700 dark:border-zinc-600 dark:text-white">
                            </div>
                            <div>
                                <label for="email"
                                    class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1">E-mail</label>
                                <input type="email" id="email" name="email" required
                                    class="w-full px-4 py-2 border border-zinc-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-zinc-700 dark:border-zinc-600 dark:text-white">
                            </div>
                            <div>
                                <label for="message"
                                    class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1">Mensagem</label>
                                <textarea id="message" name="message" rows="4" maxlength="255"
                                    class="w-full px-4 py-2 border border-zinc-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-zinc-700 dark:border-zinc-600 dark:text-white resize-none"></textarea>
                            </div>
                            <button type="submit"
                                class="bg-blue-700 hover:bg-blue-800 text-white px-6 py-3 rounded-lg font-medium transition w-full">
                                <i class="fas fa-paper-plane mr-2"></i> Enviar Mensagem
                            </button>
                        </form>
                    </div>
                    <div class="space-y-6">
                        <div>
                            <h3 class="text-xl font-semibold dark:text-white mb-2">Informações de Contato</h3>
                            <a 
                                href="mailto:contato@gped.com.br" 
                                class="text-zinc-600 dark:text-zinc-300 hover:text-blue-700 dark:hover:text-blue-400 transition"
                            >
                                <i class="fas fa-envelope mr-2 text-blue-700 dark:text-blue-400"></i>
                                contato@gped.com.br
                            </a>
                            <a 
                                href="tel:+5512981491000" 
                                class="text-zinc-600 dark:text-zinc-300 hover:text-blue-700 dark:hover:text-blue-400 transition block mt-2"
                            >
                                <i class="fas fa-phone mr-2 text-blue-700 dark:text-blue-400"></i> 
                                (12) 98149-1000
                            </a>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold dark:text-white mb-2">Redes Sociais</h3>
                            <div class="flex space-x-4">
                                <a href="https://www.linkedin.com/company/3workstecnologia/" target="_blank"
                                    rel="noopener noreferrer"
                                    class="text-zinc-600 hover:text-blue-700 dark:hover:text-blue-400 transition">
                                    <i class="fab fa-linkedin text-2xl"></i>
                                </a>
                                <a href="https://wa.me/5512981491000?text=Ol%C3%A1!%20Vi%20o%20GPED%20no%20site%20e%20gostaria%20de%20saber%20mais%20sobre%20a%20automa%C3%A7%C3%A3o%20de%20pedidos.%20Podem%20me%20ajudar%3F"
                                    target="_blank" rel="noopener noreferrer"
                                    class="text-zinc-600 hover:text-blue-700 dark:hover:text-blue-400 transition">
                                    <i class="fab fa-whatsapp text-2xl"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-zinc-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">GPED</h3>
                    <p class="text-zinc-400">
                        Automatize a gestão de pedidos da sua empresa com eficiência e precisão.
                    </p>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-4">Links Rápidos</h3>
                    <ul class="space-y-2">
                        <li><a href="#sobre" class="text-zinc-400 hover:text-white transition">Sobre</a></li>
                        <li><a href="#servicos" class="text-zinc-400 hover:text-white transition">Serviços</a></li>
                        <li><a href="#contato" class="text-zinc-400 hover:text-white transition">Contato</a></li>
                        {{-- <li><a href="/login" class="text-zinc-400 hover:text-white transition">Login</a></li> --}}
                    </ul>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-4">Legal</h3>
                    <ul class="space-y-2">
                        <li><a class="text-zinc-400 hover:text-white transition">Termos de Uso</a></li>
                        <li><a class="text-zinc-400 hover:text-white transition">Política de
                                Privacidade</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-zinc-800 mt-8 pt-8 text-center text-zinc-400">
                <p>&copy; {{ date('Y') }} GPED. Todos os direitos reservados.</p>
            </div>
        </div>
    </footer>
</body>

</html>
