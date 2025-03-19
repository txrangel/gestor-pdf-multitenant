<div class="size-64">
    @if(tenant())
        @if (tenant()->photo_path)
            <img src="{{ url("storage/".tenant()->photo_path) }}"
                alt="{{ tenant()->name }}" class="size-full object-cover rounded-full">
        @else
            <img src="{{ url('img/tenants/noimage.png') }}" alt="{{ tenant()->name }}"
                class="size-full object-cover rounded-full">
        @endif
    @endif
</div>