@extends('layouts.app')

@section('content')
    <section class="content">
        <!-- Search -->
        <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">{{ $page_title }}</h1>
        <div class="p-3 bg-body-extra-light rounded push">
            <form action="" method="POST" id="productForm" name="productForm">
                <div class="row mb-4">
                    <div class="col-6">
                        <x-forms.input id="name" :value="$product->name" :label="'ชื่อ' . __('products.page_title')" :optionals="['placeholder' => 'กรอกข้อมูลชื่อ' . __('products.page_title')]" />
                    </div>
                    <div class="col-6">
                        <x-forms.select id="categoryId" :name="'categoryName'" :items="$categories" :selected="$product->category_id"
                            :label="__('categories.page_title')" :optionals="['placeholder' => 'เลือก..']" />
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-3">
                        <x-forms.input id="price" :value="$product->price" :label="'ราคาขาย (ต่อชิ้น)'" :optionals="['placeholder' => '00.00', 'type' => 'number']" />
                    </div>

                    <div class="col-3">
                        {{-- <label class="form-label" for="example-flatpickr-default">วันผลิต</label> --}}
                        {{-- <input type="text" class="js-flatpickr form-control" id="example-flatpickr-default" name="example-flatpickr-default" placeholder="Y-m-d"> --}}
                        <x-forms.input id="mfg_date" :value="$product->mfg_date" :label="'วันผลิต'" :optionals="['input_class' => 'js-flatpickr', 'placeholder' => 'Y-m-d',]"/>
                    </div>

                    <div class="col-3">
                        <x-forms.input id="exp_date" :value="$product->exp_date" :label="'วันหมดอายุ'" :optionals="['input_class' => 'js-flatpickr', 'placeholder' => 'Y-m-d',]"/>
                        {{-- <x-forms.date id="exp_date" :value="$product->exp_date" :label="'วันหมดอายุ'"/> --}}
                      </div>
                </div>
                <div class="mb-4">
                    <x-forms.textarea id="detail" :value="$product->detail" :label="'ข้อมูลทั่วไป'" :optionals="['placeholder' => 'กรอกข้อมูลทั่วไป' . __('products.page_title')]" />
                </div>
                <div class="row">
                    <input type="hidden" name="id" id="id" value="{{ $product->id }}">
                    <div class="col-12 text-end">
                        <a href="{{ route('products.index') }}"
                            class="btn btn-secondary btn-custom-size me-2">{{ __('manage.back') }}</a>
                            <button type="button"
                                class="btn btn-primary btn-custom-size btn-save-form">{{ __('manage.save') }}</button>
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
            $('#name').prop('disabled', true);
            $('#price').prop('disabled', true);
            $('#categoryId').prop('disabled', true);
            $('#detail').prop('disabled', true);
            $('#mfg_date').prop('disabled', true);
            $('#exp_date').prop('disabled', true);
        }

        $(".btn-save-form").on("click", function() {
            let storeUri = "{{ route('products.store') }}";
            var formData = new FormData(document.querySelector('#productForm'));
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
                    if (response.data.errors) {
                        var errors = response.data.errors;

                        $('.error').removeClass('invalid-feedback').html('');
                        $("input[type='text'], select").removeClass('is-invalid');

                        $.each(errors, function(key, value) {
                            $(`#${key}`).addClass('is-invalid')
                                .siblings('p')
                                .addClass('invalid-feedback')
                                .html(value);
                        });
                    }
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
