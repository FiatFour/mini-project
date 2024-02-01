<a href="{{ $route_create }}" class="btn btn-primary">
    <i class="icon-add-circle me-1"></i>
    @if (isset($btn_text))
        {{ $btn_text }}
    @else
        {{ __('lang.create') }}
    @endif
</a>
