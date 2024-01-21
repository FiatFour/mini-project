@extends('layouts.app')

@section('content')
    <section class="content">
        <!-- Search -->
        <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">{{ __('manage.add') . __('categories.page_title') }}</h1>
        <div class="p-3 bg-body-extra-light rounded push">
            <form action="" method="POST" id="categoryForm" name="categoryForm">
                <div class="row mb-4">
                    <div class="col-6">
                        {{-- <label class="form-label" for="code">รหัส{{ __('categories.page_title') }}</label>
                        <input type="text" class="form-control" placeholder="Input Text" name="code" id="code"> --}}
                        <x-forms.input id="code" :value="$category->code" :label="'รหัส' . __('categories.page_title')" :optionals="['placeholder' => 'กรอกข้อมูลรหัส' . __('categories.page_title')]" />
                    </div>

                    <div class="col-6">
                        {{-- <label class="form-label" for="name">ชื่อ{{ __('categories.page_title') }}</label>
                        <input type="text" class="form-control" placeholder="Input Text" name="name" id="name"> --}}
                        <x-forms.input id="name" :value="$category->name" :label="'ชื่อ' . __('categories.page_title')" :optionals="['placeholder' => 'กรอกข้อมูอชื่อ' . __('categories.page_title')]" />
                    </div>
                </div>
                <div class="mb-4">
                    <x-forms.radio id="status" :value="$category->status" :label="'สถานะ'" :optionals="['label_class' => 'form-label']" />

                    {{-- <label class="form-label">สถานะ</label><br>
                    <span class="space-y-2">
                        <div class="d-inline-flex">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="status" name="status" value="1"
                                    {{ $category->status == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="status">ใช้งาน</label>
                            </div>
                            <div class="form-check" style="margin-left: 20px">
                                <input class="form-check-input" type="radio" id="status" name="status" value="0"
                                {{ $category->status == 0 ? 'checked' : '' }}>
                                <label class="form-check-label" for="status2">ไม่ใช้งาน</label>
                            </div>
                        </div>
                    </span> --}}
                </div>
                <div class="mb-4">
                    <x-forms.textarea id="detail" :value="$category->detail" :label="'รายละเอียด' . __('categories.page_title')" :optionals="['placeholder' => 'กรอกข้อมูอรายละเอียด' . __('categories.page_title')]" />

                    {{-- <label class="form-label" for="detail">รายละเอียด</label>
                    <textarea class="form-control" id="detail" name="detail" rows="4" placeholder="Text Area">{{ $category->detail }}</textarea> --}}
                </div>
                <div class="row">
                    <input type="hidden" name="id" id="id" value="{{ $category->id }}">
                    <div class="col-12 text-end">
                        <a href="{{ route('categories.index') }}"
                            class="btn btn-secondary btn-custom-size me-2">{{ __('manage.back') }}</a>
                        @if (!isset($view))
                            <button type="button"
                                class="btn btn-primary btn-custom-size btn-save-form">{{ __('manage.save') }}</button>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $view = '{{ isset($view) }}';
        if ($view) {
            $('#code').prop('disabled', true);
            $('#name').prop('disabled', true);
            $('.form-check-input').prop('disabled', true);
            $('#detail').prop('disabled', true);
        }

        $(".btn-save-form").on("click", function() {
            let storeUri = "{{ route('categories.store') }}";
            var formData = new FormData(document.querySelector('#categoryForm'));
            formData.append('test_form', true);
            axios.post(storeUri, formData).then(response => {
                if (response.data.success) {
                    Swal.fire({
                        title: "สำเร็จ",
                        text: "{{ __('manage.store_success_message') }}",
                        icon: "success",
                        showCancelButton: false,
                        confirmButtonColor: "btn btn-success",
                        confirmButtonText: "ตกลง"
                    }).then(value => {
                        if (response.data.redirect) {
                            window.location.href = response.data.redirect;
                        }
                    });
                } else {
                    if (response.data.errors) {
                        var errors = response.data.errors;

                        $('.error').removeClass('invalid-feedback').html('');
                        $("input[type='text'], select").removeClass('is-invalid');

                        $.each(errors, function(key, value) {
                            $(`#${key}`).addClass('is-invalid')
                                .siblings('p')
                                .addClass('invalid-feedback')
                                .html(value);
                        });
                    }
                }
            }).catch(error => {
                Swal.fire({
                    title: "เกิดข้อผิดพลาด",
                    text: response.data.message,
                    icon: "error",
                    showCancelButton: false,
                    confirmButtonColor: "btn btn-danger",
                    confirmButtonText: "ตกลง"
                }).then(value => {
                    if (value) {
                        //
                    }
                });
            });
        });
    </script>
@endpush

{{-- @section('customJs')
    <script>
        $("#categoryForm").submit(function(event) {
            event.preventDefault();
            var element = $(this);
            $("button[type=submit]").prop('disabled', true);
            $.ajax({
                url: "{{ route('categories.store') }}",
                type: 'post',
                data: element.serializeArray(),
                dataType: 'json',
                success: function(response) {
                    $("button[type=submit]").prop('disabled', false);
                    if (response['status'] == true) {
                        window.location.href = "{{ route('categories.index') }}";
                    } else {
                        var errors = response['errors'];

                        $('.error').removeClass('invalid-feedback').html('');
                        $("input[type='text'], select").removeClass('is-invalid');

                        $.each(errors, function(key, value) {
                            $(`#${key}`).addClass('is-invalid')
                                .siblings('p')
                                .addClass('invalid-feedback')
                                .html(value);
                        });
                    }
                },
                error: function(jqXHR, exception) {
                    // Handle error here, e.g., display an error message
                    console.log("Something went wrong");
                    console.log(jqXHR);
                }
            });
        });
    </script>
@endsection --}}
