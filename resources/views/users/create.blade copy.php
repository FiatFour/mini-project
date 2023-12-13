@extends('layouts.app')

@section('content')
    <div class="content">
        <!-- Search -->
        <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">เพึ่มบัญชีผู้ใช้งาน</h1>
        <div class="p-3 bg-body-extra-light rounded push">
            <form action="" method="POST" id="userForm" name="userForm">
                <div class="d-flex flex-row">
                    <div class="mb-4">
                        <label class="form-label" for="username">ชื่อผู้ใช้งาน</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Text Input"
                            style="width: 500px">
                        <p></p>
                    </div>
                    <div class="mb-4" style="margin-left: 4%;">
                        <label class="form-label" for="name">ชื่อ-นามสกุล</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Text Input"
                            style="width: 500px;">
                        <p></p>
                    </div>
                </div>
                <div class="d-flex flex-row">
                    <div class="mb-4">
                        <label class="form-label" for="email">Email</label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="Text Input"
                            style="width: 500px">
                        <p></p>
                    </div>
                    <div class="mb-4" style="margin-left: 4%;">
                        <label class="form-label" for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password"
                            placeholder="Password Input" style="width: 500px;">
                        <p></p>
                    </div>
                </div>
                <div class="d-flex flex-row">
                    <div class="mb-4">
                        <label class="form-label" for="phone">เบอร์โทรศัพท์</label>
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Text Input"
                            style="width: 500px">
                        <p></p>
                    </div>
                </div>
                <div class="d-flex flex-row d-flex justify-content-end">
                    <a href="{{ route('users.index') }}" class="btn btn-secondary" style="margin-left: 4%; width: 100px">กลับ</a>
                    <button type="submit" class="btn btn-primary"
                        style="margin-left: 2%; width: 100px">บันทึก</button>
                </div>
            </form>
        </div>


        {{-- <button class="input-group-text border-0 bg-body">
            <i class="fa fa-fw fa-search"></i>
        </button> --}}
        <!-- END Search -->

    </div>
@endsection

@section('customJs')
<script>
    $("#userForm").submit(function(event) {
        event.preventDefault();
        var element = $(this);
        $("button[type=submit]").prop('disabled', true);
        $.ajax({
            url: "{{ route('users.store') }}",
            type: 'post',
            data: element.serializeArray(),
            dataType: 'json',
            success: function(response) {
                $("button[type=submit]").prop('disabled', false);
                if (response['status'] == true) {
                    window.location.href = "{{ route('users.index') }}";
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
