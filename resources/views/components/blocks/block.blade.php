<div class="block {{ __('block.styles') }}" @if(!empty($id)) id="{{ $id }}" @endif>
    @if(!empty($title))
    <div class="block-header {{ $block_header_class }}">
        <h3 class="block-title">
            <i class=" me-2 {{ $block_icon_class }}"></i>
            {{ $title }}
        </h3>

        @if($is_toggle || isset($options) || isset($btn_option))
        <div class="block-options">
            @if(isset($btn_option))
            {{ $btn_option }}
            @endif

            @if($is_toggle)
            <div class="block-options-item ms-2">
                <a class="block-option-toggle" data-toggle="block-option" data-action="content_toggle"></a>
            </div>
            @endif

            @if(isset($options))
            {{ $options }}
            @endif
        </div>
        @endif
    </div>
    @endif
    <div class="block-content {{ $block_content_class }}">
        {{ $slot }}
    </div>
</div>
