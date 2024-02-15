@extends('layouts.app')

@include('orders.modal')
@section('content')
    <div class="content">
        <!-- Search -->
        <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">{{ __('manage.manage') . __('orders.page_title') }}</h1>
        @if (session('message'))
            <div class="alert alert-success">{{ session('message') }} </div>
        @endif
        <div class="p-3 bg-body-extra-light rounded push">
            <form action="" method="GET">
                <div class="row mb-4">
                    <div class="col-3">
                        <x-forms.input id="keyword" :value="$keyword" :label="'คำค้นหา'" :optionals="['placeholder' => 'ใส่คำค้นหา']" />
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
                    <a href="{{ route('products.create') }}" type="button" class="btn btn-alt-success my-2"
                        style="margin-right: 5px">
                        <i class="fa fa-fw fa-plus me-1"></i> ดาวน์โหลด Excel
                        <a href="{{ route('orders.create') }}" type="button" class="btn btn-alt-primary my-2">
                            <i class="fa fa-fw fa-plus me-1"></i> เพึ่มข้อมูล
                        </a>
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped table-borderless table-vcenter">
                        <thead>
                            <tr class="bg-body-dark">
                                <th class="d-none d-sm-table-cell text-center" style="width: 40px;">#</th>
                                <th>ชื่อผู้สั่งซื้อ/ร้านค้า</th>
                                <th>วันที่ซื้อ</th>
                                <th>วันที่จัดส่ง</th>
                                <th>จำนวนสินค้า</th>
                                <th>จำนวนสินค้าเงินรวมทั้งสิ้น</th>
                                {{-- <th class="d-none d-sm-table-cell">สถานะ</th> --}}
                                <th class="text-center">เครื่องมือ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($orders->isNotEmpty())
                                @foreach ($orders as $order)
                                    <tr>
                                        <td class="d-none d-sm-table-cell text-center">
                                            {{ $orders->firstItem() + $loop->index }}</td>
                                        <td class="fw-semibold">
                                            <a href="javascript:void(0)">{{ $order->name }}</a>
                                        </td>
                                        <td class="d-none d-sm-table-cell">
                                            {{ $order->order_date }}
                                        </td>
                                        <td class="d-none d-sm-table-cell">
                                            {{ $order->shipping_date }}
                                        </td>
                                        <td class="d-none d-sm-table-cell">
                                            {{ $order->amount }}
                                        </td>
                                        <td class="d-none d-sm-table-cell">
                                            {{ number_format($order->total, 2) }}
                                        </td>
                                        <td class="text-center">
                                            <div class="block-options">
                                                <div class="dropdown">
                                                    <button type="button" class="btn-block-option"
                                                        data-bs-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v"></i>
                                                    </button>
                                                    {{-- TODO --}}
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a href="{{ route('orders.show', ['order' => $order]) }}"
                                                            class="dropdown-item">
                                                            <i class="fa fa-fw fa-eye me-1"></i> ดูข้อมูล
                                                        </a>
                                                        <a href="{{ route('orders.edit', ['order' => $order]) }}"
                                                            class="dropdown-item">
                                                            <i class="fa fa-fw fa-edit me-1"></i> แก้ไข
                                                        </a>
                                                        <a class="dropdown-item"  href="javascript:void(0)"
                                                           onclick="deleteRecord('{{ $order->id }}')">
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
                    {{ $orders->links() }}
                </div>

            </div>
        </div>
    </div>


@endsection


@push('scripts')
    <script>
        function deleteRecord(id) {
            console.log(id);
            var url = "{{ route('orders.destroy', 'ID') }}"
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