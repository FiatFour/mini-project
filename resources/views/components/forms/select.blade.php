<label class="{{ $label_class }}" for="{{ $id }}">{{ $label }}</label>
<select class="form-select {{ $select_class }}" id="{{ $id }}" name="{{ $id }}" style="width: 100%;"
    data-placeholder="{{ $placeholder }}">
    <option></option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
    @if (!empty($items))
        @foreach ($items as $item)
            <option {{ $item->$id == $selected ? 'selected' : '' }} value="{{ $item->$id }}">
                {{ $item->$name }}</option>
        @endforeach
    @endif
</select>
<p></p>
