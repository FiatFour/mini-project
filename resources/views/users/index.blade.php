@extends('layouts.app')

@section('content')
    <div class="content">
        <!-- Search -->
        <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">{{ __('manage.manage') . __('users.page_title') }}</h1>
        @if (session('message'))
            <div class="alert alert-success">{{ session('message') }} </div>
        @endif
        <div class="p-3 bg-body-extra-light rounded push">
            <form action="" method="GET">
                <div class="row mb-4">
                    <div class="col-3">
                        <x-forms.input id="s" :value="$s" :label="__('lang.search_label')"
                                       :optionals="['placeholder' => __('lang.input_search')]"/>
                    </div>
                    <div class="col-3">
                        <x-forms.select-option id="username" :value="$username" :list="$users2"
                                               :label="__('users.username')"/>
                    </div>
                    <div class="col-3">
                        <x-forms.select-option id="name" :value="$name" :list="$users2"
                                               :label="__('users.name')"/>
                    </div>
                    @include('components.btns.search')
                </div>
            </form>
        </div>

        <div class="block block-rounded">
            <div class="block-content">
                <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                    <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3"></h1>
                    <a href="{{ route('users.create') }}" type="button" class="btn btn-alt-primary my-2">
                        <i class="fa fa-fw fa-plus me-1"></i> {{ __('manage.btn_add') }}
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-vcenter">
                        <thead>
                        <tr class="bg-body-dark">
                            <th class="d-none d-sm-table-cell text-center" style="width: 40px;">#</th>
                            <th>{{ __('users.username') }}</th>
                            <th>{{ __('users.name') }}</th>
                            <th class="d-none d-sm-table-cell">{{ __('users.email') }}</th>
                            <th class="text-center">{{ __('manage.tools') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if ($users->isNotEmpty())
                            @foreach ($users as $index => $user)
                                <tr>
                                    <td class="d-none d-sm-table-cell text-center">
                                        {{ $users->firstItem() + $index }}</td>
                                    <td class="fw-semibold">
                                        <a href="javascript:void(0)">{{ $user->username }}</a>
                                    </td>
                                    <td class="d-none d-sm-table-cell">
                                        {{ $user->name }}
                                    </td>
                                    <td class="d-none d-sm-table-cell">
                                        {{ $user->email }}
                                    </td>
                                    <td class="sticky-col text-center">
                                        @include('components.dropdown-action', [
                                            'view_route' => route('users.show', ['user' => $user]),
                                            'edit_route' => route('users.edit', ['user' => $user]),
                                            'delete_route' => route('users.destroy', [
                                                'user' => $user,
                                            ]),
                                        ])
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr class="table-empty">
                                <td class="text-center" colspan="8">“
                                    {{ __('manage.no_list') }} “
                                </td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                    <div class="d-flex flex-row d-flex justify-content-end">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@include('components.select2-default')
@include('components.sweetalert')
@include('components.list-delete')
@include('components.select2-ajax', [
    'id' => 'username',
    'url' => route('util.select2.users'),
    'parent_id' => 'name',
])
