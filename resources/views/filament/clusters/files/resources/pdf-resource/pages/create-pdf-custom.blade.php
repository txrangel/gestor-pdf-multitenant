<x-filament-panels::page>
    <form method="POST" action="{{ route('upload') }}" enctype="multipart/form-data"
        class="fi-section rounded-xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10 grid gap-y-6 w-full p-6 ">
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
                    <x-input-error :messages="$errors->get('name')" class="mt-2 text-sm text-danger-600 dark:text-danger-400" />
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
                    <div class="filepond--drop-label" style="transform: translate3d(0px, 0px, 0px); opacity: 1;">
                        <label for="file_path" id="filepond--drop-label">
                            Drag & Drop your files or <span class="filepond--label-action" tabindex="0">Browse</span>
                        </label>
                    </div>
                    <div
                        class="fi-input-wrp flex rounded-lg shadow-sm ring-1 transition duration-75 bg-white dark:bg-white/5 focus-within:ring-2 ring-gray-950/10 dark:ring-white/20 focus-within:ring-primary-600 dark:focus-within:ring-primary-500 overflow-hidden">
                        <input id="file_path" name="file_path" type="file" accept="application/pdf" required
                            class="fi-input block w-full border-none py-1.5 text-base text-gray-950 transition duration-75 placeholder:text-gray-400 focus:ring-0 disabled:text-gray-500 disabled:[-webkit-text-fill-color:theme(colors.gray.500)] disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.400)] dark:text-white dark:placeholder:text-gray-500 dark:disabled:text-gray-400 dark:disabled:[-webkit-text-fill-color:theme(colors.gray.400)] dark:disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.500)] sm:text-sm sm:leading-6 bg-white/0 ps-3 pe-3" />
                    </div>
                    <x-input-error :messages="$errors->get('file_path')" class="mt-2 text-sm text-danger-600 dark:text-danger-400" />
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
</x-filament-panels::page>
