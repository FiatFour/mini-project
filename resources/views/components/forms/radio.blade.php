<div>
    <label class="{{ $label_class }}">{{ $label }}</label><br>
        <div class="space-x-2">
            <div class="form-check form-check-inline mt-1">
                <input class="form-check-input {{ $input_class }}" type="radio" id="{{ $id }}" name="{{ $id }}" value="1"
                {{ $value == 1 || $value == null ? 'checked' : '' }}>
                <label class="form-check-label" for="{{ $id }}">ใช้งาน</label>
            </div>
            <div class="form-check form-check-inline mt-1">
                <input class="form-check-input {{ $input_class }}" type="radio" id="{{ $id }}" name="{{ $id }}" value="0"
                {{ $value == 2 ? 'checked' : '' }}>
                <label class="form-check-label" for="{{ $id }}">ไม่ใช้งาน</label>
            </div>
        </div>
    <p></p>
</div>
