@extends('layouts.app')

@section('content')
    <div class="content">
        <!-- Search -->
        <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">{{ __('manage.view') . __('categories.page_title') }}</h1>
        <div class="p-3 bg-body-extra-light rounded push">
            <form action="" method="POST" id="categoryForm" name="categoryForm">
                <div class="row mb-4">
                    <div class="col-6">
                        <label class="form-label" for="code">รหัส{{ __('categories.page_title') }}</label>
                        <input readonly type="text" class="form-control" placeholder="Input Text" name="code"
                            id="code" value="{{ $category->code }}">
                    </div>
                    <div class="col-6">
                        <label class="form-label" for="name">ชื่อ{{ __('categories.page_title') }}</label>
                        <input readonly type="text" class="form-control" placeholder="Input Text" name="name"
                            id="name" value="{{ $category->name }}">
                    </div>.
                </div>
                <div class="mb-4">
                    <label class="form-label">สถานะ</label><br>
                    <span class="space-y-2">
                        <div class="d-inline-flex">
                            <div class="form-check">
                                <input disabled class="form-check-input" type="radio" id="status" name="status"
                                    value="1" {{ $category->status == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="status">ใช้งาน</label>
                            </div>
                            <div class="form-check" style="margin-left: 20px">
                                <input disabled class="form-check-input" type="radio" id="status" name="status"
                                    value="0" {{ $category->status == 0 ? 'checked' : '' }}>
                                <label class="form-check-label" for="status2">ไม่ใช้งาน</label>
                            </div>
                        </div>
                    </span>
                </div>
                <div class="mb-4">
                    <label class="form-label" for="detail">รายละเอียด</label>
                    <textarea readonly class="form-control" id="detail" name="detail" rows="4" placeholder="Text Area">{{ $category->detail }}</textarea>
                </div>
                <div class="d-flex flex-row d-flex justify-content-end">
                    <a href="{{ route('categories.index') }}" class="btn btn-secondary"
                        style="margin-left: 4%; width: 100px">กลับ</a>
                </div>
            </form>
        </div>
    </div>
@endsection
