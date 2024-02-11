<div class="block-header ">
    <h3 class="block-title">
        <i class="{{ $block_icon_class }} me-2"></i>
        {{ $title }}

        @if($showstep)
            @if(!$success)
            <span class="ms-2 block-step ps-3 pe-3" >
                <span class="block-step-text" >{{ $step_text }}</span>
            </span>
            @else
            <span class="ms-2 block-step block-step--success ps-3 pe-3" >
                <img class="block-step-icon me-1" src="{{asset('images/icons/vector.png')}}">
                <span class="block-step-text" >{{ $step_text }}</span>
            </span>
            @endif
        @endif
    </h3>

    @if($is_toggle || isset($options))
    <div class="block-options">
        @if($is_toggle)
        <div class="block-options-item ms-2">
            <a class="block-option-toggle" data-toggle="block-option" data-action="content_toggle"></a>
        </div>
        @endif
    </div>
    @endif
</div>