<x-guest-layout>
    <div class="space-y-8 bg-white dark:bg-zinc-950 dark:text-white p-4">
        <!-- Logo do cliente -->
        <div class="flex justify-center">
            <div class="h-24 w-full flex items-center justify-center">
                <img src="{{ Storage::url(tenant()->photo_path) }}" alt="{{ tenant()->name }} Logo" 
                     class="h-full object-contain max-w-full">
            </div>
        </div>

        <div class="space-y-6">
            <h1 class="text-2xl font-bold text-center text-gray-900 dark:text-white">
                Acesse sua conta
            </h1>

            <form class="space-y-5" method="POST" action="{{ route('login') }}">
                @csrf
                
                <!-- Campo Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        E-mail <span class="text-red-600 dark:text-red-400">*</span>
                    </label>
                    <input id="email" name="email" type="email" required autofocus
                        class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-1 focus:ring-primary-500 dark:focus:ring-primary-400 dark:bg-gray-800/50 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 transition-all duration-200"
                        placeholder="seu@email.com">
                </div>
                
                <!-- Campo Senha -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Senha <span class="text-red-600 dark:text-red-400">*</span>
                    </label>
                    <div class="relative">
                        <input id="password" name="password" type="password" required
                            class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-1 focus:ring-primary-500 dark:focus:ring-primary-400 dark:bg-gray-800/50 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 pr-12 transition-all duration-200"
                            placeholder="••••••••">
                        <button type="button" id="togglePassword"
                            class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-500 dark:text-gray-400 hover:text-primary-600 dark:hover:text-primary-400">
                            <i class="fas fa-eye text-lg"></i>
                        </button>
                    </div>
                </div>

                <div class="flex items-center justify-between pt-1">
                    <div class="flex items-center">
                        <input id="remember" name="remember" type="checkbox"
                            class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 dark:border-gray-600 rounded dark:bg-gray-700 transition-all duration-200">
                        <label for="remember" class="ml-2 block text-sm text-gray-700 dark:text-gray-300">
                            Lembrar-me
                        </label>
                    </div>
                    <a href="{{ route('password.request') }}" class="text-sm text-primary-600 dark:text-primary-400 hover:underline font-medium">
                        Esqueceu a senha?
                    </a>
                </div>

                <div class="pt-2">
                    <button type="submit" 
                        class="w-full flex justify-center py-3 px-4 rounded-lg shadow-sm text-sm font-medium text-white focus:outline-none focus:ring-2 focus:ring-offset-1 focus:ring-primary-500 transition-all duration-200 hover:brightness-110  bg-[color:var(--primary-color)]" style="background-color: var(--primary-color)">
                        Entrar
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>