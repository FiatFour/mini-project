<label class="{{ $label_class }}" for="{{ $id }}">
    {{ $label }}
    @if ($required)
        <span class="text-danger">*</span>
    @endif
    @if(!empty($label_suffix))
    <span class="label-helper" >{{ $label_suffix }}</span>
    @endif
</label>
<select name="{{ $id }}" id="{{ $id }}" class="{{ $select_class }}" style="width: 100%;"
    @if ($multiple) multiple @endif >
    @if (!$ajax)
        <option value="">
            {{ !empty($select_option) ? $select_option : __('lang.select_option') }}
        </option>
        @if (!empty($list))
            @foreach ($list as $key => $item)
                <option value="{{ $item->id }}"
                    @if (isset($item->image_url)) data-image="{{ $item->image_url }}" @endif
                    @if (isset($item->created_at)) data-subtext="{{ get_thai_date_format($item->created_at, 'j M Y') }}" @endif
                    @if (isset($item->default_url)) data-link="{{ $item->default_url }}" @endif
                    @if ($model) v-model="{{ $model }}" @endif
                    @if ($multiple)  {{ (in_array($item->id, $value)) ? 'selected' : '' }}
                    @else {{ strcmp($value, $item->id) == 0 ? 'selected' : '' }}
                    @endif
                    >
                    {{ $item->name }}
                </option>
            @endforeach
        @endif
    @else
        @if (!empty($value))
            <option value="{{ $value }}">{{ $default_option_label }}</option>
        @endif
    @endif
</select>
