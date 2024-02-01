<div class="row">
    <div class="{{ $input_class }}">

        @if (isset($pos_1))
            {{ $pos_1 }}
        @endif
        @if (isset($url))
            <a class="btn btn-outline-secondary btn-custom-size me-2" href="{{ route($url) }}">{{ __('lang.back') }}</a>
        @elseif(isset($fullurl))
            <a class="btn btn-outline-secondary btn-custom-size me-2" href="{{ $fullurl }}">{{ __('lang.back') }}</a>
        @else
            <button type="button" class="btn btn-outline-secondary btn-custom-size me-2"
                onclick="window.history.back();">{{ __('lang.back') }}</button>
        @endif
        @if (isset($pos_2))
            {{ $pos_2 }}
        @endif
        @if (!isset($status))
            @can($manage_permission)
                @if (isset($isdraft) && $isdraft)
                    <button type="button" class="btn btn-secondary btn-custom-size btn-save-form me-2"
                        data-draft="true"> <i class="{{ $icon_draft_class_name }} mt-1"></i>{{ $btn_draft_name }}</button>
                @endif
                @if (isset($pos_3))
                    {{ $pos_3 }}
                @endif
                <button type="button" class="btn btn-primary btn-custom-size {{ $input_class_submit ?? 'btn-save-form' }}"
                    data-status="{{ $data_status }}"> <i class="{{ $icon_class_name }} mt-1"></i>{{ $btn_name }}</button>
                @if (isset($pos_4))
                    {{ $pos_4 }}
                @endif
            @endcan
        @endif

    </div>
</div>
