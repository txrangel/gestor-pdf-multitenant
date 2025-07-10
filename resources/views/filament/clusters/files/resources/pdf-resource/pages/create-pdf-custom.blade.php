<x-filament-panels::page>
    <x-filament::section>
        <form method="POST" action="{{ route('upload') }}" enctype="multipart/form-data">
            @csrf
            <!-- Nome -->
            <div class="flex items-center gap-x-3 justify-between">
                <label for="name" class="fi-fo-field-wrp-label inline-flex items-center gap-x-3">
                    <span class="text-sm font-medium leading-6 text-gray-950 dark:text-white">
                        Nome
                    </span>
                </label>
            </div>
            <div class="mb-4">
                <x-filament::input.wrapper>
                    <x-filament::input type="text" id="name" name="name" wire:model="name"
                    class="@error('name') is-invalid @enderror" required/>
                </x-filament::input.wrapper>
                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <!-- Campo de Upload de Foto -->
            <div class="flex items-center gap-x-3 justify-between">
                <label for="file_path" class="fi-fo-field-wrp-label inline-flex items-center gap-x-3">
                    <span class="text-sm font-medium leading-6 text-gray-950 dark:text-white">
                        Arquivo de PDF
                    </span>
                </label>
            </div>
            <div class="mb-4">
                <x-filament::input.wrapper>
                    <x-filament::input type="file" id="file_path" name="file_path" wire:model="file_path"
                        accept="application/pdf" class="@error('file_path') is-invalid @enderror" required/>
                </x-filament::input.wrapper>
                @error('file_path')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <!-- Botão de Submit -->
            <x-filament::button type="submit">
                Criar
            </x-filament::button>
        </form>
    </x-filament::section>
</x-filament-panels::page>
