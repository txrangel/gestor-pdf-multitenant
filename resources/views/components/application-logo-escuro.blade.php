@if (tenant())
    @if (tenant()->photo_path)
        <img src="{{ url('storage/' . tenant()->photo_path) }}" alt="{{ tenant()->name }}"
            class="w-16 h-16 rounded-full object-cover">
    @endif
@else
    <img src="{{ asset('img/noimage.png') }}" alt="Sem imagem" class="w-16 h-16 rounded-full object-cover">
@endif
