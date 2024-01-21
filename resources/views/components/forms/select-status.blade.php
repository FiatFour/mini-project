<label class="{{ $label_class }}" for="{{ $id }}">สถานะ</label>
<select class="form-select" id="{{ $id }}" name="{{ $id }}" style="width: 100%;">
    <option value="">เลือกสถานะ</option>
    <option {{ $selected == 'yes' ? 'selected' : '' }} value="yes">ใช้งาน</option>
    <option {{ $selected == 'no' ? 'selected' : '' }} value="no">ไม่ใช้งาน</option>
</select>
