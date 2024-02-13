<label class="{{ $label_class }}" for="{{ $id }}" class="{{ $label_class }}">
    {{ $label }}
    @if ($required)
        <span class="text-danger">*</span>
    @endif
    @if(!empty($label_suffix))
    <span class="label-helper" >{{ $label_suffix }}</span>
    @endif
</label>
<input type="{{ $type }}" class="form-control {{ $input_class }}" id="{{ $id }}"
    name="{{ $id }}" placeholder="{{ $placeholder }}" maxlength="{{ $maxlength }}" oninput="{{ $oninput }}" min="{{$min}}"
    {{ $required ? 'required' : '' }} value="{{ $value }}" 
    {{ $readonly ? 'readonly' : '' }}
    >