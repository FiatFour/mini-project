@extends('layouts.app')

@section('content')
    <div class="content">
        <!-- Search -->
        <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">{{ __('manage.manage') . __('products.page_title') }}</h1>
        @if (session('message'))
            <div class="alert alert-success">{{ session('message') }} </div>
        @endif
        <div id="addAttorneyVue">

        </div>
        <div class="p-3 bg-body-extra-light rounded push">
            <form action="" method="GET">
                <div class="row mb-4">
                    <div class="col-3">
                        <x-forms.input id="s" :value="$s" :label="'คำค้นหา'" :optionals="['placeholder' => 'ใส่คำค้นหา']" />
                    </div>
                    <div class="col-3">
{{--                        <x-forms.select id="name" :name="'name'" :items="$products2" :selected="$name"--}}
{{--                            :label="'ชื่อ' . __('products.page_title')" :optionals="['placeholder' => 'เลือก..']" />--}}

                        <x-forms.select-option id="product_id" :value="$product_id" :list="$products2"
                                                   :label="__('products.page_title')" />
                    </div>
                    <div class="col-3">
                        <x-forms.select-option id="categoryId" :value="$categoryId" :list="$categories"
                                               :label="__('categories.page_title')" />

{{--                        <x-forms.select id="categoryId" :name="'categoryName'" :items="$categories" :selected="$categoryId"--}}
{{--                            :label="'ชื่อ' . __('categories.page_title')" :optionals="['placeholder' => 'เลือก..']" />--}}
                    </div>
                    <div class="col-3">
                        <x-forms.input id="exp_date" :value="$exp_date" :label="'วันหมดอายุ'" :optionals="['input_class' => 'js-flatpickr', 'placeholder' => 'Y-m-d',]"/>
                    </div>
                </div>
                @include('components.btns.search')
            </form>
        </div>


        <!-- All Category -->
        <div class="block block-rounded">

            <div class="block-content">
                <!-- All Category Table -->
                <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                    <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3"></h1>
                    <a href="{{ route('products.create') }}" type="button" class="btn btn-alt-primary my-2">
                        <i class="fa fa-fw fa-plus me-1"></i> เพึ่มข้อมูล
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-borderless table-vcenter">
                        <thead>
                            <tr class="bg-body-dark">
                                <th class="d-none d-sm-table-cell text-center" style="width: 40px;">#</th>
                                <th>ชื่อ{{ __('products.page_title') }}</th>
                                <th>{{ __('categories.page_title') }}</th>
                                <th>ราคาขาย</th>
                                <th>วันหมดอายุ</th>
                                {{-- <th class="d-none d-sm-table-cell">สถานะ</th> --}}
                                <th class="text-center">เครื่องมือ</th>
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

<script>
    let addAttorneyVue = new Vue({
        el: '#attorney',
        data: {
            attorney_list: @if (isset($attorney_list))
                @json($attorney_list)
                @else
            []
            @endif ,
            edit_index: null,
            total_car: 0,
            mode: null,
        },
        methods: {

        },
        props: ['title'],
    });
</script>

{{--@push('scripts')--}}
{{--    <script>--}}
{{--        function deleteRecord(id) {--}}
{{--            var url = "{{ route('products.destroy', 'ID') }}"--}}
{{--            var newUrl = url.replace('ID', id)--}}
{{--            Swal.fire({--}}
{{--                title: "ยืนยันลบข้อมูล",--}}
{{--                text: "ต้องการลบข้อมูลใช่หรือไม่?",--}}
{{--                icon: "warning",--}}
{{--                showCancelButton: true,--}}
{{--                confirmButtonColor: "#d33",--}}
{{--                cancelButtonColor: "#767E88",--}}
{{--                cancelButtonText: "ยกเลิก",--}}
{{--                confirmButtonText: "ยืนยัน"--}}
{{--            }).then((result) => {--}}
{{--                if (result.isConfirmed) {--}}
{{--                    axios.delete(newUrl).then(response => {--}}
{{--                        if (response.data.success) {--}}
{{--                            Swal.fire({--}}
{{--                                title: "สำเร็จ",--}}
{{--                                text: "{{ __('manage.store_success_message') }}",--}}
{{--                                icon: "success",--}}
{{--                                showCancelButton: false,--}}
{{--                                confirmButtonColor: "btn btn-success",--}}
{{--                                confirmButtonText: "ตกลง"--}}
{{--                            }).then(value => {--}}
{{--                                if (response.data.redirect) {--}}
{{--                                    window.location.href = response.data.redirect;--}}
{{--                                }--}}
{{--                            });--}}
{{--                        } else {--}}
{{--                            Swal.fire({--}}
{{--                                title: "เกิดข้อผิดพลาด",--}}
{{--                                text: response.data.message,--}}
{{--                                icon: "error",--}}
{{--                                showCancelButton: false,--}}
{{--                                confirmButtonColor: "btn btn-danger",--}}
{{--                                confirmButtonText: "ตกลง"--}}
{{--                            }).then(value => {--}}
{{--                                if (value) {--}}
{{--                                    //--}}
{{--                                }--}}
{{--                            });--}}
{{--                        }--}}
{{--                    }).catch(error => {--}}
{{--                        Swal.fire({--}}
{{--                            title: "เกิดข้อผิดพลาดaa",--}}
{{--                            text: response.data.message,--}}
{{--                            icon: "error",--}}
{{--                            showCancelButton: false,--}}
{{--                            confirmButtonColor: "btn btn-danger",--}}
{{--                            confirmButtonText: "ตกลง"--}}
{{--                        }).then(value => {--}}
{{--                            if (value) {--}}
{{--                                //--}}
{{--                            }--}}
{{--                        });--}}
{{--                    });--}}
{{--                }--}}
{{--            });--}}
{{--        }--}}
{{--    </script>--}}
{{--@endpush--}}

{{-- @section('customJs')
    @include('layouts.message')

    <script>
        function deleteRecord(id) {
            var url = "{{ route('categories.destroy', 'ID') }}"
            var newUrl = url.replace('ID', id)
            Swal.fire({
                title: "ยืนยันลบข้อมูล",
                text: "ต้องการลบข้อมูลใช่หรือไม่?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#767E88",
                cancelButtonText: "ยกเลิก",
                confirmButtonText: "ยืนยัน"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: newUrl,
                        type: 'delete',
                        data: {},
                        dataType: 'json',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            if (response['status']) {
                                window.location.href = "{{ route('categories.index') }}";
                            }
                        }
                    });
                }
            });

        }
    </script>
@endsection --}}
