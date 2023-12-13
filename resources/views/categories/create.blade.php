@extends('layouts.app')

@section('content')
    <div class="content">
        <!-- Search -->
        <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">{{ __('manage.add').__('categories.page_title') }}</h1>
        <div class="p-3 bg-body-extra-light rounded push">
            <form action="" method="POST" id="categoryForm" name="categoryForm">
                <div class="row mb-4">
                    <div class="col-6">
                        <label class="form-label" for="code">รหัส{{ __('categories.page_title') }}</label>
                        <input type="text" class="form-control" placeholder="Input Text" name="code" id="code">
                    </div>
                    <div class="col-6">
                        <label class="form-label" for="name">ชื่อ{{ __('categories.page_title') }}</label>
                        <input type="text" class="form-control" placeholder="Input Text" name="name" id="name">
                    </div>
                </div>
                <div class="mb-4">
                    <label class="form-label">สถานะ</label><br>
                    <span class="space-y-2">
                        <div class="d-inline-flex">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="status" name="status" value="1"
                                    checked>
                                <label class="form-check-label" for="status">ใช้งาน</label>
                            </div>
                            <div class="form-check" style="margin-left: 20px">
                                <input class="form-check-input" type="radio" id="status" name="status" value="0">
                                <label class="form-check-label" for="status2">ไม่ใช้งาน</label>
                            </div>
                        </div>
                    </span>
                </div>
                <div class="mb-4">
                    <label class="form-label" for="detail">รายละเอียด</label>
                    <textarea class="form-control" id="detail" name="detail" rows="4" placeholder="Text Area"></textarea>
                </div>
                <div class="d-flex flex-row d-flex justify-content-end">
                    <a href="{{ route('categories.index') }}" class="btn btn-secondary"
                        style="width: 100px">กลับ</a>
                    <button type="submit" class="btn btn-primary" style="margin-left: 2%; width: 100px">บันทึก</button>
                </div>
            </form>
        </div>


        {{-- <button class="input-group-text border-0 bg-body">
            <i class="fa fa-fw fa-search"></i>
        </button> --}}
        <!-- END Search -->
        {{-- <div class="row text-center">
            <div class="row mb-4">
                <div class="col-6">
                    <input type="text" class="form-control" placeholder="col-6">
                </div>
                <div class="col-6">
                    <input type="text" class="form-control" placeholder="col-6">
                </div>
            </div>
            <div class="row mb-4">

            </div>
            <div class="col-xxl-3">
                <div class="block block-rounded">
                    <div class="block-content">
                        <p><code>col-xxl-3</code></p>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3">
                <div class="block block-rounded">
                    <div class="block-content">
                        <p><code>col-xxl-3</code></p>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
@endsection

@section('customJs')
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
@endsection
