@extends('layouts.app')

@section('content')
    <div class="content">
        <!-- Search -->
        <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">{{ __('manage.manage') . __('categories.page_title') }}</h1>
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
                        <x-forms.select id="code" :name="'code'" :items="$categories2" :selected="$code"
                                        :label="__('categories.code')"
                                        :optionals="['placeholder' => __('lang.select')]"/>
                    </div>
                    <div class="col-3">
                        <x-forms.select id="name" :name="'name'" :items="$categories2" :selected="$name"
                                        :label="__('categories.name')"
                                        :optionals="['placeholder' => __('lang.select')]"/>
                    </div>
                    <div class="col-3">
                        <x-forms.select id="status" :name="'name'" :items="$status_obj" :selected="$status"
                                        :label="__('categories.select_status')"
                                        :optionals="['form_label' => 'text-start col-form-label']"/>
                    </div>
                </div>
                @include('components.btns.search')
            </form>
        </div>

        <div class="block block-rounded">
            <div class="block-content">
                <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                    <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3"></h1>
                    <a href="{{ route('categories.create') }}" type="button" class="btn btn-alt-primary my-2">
                        <i class="fa fa-fw fa-plus me-1"></i> {{ __('manage.btn_add') }}
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-borderless table-vcenter">
                        <thead>
                        <tr class="bg-body-dark">
                            <th class="d-none d-sm-table-cell text-center" style="width: 40px;">#</th>
                            <th>{{ __('categories.code') }}</th>
                            <th>{{ __('categories.name') }}</th>
                            <th class="d-none d-sm-table-cell">{{ __('categories.status') }}</th>
                            <th class="text-center">{{ __('manage.tools') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if ($categories->isNotEmpty())
                            @foreach ($categories as $index => $category)
                                <tr>
                                    <td class="d-none d-sm-table-cell text-center">
                                        {{ $categories->firstItem() + $index }}</td>
                                    <td class="fw-semibold">
                                        <a href="javascript:void(0)">{{ $category->code }}</a>
                                    </td>
                                    <td class="d-none d-sm-table-cell">
                                        {{ $category->name }}
                                    </td>
                                    <td class="d-none d-sm-table-cell">
                                        @if ($category->status == 1)
                                            ใช้งาน
                                        @else
                                            ไม่ได้ใช้งาน
                                        @endif
                                    </td>
                                    <td class="sticky-col text-center">
                                        @include('components.dropdown-action', [
                                            'view_route' => route('categories.show', ['category' => $category]),
                                            'edit_route' => route('categories.edit', ['category' => $category]),
                                            'delete_route' => route('categories.destroy', [
                                                'category' => $category,
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
                </div>
                <div class="d-flex flex-row d-flex justify-content-end">
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@include('components.select2-default')
@include('components.sweetalert')
@include('components.list-delete')
