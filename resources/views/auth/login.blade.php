<x-guest-layout>
    <div class="fi-simple-page">
        <section class="grid auto-cols-fr gap-y-6">
            <header class="fi-simple-header flex flex-col items-center">
                <div style="height: 62px;" class="fi-logo flex dark:hidden mb-4">
                    <x-application-logo />
                </div>
                <div style="height: 62px;" class="fi-logo hidden dark:flex mb-4">
                    <x-application-logo-escuro />
                </div>
                <h1
                    class="fi-simple-header-heading text-center text-2xl font-bold tracking-tight text-zinc-950 dark:text-white">
                    Sign in
                </h1>
            </header>
            <form class="fi-form grid gap-y-6" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="grid grid-cols-[--cols-default] fi-fo-component-ctn gap-6">
                    <div style="--col-span-default: span 1 / span 1;" class="col-[--col-span-default]">
                        <div data-field-wrapper="" class="fi-fo-field-wrp">
                            <div class="grid gap-y-2">
                                <div class="flex items-center gap-x-3 justify-between ">
                                    <label class="fi-fo-field-wrp-label inline-flex items-center gap-x-3"
                                        for="email">
                                        <span class="text-sm font-medium leading-6 text-gray-950 dark:text-white">
                                            Email address<sup class="text-red-600 dark:text-red-400 font-medium">*</sup>
                                        </span>
                                    </label>
                                </div>
                                <div class="grid auto-cols-fr gap-y-2">
                                    <div
                                        class="fi-input-wrp flex rounded-lg shadow-sm ring-1 transition duration-75 bg-white dark:bg-white/5 [&amp;:not(:has(.fi-ac-action:focus))]:focus-within:ring-2 ring-gray-950/10 dark:ring-white/20 [&amp;:not(:has(.fi-ac-action:focus))]:focus-within:ring-primary-600 dark:[&amp;:not(:has(.fi-ac-action:focus))]:focus-within:ring-primary-500 fi-fo-text-input overflow-hidden">
                                        <div class="fi-input-wrp-input min-w-0 flex-1">
                                            <input id="email" type="email" name="email" required autofocus
                                                class="fi-input block w-full border-none py-1.5 text-base text-gray-950 transition duration-75 placeholder:text-gray-400 focus:ring-0 disabled:text-gray-500 disabled:[-webkit-text-fill-color:theme(colors.gray.500)] disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.400)] dark:text-white dark:placeholder:text-gray-500 dark:disabled:text-gray-400 dark:disabled:[-webkit-text-fill-color:theme(colors.gray.400)] dark:disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.500)] sm:text-sm sm:leading-6 bg-white/0 ps-3 pe-3">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="--col-span-default: span 1 / span 1;" class="col-[--col-span-default]">
                        <div data-field-wrapper="" class="fi-fo-field-wrp">
                            <div class="grid gap-y-2">
                                <div class="flex items-center gap-x-3 justify-between ">
                                    <label class="fi-fo-field-wrp-label inline-flex items-center gap-x-3"
                                        for="password">
                                        <span class="text-sm font-medium leading-6 text-gray-950 dark:text-white">
                                            Password<sup class="text-red-600 dark:text-red-400 font-medium">*</sup>
                                        </span>
                                    </label>
                                </div>
                                <div class="grid auto-cols-fr gap-y-2">
                                    <div
                                        class="fi-input-wrp flex rounded-lg shadow-sm ring-1 transition duration-75 bg-white dark:bg-white/5 [&amp;:not(:has(.fi-ac-action:focus))]:focus-within:ring-2 ring-gray-950/10 dark:ring-white/20 [&amp;:not(:has(.fi-ac-action:focus))]:focus-within:ring-primary-600 dark:[&amp;:not(:has(.fi-ac-action:focus))]:focus-within:ring-primary-500 fi-fo-text-input overflow-hidden">
                                        <div class="fi-input-wrp-input min-w-0 flex-1">
                                            <input id="password" type="password" name="password" required
                                                class="fi-input block w-full border-none py-1.5 text-base text-gray-950 transition duration-75 placeholder:text-gray-400 focus:ring-0 disabled:text-gray-500 disabled:[-webkit-text-fill-color:theme(colors.gray.500)] disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.400)] dark:text-white dark:placeholder:text-gray-500 dark:disabled:text-gray-400 dark:disabled:[-webkit-text-fill-color:theme(colors.gray.400)] dark:disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.500)] sm:text-sm sm:leading-6 bg-white/0 ps-3 pe-3 [&amp;::-ms-reveal]:hidden"
                                                x-bind:type="isPasswordRevealed ? 'text' : 'password'" tabindex="2"
                                            type="password">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="flex items-center justify-between">
                    <label class="flex items-center">
                        <input type="checkbox" name="remember"
                            class="h-4 w-4 text-primary-600 border-zinc-300 rounded dark:bg-zinc-700 dark:border-zinc-600">
                        <span class="ml-2 text-sm text-zinc-600 dark:text-zinc-300">Lembrar-me</span>
                    </label>
                    <a href="{{ route('password.request') }}"
                        class="text-sm text-primary-600 dark:text-primary-400 hover:underline">Esqueceu sua senha?</a>
                </div>
                <div class="fi-form-actions">
                    <div class="fi-ac gap-3 grid grid-cols-[repeat(auto-fit,minmax(0,1fr))]">
                        <button type="submit"
                            class="fi-btn relative grid-flow-col items-center justify-center font-semibold outline-none transition duration-75 focus-visible:ring-2 rounded-lg fi-color-custom bg-zinc-500 fi-color-primary fi-size-md fi-btn-size-md gap-1.5 px-3 py-2 text-sm inline-grid shadow-sm bg-custom-600 text-white hover:bg-custom-500 focus-visible:ring-custom-500/50 dark:bg-custom-500 dark:hover:bg-custom-400 dark:focus-visible:ring-custom-400/50 fi-ac-action fi-ac-btn-action">
                            <span class="fi-btn-label">
                                Sign in
                            </span>
                        </button>
                    </div>
                </div>
            </form>
        </section>
    </div>
</x-guest-layout>
