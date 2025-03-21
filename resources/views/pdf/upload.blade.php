<section class="flex flex-col gap-y-8 py-8">
    <header class="fi-header flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <nav class="fi-breadcrumbs mb-2 hidden sm:block">
                <ol class="fi-breadcrumbs-list flex flex-wrap items-center gap-x-2">
                    <li class="fi-breadcrumbs-item flex items-center gap-x-2">
                        <a href="/app/files"
                            class="fi-breadcrumbs-item-label text-sm font-medium text-gray-500 dark:text-gray-400 transition duration-75 hover:text-gray-700 dark:hover:text-gray-200">
                            Files
                        </a>
                    </li>
                    <li class="fi-breadcrumbs-item flex items-center gap-x-2">
                        <svg class="fi-breadcrumbs-item-separator flex h-5 w-5 text-gray-400 dark:text-gray-500 rtl:hidden"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"
                            data-slot="icon">
                            <path fill-rule="evenodd"
                                d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <svg class="fi-breadcrumbs-item-separator flex h-5 w-5 text-gray-400 dark:text-gray-500 ltr:hidden"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                            aria-hidden="true" data-slot="icon">
                            <path fill-rule="evenodd"
                                d="M11.78 5.22a.75.75 0 0 1 0 1.06L8.06 10l3.72 3.72a.75.75 0 1 1-1.06 1.06l-4.25-4.25a.75.75 0 0 1 0-1.06l4.25-4.25a.75.75 0 0 1 1.06 0Z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <a href="/app/files/pdfs"
                            class="fi-breadcrumbs-item-label text-sm font-medium text-gray-500 dark:text-gray-400 transition duration-75 hover:text-gray-700 dark:hover:text-gray-200">
                            Pdfs
                        </a>
                    </li>
                    <li class="fi-breadcrumbs-item flex items-center gap-x-2">
                        <svg class="fi-breadcrumbs-item-separator flex h-5 w-5 text-gray-400 dark:text-gray-500 rtl:hidden"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                            aria-hidden="true" data-slot="icon">
                            <path fill-rule="evenodd"
                                d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <svg class="fi-breadcrumbs-item-separator flex h-5 w-5 text-gray-400 dark:text-gray-500 ltr:hidden"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                            aria-hidden="true" data-slot="icon">
                            <path fill-rule="evenodd"
                                d="M11.78 5.22a.75.75 0 0 1 0 1.06L8.06 10l3.72 3.72a.75.75 0 1 1-1.06 1.06l-4.25-4.25a.75.75 0 0 1 0-1.06l4.25-4.25a.75.75 0 0 1 1.06 0Z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="fi-breadcrumbs-item-label text-sm font-medium text-gray-500 dark:text-gray-400">
                            Create
                        </span>
                    </li>
                </ol>
            </nav>
            <h1 class="fi-header-heading text-2xl font-bold tracking-tight text-gray-950 dark:text-white sm:text-3xl">
                Create Pdf
            </h1>
        </div>
        <div class="flex shrink-0 items-center gap-3 sm:mt-7">
        </div>
    </header>
    <div>
        <div class="grid flex-1 auto-cols-fr gap-y-8">
            <form method="POST" action="{{ route('upload') }}" enctype="multipart/form-data"
                class="fi-form grid gap-y-6 w-full bg-gray-50 dark:bg-gray-900 p-6  rounded-md">
                @csrf
                <!-- Name Input -->
                <div class="fi-fo-field-wrp">
                    <div class="grid gap-y-2">
                        <div class="flex items-center gap-x-3 justify-between">
                            <label for="name" class="fi-fo-field-wrp-label inline-flex items-center gap-x-3">
                                <span class="text-sm font-medium leading-6 text-gray-950 dark:text-white">
                                    Name
                                    <sup class="text-danger-600 dark:text-danger-400 font-medium">*</sup>
                                </span>
                            </label>
                        </div>
                        <div class="grid auto-cols-fr gap-y-2">
                            <div
                                class="fi-input-wrp flex rounded-lg shadow-sm ring-1 transition duration-75 bg-white dark:bg-white/5 focus-within:ring-2 ring-gray-950/10 dark:ring-white/20 focus-within:ring-primary-600 dark:focus-within:ring-primary-500 overflow-hidden">
                                <input id="name" name="name" type="text" required autofocus
                                    class="fi-input block w-full border-none py-1.5 text-base text-gray-950 transition duration-75 placeholder:text-gray-400 focus:ring-0 disabled:text-gray-500 disabled:[-webkit-text-fill-color:theme(colors.gray.500)] disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.400)] dark:text-white dark:placeholder:text-gray-500 dark:disabled:text-gray-400 dark:disabled:[-webkit-text-fill-color:theme(colors.gray.400)] dark:disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.500)] sm:text-sm sm:leading-6 bg-white/0 ps-3 pe-3" />
                            </div>
                            <x-input-error :messages="$errors->get('name')"
                                class="mt-2 text-sm text-danger-600 dark:text-danger-400" />
                        </div>
                    </div>
                </div>
                <!-- File Upload -->
                <div class="fi-fo-field-wrp mt-4">
                    <div class="grid gap-y-2">
                        <div class="flex items-center gap-x-3 justify-between">
                            <label for="file_path" class="fi-fo-field-wrp-label inline-flex items-center gap-x-3">
                                <span class="text-sm font-medium leading-6 text-gray-950 dark:text-white">
                                    Upload PDF
                                    <sup class="text-danger-600 dark:text-danger-400 font-medium">*</sup>
                                </span>
                            </label>
                        </div>
                        <div class="grid auto-cols-fr gap-y-2">
                            <div class="filepond--drop-label"
                                style="transform: translate3d(0px, 0px, 0px); opacity: 1;">
                                <label for="file_path" id="filepond--drop-label">
                                    Drag & Drop your files or <span class="filepond--label-action"
                                        tabindex="0">Browse</span>
                                </label>
                            </div>
                            <div
                                class="fi-input-wrp flex rounded-lg shadow-sm ring-1 transition duration-75 bg-white dark:bg-white/5 focus-within:ring-2 ring-gray-950/10 dark:ring-white/20 focus-within:ring-primary-600 dark:focus-within:ring-primary-500 overflow-hidden">
                                <input id="file_path" name="file_path" type="file" accept="application/pdf" required
                                    class="fi-input block w-full border-none py-1.5 text-base text-gray-950 transition duration-75 placeholder:text-gray-400 focus:ring-0 disabled:text-gray-500 disabled:[-webkit-text-fill-color:theme(colors.gray.500)] disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.400)] dark:text-white dark:placeholder:text-gray-500 dark:disabled:text-gray-400 dark:disabled:[-webkit-text-fill-color:theme(colors.gray.400)] dark:disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.500)] sm:text-sm sm:leading-6 bg-white/0 ps-3 pe-3" />
                            </div>
                            <x-input-error :messages="$errors->get('file_path')"
                                class="mt-2 text-sm text-danger-600 dark:text-danger-400" />
                        </div>
                    </div>
                </div>
                <!-- Submit Button -->
                <div class="fi-form-actions mt-6">
                    <div class="fi-ac gap-3 flex flex-wrap items-center justify-start">
                        <button type="submit"
                            class="fi-btn relative grid-flow-col items-center justify-center font-semibold outline-none transition duration-75 focus-visible:ring-2 rounded-lg fi-color-custom fi-btn-color-primary fi-color-primary fi-size-md fi-btn-size-md gap-1.5 px-3 py-2 text-sm inline-grid shadow-sm bg-primary-600 text-white hover:bg-primary-500 focus-visible:ring-primary-500/50 dark:bg-primary-500 dark:hover:bg-primary-400 dark:focus-visible:ring-primary-400/50">
                            <span class="fi-btn-label">
                                Create
                            </span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
