@extends('layouts.app')

@section('content')
    <div class="content">
        <!-- Search -->
        <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">{{ __('manage.manage') . __('products.page_title') }}</h1>
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
                        <x-forms.select-option id="product_id" :value="$product_id" :list="$products2"
                                               :label="__('products.page_title')"/>
                    </div>
                    <div class="col-3">
                        <x-forms.select id="category_id" :name="'name'" :items="$categories" :selected="$category_id"
                                        :label="__('categories.page_title')" :optionals="['placeholder' => 'เลือก..']"/>
                    </div>
                    <div class="col-3">
                        <x-forms.input id="exp_date" :value="$exp_date" :label="__('products.exp_date')"
                                       :optionals="['input_class' => 'js-flatpickr', 'placeholder' => 'Y-m-d',]"/>
                    </div>
                </div>
                @include('components.btns.search')
            </form>
        </div>

        <div class="block block-rounded">
            <div class="block-content">
                <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                    <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3"></h1>
                    <a href="{{ route('products.create') }}" type="button" class="btn btn-alt-primary my-2">
                        <i class="fa fa-fw fa-plus me-1"></i> {{ __('manage.btn_add') }}
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-borderless table-vcenter">
                        <thead>
                        <tr class="bg-body-dark">
                            <th class="d-none d-sm-table-cell text-center" style="width: 40px;">#</th>
                            <th>{{ __('products.name') }}</th>
                            <th>{{ __('categories.page_title') }}</th>
                            <th>{{ __('products.price') }}</th>
                            <th>{{ __('products.exp_date') }}</th>
                            <th class="text-center">{{ __('manage.tools') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if ($products->isNotEmpty())
                            @foreach ($products as $index => $product)
                                <tr>
                                    <td class="d-none d-sm-table-cell text-center">
                                        {{ $products->firstItem() + $index }}</td>
                                    <td class="fw-semibold">
                                        <a href="javascript:void(0)">{{ $product->name }}</a>
                                    </td>
                                    <td class="d-none d-sm-table-cell">
                                        {{ $product->categoryName }}
                                    </td>
                                    <td class="d-none d-sm-table-cell">
                                        {{ number_format($product->price, 2) }}
                                    </td>
                                    <td class="d-none d-sm-table-cell">
                                        {{ $product->exp_date }}
                                    </td>
                                    <td class="sticky-col text-center">
                                        @include('components.dropdown-action', [
                                            'view_route' => route('products.show', ['product' => $product]),
                                            'edit_route' => route('products.edit', ['product' => $product]),
                                            'delete_route' => route('products.destroy', [
                                                'product' => $product,
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
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@include('components.sweetalert')
@include('components.list-delete')
@include('components.select2-ajax', [
    'id' => 'product_id',
    'url' => route('util.select2.products'),
    'parent_id' => 'categoryId',
])

