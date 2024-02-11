<label class="{{ $label_class }}" for="{{ $id }}">
    {{ $label }}
    @if ($required)
        <span class="text-danger">*</span>
    @endif
    @if(!empty($label_suffix))
        <span class="label-helper" >{{ $label_suffix }}</span>
    @endif
</label>
{{$id}}
<select name="{{ $id }}" id="{{ $id }}" class="{{ $select_class }}" style="width: 100%;">

</select>
