<div>
    <label class="{{ $label_class }}">{{ $label }}</label><br>
        <div class="space-x-2">
            <div class="form-check form-check-inline mt-1">
                <input class="form-check-input {{ $input_class }}" type="radio" id="{{ $id }}" name="{{ $id }}" value="yes"
                {{ $value == 'yes' || $value == null ? 'checked' : '' }}>
                <label class="form-check-label" for="{{ $id }}">ใช้งาน</label>
            </div>
            <div class="form-check form-check-inline mt-1">
                <input class="form-check-input {{ $input_class }}" type="radio" id="{{ $id }}" name="{{ $id }}" value="no"
                {{ $value == 'no' ? 'checked' : '' }}>
                <label class="form-check-label" for="{{ $id }}2">ไม่ใช้งาน</label>
            </div>
        </div>
    <p></p>
</div>
