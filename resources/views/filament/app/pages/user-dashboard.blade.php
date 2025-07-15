<x-filament-panels::page>
    <div class="grid grid-cols-12 gap-4 sm:gap-6">
        @foreach ($this->widgets as $widgetData)
            @php
                // Pegamos o valor do span que definimos na classe da página.
                $colSpan = $widgetData['span'];

                // O Filament usa 'full' como atalho para 12 colunas.
                if ($colSpan === 'full') {
                    $colSpan = 12;
                }
            @endphp

            {{--
                Aplicamos a classe de largura dinamicamente.
                - col-span-12: Sempre ocupa a largura total em telas pequenas.
                - md:col-span-{{ $colSpan }}: Em telas médias e maiores, ocupa o número de colunas definido.
            --}}
            <div class="col-span-12 md:col-span-{{ $colSpan }}">
                @livewire($widgetData['class'], key($widgetData['class']))
            </div>
        @endforeach
    </div>
</x-filament-panels::page>
