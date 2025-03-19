<div class="">
    @if(tenant())
        @if (tenant()->photo_path)
            <img src="{{ url('storage/' . tenant()->photo_path) }}"
                alt="{{ tenant()->name }}"
                class="w-16 h-16 p-2 rounded-full object-cover">
        @else
            <img src="{{ url('img/tenants/noimage.png') }}"
                alt="{{ tenant()->name }}"
                class="w-16 h-16 p-2 rounded-full object-cover">
        @endif
    @else
        <h1 class="w-16 h-16 p-2 rounded-full object-cover">Logo Escuro</h1>
    @endif
</div>