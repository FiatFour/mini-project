@extends('layouts.app')

@section('content')
    <div class="content">
        <!-- Search -->
        <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">{{ __('manage.view') . __('users.page_title') }}</h1>
        <div class="p-3 bg-body-extra-light rounded push">
            <form action="" method="POST" id="userForm" name="userForm">
                <div class="row mb-4">
                    <div class="col-6">
                        <label class="form-label" for="username">ชื่อ{{ __('users.page_title') }}</label>
                        <input readonly type="text" class="form-control" id="username" name="username" placeholder="Text Input"
                            value="{{ $user->username }}">
                    </div>
                    <div class="col-6">
                        <label class="form-label" for="name">ชื่อ-นามสกุล</label>
                        <input readonly type="text" class="form-control" id="name" name="name" placeholder="Text Input"
                            value="{{ $user->name }}">
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-6">
                        <label class="form-label" for="email">Email</label>
                        <input readonly type="text" class="form-control" id="email" name="email" placeholder="Text Input"
                            value="{{ $user->email }}">
                    </div>
                    <div class="col-6">
                        <label class="form-label" for="password">Password</label>
                        <input readonly type="password" class="form-control" id="password" name="password"
                            placeholder="Password Input" value="{{ $user->password }}">
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-6">
                        <label class="form-label" for="phone">เบอร์โทรศัพท์</label>
                        <input readonly type="text" class="form-control" id="phone" name="phone" placeholder="Text Input"
                            value="{{ $user->phone }}" maxlength="10">
                    </div>
                </div>
                <div class="d-flex flex-row d-flex justify-content-end">
                    <a href="{{ route('users.index') }}" class="btn btn-secondary"
                        style="width: 100px">กลับ</a>
                </div>
            </form>
        </div>
    </div>
@endsection
