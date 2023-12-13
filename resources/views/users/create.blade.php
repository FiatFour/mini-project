@extends('layouts.app')

@section('content')
    <section class="content">
        <!-- Search -->
        <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">{{ __('manage.add').__('users.page_title') }}</h1>
        <div class="p-3 bg-body-extra-light rounded push">
            <form action="" method="POST" id="userForm" name="userForm">
                {{-- @method('PUT') --}}
                <div class="row mb-4">
                    <div class="col-6">
                        <label class="form-label" for="username">ชื่อ{{ __('users.page_title') }}</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Text Input">
                        <p></p>
                    </div>
                    <div class="col-6">
                        <label class="form-label" for="name">ชื่อ-นามสกุล</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Text Input">
                        <p></p>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-6">
                        <label class="form-label" for="email">Email</label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="Text Input">
                        <p></p>
                    </div>
                    <div class="col-6">
                        <label class="form-label" for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password"
                            placeholder="Password Input">
                        <p></p>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-6">
                        <label class="form-label" for="phone">เบอร์โทรศัพท์</label>
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Text Input">
                        <p></p>
                    </div>
                </div>
                <div class="d-flex flex-row d-flex justify-content-end">
                    <a href="{{ route('users.index') }}" class="btn btn-secondary" style="width: 100px">กลับ</a>
                    <button type="submit" class="btn btn-primary" style="margin-left: 2%; width: 100px">บันทึก</button>
                </div>
            </form>
        </div>


        {{-- <button class="input-group-text border-0 bg-body">
            <i class="fa fa-fw fa-search"></i>
        </button> --}}
        <!-- END Search -->

    </section>
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
                        $("input[type='text']").removeClass('is-invalid');

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
