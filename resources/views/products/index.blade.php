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
                        <x-forms.input id="keyword" :value="$keyword" :label="'คำค้นหา'" :optionals="['placeholder' => 'ใส่คำค้นหา']" />
                    </div>
                    <div class="col-3">
                        <x-forms.select id="name" :name="'name'" :items="$products2" :selected="$name"
                            :label="'ชื่อ' . __('products.page_title')" :optionals="['placeholder' => 'เลือก..']" />
                    </div>
                    <div class="col-3">
                        <x-forms.select id="categoryId" :name="'categoryName'" :items="$categories" :selected="$categoryId"
                            :label="'ชื่อ' . __('categories.page_title')" :optionals="['placeholder' => 'เลือก..']" />
                    </div>
                    <div class="col-3">
                        <x-forms.input id="exp_date" :value="$exp_date" :label="'วันหมดอายุ'" :optionals="['input_class' => 'js-flatpickr', 'placeholder' => 'Y-m-d',]"/>
                    </div>
                </div>
                <div class="d-flex flex-row d-flex justify-content-end">
                    <a href="{{ route('products.index') }}" class="btn btn-secondary"
                        style="margin-left: 4%; width: 100px">ล้างข้อมูล</a>
                    <button type="submit" class="btn btn-primary" style="margin-left: 2%; width: 100px">ค้นหา</button>
                </div>
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
                                @foreach ($products as $product)
                                    <tr>
                                        <td class="d-none d-sm-table-cell text-center">
                                            {{ $products->firstItem() + $loop->index }}</td>
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
                                        <td class="text-center">
                                            <div class="block-options">
                                                <div class="dropdown">
                                                    <button type="button" class="btn-block-option"
                                                        data-bs-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v"></i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a href="{{ route('products.show', ['product' => $product]) }}"
                                                            class="dropdown-item">
                                                            <i class="fa fa-fw fa-eye me-1"></i> ดูข้อมูล
                                                        </a>
                                                        <a href="{{ route('products.edit', ['product' => $product]) }}"
                                                            class="dropdown-item">
                                                            <i class="fa fa-fw fa-edit me-1"></i> แก้ไข
                                                        </a>
                                                        <a class="dropdown-item" href="#"
                                                            onclick="deleteRecord({{ $product->id }})">
                                                            <i class="fa fa-fw fa-trash-alt me-1"></i> ลบ
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>

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


                <!-- Pagination -->
                {{-- <nav aria-label="Photos Search Navigation">
                    <ul class="pagination justify-content-end mt-2">
                        <li class="page-item">
                            <a class="page-link" href="javascript:void(0)" tabindex="-1" aria-label="Previous">
                                Prev
                            </a>
                        </li>
                        <li class="page-item active">
                            <a class="page-link" href="javascript:void(0)">1</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="javascript:void(0)">2</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="javascript:void(0)">3</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="javascript:void(0)">4</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="javascript:void(0)" aria-label="Next">
                                Next
                            </a>
                        </li>
                    </ul>
                </nav> --}}
                <!-- END Pagination -->
            </div>
        </div>
    </div>
@endsection


@push('scripts')
    <script>
        function deleteRecord(id) {
            var url = "{{ route('products.destroy', 'ID') }}"
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
                    axios.delete(newUrl).then(response => {
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
                            title: "เกิดข้อผิดพลาดaa",
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
                }
            });
        }
    </script>
@endpush

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
