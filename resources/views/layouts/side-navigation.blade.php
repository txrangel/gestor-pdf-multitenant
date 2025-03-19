{{-- <!-- Botão para abrir/fechar o menu -->
<input type="checkbox" id="menu-toggle" class="hidden peer">

<label for="menu-toggle" class="fixed left-0 top-0 p-2 block md:hidden z-50 cursor-pointer">
    <div class="p-4 flex items-center justify-center transition-all duration-300 ease-in-out h-10 w-10 bg-zinc-800 text-white rounded-md">
        <i class="w-4 fa-solid fa-bars"></i>
    </div>
</label> --}}

<!-- Sidebar -->
<aside class="bg-zinc-900 text-white h-full fixed left-0 top-0 overflow-y-auto transition-all duration-300 ease-in-out w-12 peer-checked:w-48 md:w-48">
    <div class="p-4 flex items-center justify-between">
        <h2 class="text-2xl font-bold hidden md:block">Menu</h2>
    </div>
    <nav class="">
        <ul>
            <!-- Link para a home -->
            <li class="px-4 py-2 hover:bg-zinc-800 flex items-center">
                <a href="{{ route('dashboard') }}" class="block flex items-center space-x-2 w-full">
                    <i class="w-4 fa-solid fa-house"></i>
                    <span class="hidden peer-checked:inline md:inline">Home</span>
                </a>
            </li>
            <!-- Link para a lista de usuários -->
            @can('viewAny', App\Models\User::class)
                <li class="px-4 py-2 hover:bg-zinc-800 flex items-center">
                    <a href="{{ route('users.index') }}" class="block flex items-center space-x-2 w-full">
                        <i class="w-4 fa-solid fa-user-group"></i>
                        <span class="hidden peer-checked:inline md:inline">Usuários</span>
                    </a>
                </li>
            @endcan

            <!-- Link para a lista de perfis -->
            @can('viewAny', App\Models\Profile::class)
                <li class="px-4 py-2 hover:bg-zinc-800 flex items-center">
                    <a href="{{ route('profiles.index') }}" class="block flex items-center space-x-2 w-full">
                        <i class="w-4 fa-solid fa-users-rectangle"></i>
                        <span class="hidden md:inline">Perfis</span>
                    </a>
                </li>
            @endcan

            <!-- Link para a lista de permissões -->
            @can('viewAny', App\Models\Permission::class)
                <li class="px-4 py-2 hover:bg-zinc-800 flex items-center">
                    <a href="{{ route('permissions.index') }}" class="block flex items-center space-x-2 w-full">
                        <i class="w-4 fa-solid fa-lock"></i>
                        <span class="hidden md:inline">Permissões</span>
                    </a>
                </li>
            @endcan
            <div class="border-t border-zinc-200 dark:border-zinc-600">
                <li class="px-4 py-2 hover:bg-zinc-800 flex items-center">
                    <a href="{{ route('user.profile.edit') }}" class="block flex items-center space-x-2 w-full">
                        <i class="w-4 fa-solid fa-user"></i>
                        <span class="hidden md:inline">{{ Auth::user()->name }}</span>
                    </a>
                </li>
                <li class="px-4 py-2 hover:bg-zinc-800 flex items-center">
                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <a href="{{ route('logout') }}" class="block flex items-center space-x-2 w-full" onclick="event.preventDefault(); this.closest('form').submit();">
                            <i class="w-4 fa-solid fa-right-from-bracket"></i>
                            <span class="hidden md:inline">Sair</span>
                        </a>
                    </form>
                </li>
            </div>
        </ul>
    </nav>
</aside>