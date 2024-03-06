@extends('layouts.app')

@section('content')
    <section class="content">
        <!-- Search -->
        <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">{{ $page_title ?? '' }}</h1>
        <div class="p-3 bg-body-extra-light rounded push">
            <form id="save-form">
                <div class="row mb-4">
                    <div class="col-6">
                        <x-forms.input id="code" :value="$category->code" :label="__('lang.search_label')"
                                       :optionals="['placeholder' => __('categories.input_code')]"/>
                    </div>
                    <div class="col-6">
                        <x-forms.input id="name" :value="$category->name" :label="__('categories.name')"
                                       :optionals="['placeholder' => __('categories.input_name')]"/>
                    </div>
                </div>
                <div class="row mb-4">
                    <x-forms.radio id="status" :value="$category->status" :label="__('categories.status')"
                                   :optionals="['label_class' => 'form-label']"/>
                </div>
                <div class="row mb-4">
                    <x-forms.textarea id="detail" :value="$category->detail"
                                      :label="__('categories.detail')"
                                      :optionals="['placeholder' => __('categories.input_detail')]"/>
                </div>
                <div class="row">
                    <input type="hidden" name="id" id="id" value="{{ $category->id }}">
                    <x-forms.submit-group
                        :optionals="['url' => 'categories.index', 'view' => empty($view) ? null : $view]"/>
                </div>
            </form>
        </div>
    </section>
@endsection

@include('components.sweetalert')
@include('components.form-save', [
    'store_uri' => route('categories.store'),
])

@push('scripts')
    <script>
        $view = '{{ isset($view) }}';
        if ($view) {
            $('#code').prop('disabled', true);
            $('#name').prop('disabled', true);
            $('.form-check-input').prop('disabled', true);
            $('#detail').prop('disabled', true);
        }
    </script>
@endpush

