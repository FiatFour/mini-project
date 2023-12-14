@extends('layouts.app')

@push('custom_styles')
    <style>
        .btn-custom-size {
            min-width: 10rem;
        }
    </style>
@endpush

@section('content')
    <section class="content">
        <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">{{ $page_title ?? '' }}</h1>
        <div class="p-3 bg-body-extra-light rounded push">
            <form id="userForm">
                <div class="row mb-4">
                    <div class="col-6">
                        <x-forms.input id="username" :value="$user->username" :label="__('users.username')" :optionals="['placeholder' => 'กรอกข้อมูล']" />
                        {{-- <label class="form-label" for="username">{{ __('users.username') }}</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Text Input"
                            value="{{ $user->username }}"> --}}
                    </div>
                    <div class="col-6">
                        <label class="form-label" for="name">{{ __('users.name') }}</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Text Input"
                            value="{{ $user->name }}">
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-6">
                        <label class="form-label" for="email">{{ __('users.email') }}</label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="Text Input"
                            value="{{ $user->email }}">
                    </div>
                    <div class="col-6">
                        <label class="form-label" for="password">{{ __('users.password') }}</label>
                        <input type="password" class="form-control" id="password" name="password"
                            placeholder="Password Input">
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-6">
                        <label class="form-label" for="phone">{{ __('users.phone') }}</label>
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Text Input"
                            value="{{ $user->phone }}" maxlength="10">
                    </div>
                </div>
                <div class="row">
                    <input type="hidden" name="id" id="id" value="{{ $user->id }}">
                    <div class="col-12 text-end">
                        <a href="{{ route('users.index') }}"
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
            $('#username').prop('disabled', true);
            $('#name').prop('disabled', true);
            $('#password').prop('disabled', true);
            $('#email').prop('disabled', true);
            $('#phone').prop('disabled', true);
        }

        $(".btn-save-form").on("click", function() {
            let storeUri = "{{ route('users.store') }}";
            var formData = new FormData(document.querySelector('#userForm'));
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
