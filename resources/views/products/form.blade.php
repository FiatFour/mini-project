@extends('layouts.app')

@section('content')
    <section class="content">
        <!-- Search -->
        <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">{{ $page_title }}</h1>
        <div class="p-3 bg-body-extra-light rounded push">
            <form id="save-form">
                <div class="row mb-4">
                    <div class="col-6">
                        <x-forms.input id="name" :value="$product->name" :label="'ชื่อ' . __('products.page_title')"
                                       :optionals="['placeholder' => __('products.input_name')]"/>
                    </div>
                    <div class="col-6">
                        <x-forms.select id="categoryId" :name="'categoryName'" :items="$categories"
                                        :selected="$product->category_id"
                                        :label="__('categories.page_title')" :optionals="['placeholder' => __('lang.select')]"/>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-3">
                        <x-forms.input id="price" :value="$product->price" :label="__('products.per_price')"
                                       :optionals="['placeholder' => '00.00', 'type' => 'number']"/>
                    </div>

                    <div class="col-3">
                        <x-forms.input id="mfg_date" :value="$product->mfg_date" :label="__('products.mfg_date')"
                                       :optionals="['input_class' => 'js-flatpickr', 'placeholder' => __('lang.date')]"/>
                    </div>

                    <div class="col-3">
                        <x-forms.input id="exp_date" :value="$product->exp_date" :label="__('products.exp_date')"
                                       :optionals="['input_class' => 'js-flatpickr', 'placeholder' => __('lang.date')]"/>
                    </div>
                </div>
                <div class="mb-4">
                    <x-forms.textarea id="detail" :value="$product->detail" :label="__('products.info')"
                                      :optionals="['placeholder' => __('products.input_info')]"/>
                </div>
                <div class="row">
                    <input type="hidden" name="id" id="id" value="{{ $product->id }}">
                    <x-forms.submit-group
                        :optionals="['url' => 'products.index', 'view' => empty($view) ? null : $view]"/>
                </div>
            </form>
        </div>
    </section>
@endsection

@include('components.sweetalert')
@include('components.form-save', [
    'store_uri' => route('products.store'),
])

@push('scripts')
    <script>
        $view = '{{ isset($view) }}';
        if ($view) {
            $('#name').prop('disabled', true);
            $('#price').prop('disabled', true);
            $('#categoryId').prop('disabled', true);
            $('#detail').prop('disabled', true);
            $('#mfg_date').prop('disabled', true);
            $('#exp_date').prop('disabled', true);
        }
    </script>
@endpush
