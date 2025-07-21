<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>GPED | Automação Inteligente de Pedidos para o seu ERP</title>
    <meta name="description"
        content="Transforme PDFs de pedidos em dados integrados ao seu ERP. Elimine erros, acelere o faturamento e libere sua equipe com a plataforma GPED.">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/83b4e7d16f.js" crossorigin="anonymous"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script>
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia(
                '(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark')
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>
</head>

<body class="bg-white dark:bg-gray-900 font-sans antialiased">
    <header
        class="bg-white/80 dark:bg-zinc-900/80 w-full z-40 border-b border-zinc-200 dark:border-zinc-700 fixed top-0 backdrop-blur-sm">
        <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" aria-label="Global">
            <div class="flex items-center justify-between h-16">
                <a href="/" class="text-2xl font-bold text-blue-700 dark:text-blue-400">GPED</a>
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#desafio"
                        class="font-medium text-gray-600 hover:text-blue-600 dark:text-gray-400 dark:hover:text-blue-500 transition-colors">A Solução</a>
                    <a href="#como-funciona"
                        class="font-medium text-gray-600 hover:text-blue-600 dark:text-gray-400 dark:hover:text-blue-500 transition-colors">Como
                        Funciona</a>
                    <a href="#faq"
                        class="font-medium text-gray-600 hover:text-blue-600 dark:text-gray-400 dark:hover:text-blue-500 transition-colors">Dúvidas</a>
                    <a href="#contato"
                        class="bg-blue-700 hover:bg-blue-800 text-white px-5 py-2 rounded-lg font-medium transition shadow-sm hover:shadow-md">
                        Agendar Demonstração
                    </a>
                </div>
                <div class="md:hidden">
                    <a href="#contato"
                        class="bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium">Contato</a>
                </div>
            </div>
        </nav>
    </header>
    <main class="pt-20">
        <section id="principal" class="bg-white dark:bg-gray-900">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
                <div class="grid md:grid-cols-2 gap-12 items-center">
                    <div class="text-left">
                        <span
                            class="inline-block bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400 text-xs font-semibold px-3 py-1 rounded-full mb-4">PLATAFORMA
                            DE AUTOMAÇÃO INTELIGENTE</span>
                        <h1
                            class="text-4xl md:text-5xl font-extrabold text-gray-900 dark:text-white leading-tight mb-6">
                            Extraia dados de PDFs <span class="text-blue-700 dark:text-blue-500">em segundos</span>, com alta precisão.
                        </h1>
                        <p class="text-lg text-gray-600 dark:text-gray-300 mb-8 max-w-xl">
                            O GPED lê seus pedidos em PDF, extrai os dados com precisão e os lança no seu ERP (Protheus
                            e
                            outros) em segundos.
                            Pare de perder tempo e dinheiro com erros manuais.
                        </p>
                        <a href="#contato"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold text-lg px-8 py-4 rounded-lg shadow-lg hover:shadow-blue-500/30 transition-all transform hover:-translate-y-1">
                            Agendar Demo <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                    <div>
                        <img src="{{ asset('img/dashboard.png') }}" alt="Animação do processo GPED: PDF para ERP"
                            class="rounded-xl shadow-2xl ring-1 ring-gray-200 dark:ring-gray-700">
                    </div>
                </div>
            </div>
        </section>
        <section class="bg-gray-50 dark:bg-gray-800 py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <p class="text-center text-sm font-semibold text-gray-600 dark:text-gray-400 mb-12">CONFIANÇA DE
                    EMPRESAS QUE LIDERAM SEUS MERCADOS</p>
                <div class="relative">
                    <div class="swiper logo-swiper">
                        <div class="swiper-wrapper items-center grayscale opacity-70">
                            <div class="swiper-slide text-center">
                                <img class="h-16 inline-block" src="{{ asset('img/kobber.png') }}" alt="Kobber">
                            </div>
                        </div>
                    </div>
                    {{-- <div
                        class="swiper-button-prev absolute top-1/2 left-0 transform -translate-y-1/2 -translate-x-8 text-blue-600 dark:text-blue-400 bg-white dark:bg-gray-800 rounded-full w-12 h-12 flex items-center justify-center shadow-lg cursor-pointer hover:bg-blue-50 dark:hover:bg-gray-700 transition">
                        <i class="fas fa-chevron-left"></i>
                    </div>
                    <div
                        class="swiper-button-next absolute top-1/2 right-0 transform -translate-y-1/2 translate-x-8 text-blue-600 dark:text-blue-400 bg-white dark:bg-gray-800 rounded-full w-12 h-12 flex items-center justify-center shadow-lg cursor-pointer hover:bg-blue-50 dark:hover:bg-gray-700 transition">
                        <i class="fas fa-chevron-right"></i>
                    </div> --}}
                </div>
            </div>
        </section>
        <section id="desafio" class="bg-white dark:bg-gray-900 py-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white">Chega de processos
                        quebrados.</h2>
                    <p class="mt-4 text-lg text-gray-600 dark:text-gray-300 max-w-3xl mx-auto">Sua operação comercial
                        merece mais do que tarefas repetitivas e propensas a erros.</p>
                </div>
                <div class="grid md:grid-cols-2 gap-8">
                    <div
                        class="bg-gray-50 dark:bg-gray-800/50 p-8 rounded-2xl border border-red-200 dark:border-red-900/50">
                        <h3 class="text-2xl font-bold text-red-600 dark:text-red-500 mb-4">O processo manual</h3>
                        <ul class="space-y-4 text-gray-700 dark:text-gray-300">
                            <li class="flex items-start"><i
                                    class="fas fa-times-circle text-red-500 mt-1 mr-3"></i><span>Horas perdidas com
                                    digitação e conferência de pedidos.</span></li>
                            <li class="flex items-start"><i
                                    class="fas fa-times-circle text-red-500 mt-1 mr-3"></i><span>Erros de digitação que
                                    geram devoluções e prejuízos.</span></li>
                            <li class="flex items-start"><i
                                    class="fas fa-times-circle text-red-500 mt-1 mr-3"></i><span>Falta de visibilidade
                                    e atraso no faturamento.</span></li>
                            <li class="flex items-start"><i
                                    class="fas fa-times-circle text-red-500 mt-1 mr-3"></i><span>Equipe de alto custo
                                    focada em tarefas de baixo valor.</span></li>
                        </ul>
                    </div>
                    <div
                        class="bg-gray-50 dark:bg-gray-800/50 p-8 rounded-2xl border border-green-200 dark:border-green-900/50">
                        <h3 class="text-2xl font-bold text-green-600 dark:text-green-500 mb-4">A revolução do GPED</h3>
                        <ul class="space-y-4 text-gray-700 dark:text-gray-300">
                            <li class="flex items-start"><i
                                    class="fas fa-check-circle text-green-500 mt-1 mr-3"></i><span>Processamento de
                                    pedidos em minutos, não em horas.</span></li>
                            <li class="flex items-start"><i
                                    class="fas fa-check-circle text-green-500 mt-1 mr-3"></i><span>Precisão de 99.9%
                                    com IA e possibilidade de pré-validação.</span></li>
                            <li class="flex items-start"><i
                                    class="fas fa-check-circle text-green-500 mt-1 mr-3"></i><span>Integração direta
                                    com o Protheus e outros ERPs.</span></li>
                            <li class="flex items-start"><i
                                    class="fas fa-check-circle text-green-500 mt-1 mr-3"></i><span>Libere sua equipe
                                    para focar em vendas e estratégia.</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <section id="como-funciona" class="bg-gray-50 dark:bg-gray-800 py-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white">Automação em 3 Passos
                        Simples</h2>
                    <p class="mt-4 text-lg text-gray-600 dark:text-gray-300">Veja como é fácil transformar sua
                        operação.</p>
                </div>
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div class="text-center p-6">
                        <div
                            class="flex justify-center items-center mx-auto h-20 w-20 rounded-full bg-blue-100 dark:bg-blue-900/50 mb-6 ring-8 ring-blue-50 dark:ring-blue-900/20">
                            <i class="fas fa-upload text-3xl text-blue-600 dark:text-blue-400"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">1. Upload do PDF</h3>
                        <p class="mt-2 text-gray-600 dark:text-gray-400">Suba o arquivo PDF para a plataforma.</p>
                    </div>
                    <div class="text-center p-6">
                        <div
                            class="flex justify-center items-center mx-auto h-20 w-20 rounded-full bg-blue-100 dark:bg-blue-900/50 mb-6 ring-8 ring-blue-50 dark:ring-blue-900/20">
                            <i class="fas fa-robot text-3xl text-blue-600 dark:text-blue-400"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">2. Extração com IA</h3>
                        <p class="mt-2 text-gray-600 dark:text-gray-400">Nossa IA lê, interpreta e estrutura todos os
                            dados do PDF em segundos.</p>
                    </div>
                    <div class="text-center p-6">
                        <div
                            class="flex justify-center items-center mx-auto h-20 w-20 rounded-full bg-blue-100 dark:bg-blue-900/50 mb-6 ring-8 ring-blue-50 dark:ring-blue-900/20">
                            <i class="fas fa-cogs text-3xl text-blue-600 dark:text-blue-400"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">3. Integração Direta</h3>
                        <p class="mt-2 text-gray-600 dark:text-gray-400">Os dados ficam disponiveis automaticamente
                            para seu ERP, prontos para a integração.</p>
                    </div>
                </div>
            </div>
        </section>
        <section id="faq" class="bg-white dark:bg-gray-900 py-24">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white">Perguntas Frequentes</h2>
                </div>
                <div class="space-y-4" x-data="{ open: 1 }">
                    <div class="bg-gray-50 dark:bg-gray-800 p-5 rounded-lg">
                        <button @click="open = (open === 1 ? null : 1)"
                            class="w-full flex justify-between items-center text-left font-semibold text-lg text-gray-800 dark:text-gray-100">
                            <span>O GPED integra com ERPs além do Protheus?</span>
                            <i class="fas" :class="open === 1 ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                        </button>
                        <div x-show="open === 1" x-collapse class="mt-4 text-gray-600 dark:text-gray-300">
                            <p>Sim! Embora nossa integração principal seja com o Protheus via WebService, o GPED pode
                                gerar arquivos (CSV, JSON) em layouts customizados para se adaptar a qualquer sistema
                                ERP do mercado. Também podemos desenvolver integrações diretas sob demanda.</p>
                        </div>
                    </div>
                    <div class="bg-gray-50 dark:bg-gray-800 p-5 rounded-lg">
                        <button @click="open = (open === 2 ? null : 2)"
                            class="w-full flex justify-between items-center text-left font-semibold text-lg text-gray-800 dark:text-gray-100">
                            <span>Como funciona a segurança dos meus dados?</span>
                            <i class="fas" :class="open === 2 ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                        </button>
                        <div x-show="open === 2" x-collapse class="mt-4 text-gray-600 dark:text-gray-300">
                            <p>A segurança é nossa prioridade. Utilizamos criptografia de ponta para todos os dados em trânsito. A arquitetura multi-tenant garante que os dados de
                                cada cliente sejam completamente isolados e seguros.</p>
                        </div>
                    </div>
                    <div class="bg-gray-50 dark:bg-gray-800 p-5 rounded-lg">
                        <button @click="open = (open === 3 ? null : 3)"
                            class="w-full flex justify-between items-center text-left font-semibold text-lg text-gray-800 dark:text-gray-100">
                            <span>A implantação demora?</span>
                            <i class="fas" :class="open === 3 ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                        </button>
                        <div x-show="open === 3" x-collapse class="mt-4 text-gray-600 dark:text-gray-300">
                            <p>É surpreendentemente rápido. A configuração básica e o treinamento levam poucas horas.
                                Nossa equipe de sucesso do cliente acompanha todo o processo para garantir uma transição
                                suave e que você comece a ver os resultados o mais rápido possível.</p>
                        </div>
                    </div>
                    <div class="bg-gray-50 dark:bg-gray-800 p-5 rounded-lg">
                        <button @click="open = (open === 4 ? null : 4)"
                            class="w-full flex justify-between items-center text-left font-semibold text-lg text-gray-800 dark:text-gray-100">
                            <span>A extração de dados é 100% precisa?</span>
                            <i class="fas" :class="open === 4 ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                        </button>
                        <div x-show="open === 4" x-collapse class="mt-4 text-gray-600 dark:text-gray-300">
                            <p>Nossa IA é treinada para ter altíssima precisão na leitura de layouts de pedidos. Para
                                garantir a confiabilidade, o sistema permite uma etapa de validação humana opcional,
                                onde o usuário pode revisar os dados extraídos antes do envio final ao ERP.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="contato" class="bg-gray-50 dark:bg-gray-800 py-24">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white">Vamos conversar?</h2>
                    <p class="mt-4 text-lg text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                        Agende uma demonstração sem compromisso e veja com seus próprios olhos como o GPED pode
                        revolucionar sua operação.
                    </p>
                </div>
                <div class="mt-12 bg-white dark:bg-gray-900 p-8 md:p-12 rounded-2xl shadow-xl">
                    <form action="{{ route('contact.submit') }}" method="POST" class="space-y-6">
                        @csrf
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label for="name"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nome</label>
                                <input type="text" id="name" name="name" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                            </div>
                            <div>
                                <label for="company"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Empresa</label>
                                <input type="text" id="company" name="company" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                            </div>
                        </div>
                        <div>
                            <label for="email"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">E-mail
                                Corporativo</label>
                            <input type="email" id="email" name="email" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                        </div>
                        <div>
                            <label for="message"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Mensagem
                                (opcional)</label>
                            <textarea id="message" name="message" rows="4"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:text-white resize-none"></textarea>
                        </div>
                        <button type="submit"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold text-lg px-8 py-4 rounded-lg shadow-lg hover:shadow-blue-500/30 transition-all transform hover:-translate-y-1">
                            <i class="fas fa-paper-plane mr-2"></i> Enviar e Agendar Demo
                        </button>
                    </form>
                </div>
            </div>
        </section>
    </main>
    <footer class="bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid md:grid-cols-4 gap-8">
                <div class="col-span-2">
                    <a class="flex-none text-2xl font-bold text-white" href="/">GPED</a>
                    <p class="mt-3 text-gray-400">Automação Inteligente de Pedidos para o seu ERP.</p>
                    <p class="text-xs mt-2 text-gray-500">GPED TECNOLOGIA LTDA - 19.035.962/0001-04</p>
                </div>
                <div>
                    <h4 class="text-sm font-semibold text-gray-200 uppercase">Navegação</h4>
                    <ul class="mt-3 space-y-2">
                        <li><a href="#desafio" class="text-gray-400 hover:text-blue-500">A Solução</a></li>
                        <li><a href="#como-funciona" class="text-gray-400 hover:text-blue-500">Como Funciona</a></li>
                        <li><a href="#faq" class="text-gray-400 hover:text-blue-500">FAQ</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-sm font-semibold text-gray-200 uppercase">Contato</h4>
                    <ul class="mt-3 space-y-2">
                        <li><a href="mailto:contato@gped.com.br"
                                class="text-gray-400 hover:text-blue-500">contato@gped.com.br</a></li>
                        <li><a href="tel:+5512981491000" class="text-gray-400 hover:text-blue-500">(12) 98149-1000</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="mt-8 pt-8 border-t border-gray-800 flex justify-between items-center">
                <p class="text-sm text-gray-500">&copy; {{ date('Y') }} GPED. Todos os direitos reservados.</p>
                <div class="flex space-x-4">
                    <a target="_blank" href="https://www.linkedin.com/company/3workstecnologia/" class="text-gray-500 hover:text-blue-500"><i
                            class="fab fa-linkedin"></i></a>
                    <a target="_blank" href="https://wa.me/5512981491000?text=Ol%C3%A1!%20Vi%20o%20GPED%20no%20site%20e%20gostaria%20de%20saber%20mais%20sobre%20a%20automa%C3%A7%C3%A3o%20de%20pedidos.%20Podem%20me%20ajudar%3F" class="text-gray-500 hover:text-blue-500"><i
                            class="fab fa-whatsapp"></i></a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
