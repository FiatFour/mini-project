@extends('layouts.app')

@section('content')
    <section class="content">

        <form action="" method="POST" id="productForm" name="productForm">

        <!-- Search -->
        <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">{{ __('manage.add') . __('orders.page_title') }}</h1>
        <div class="p-3 bg-body-extra-light rounded push">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">ข้อมูล{{ __('orders.shop') }}</h1>
                <a href="{{ route('products.create') }}" type="button" class="btn btn-alt-danger my-2">
                    <i class="fa fa-fw fa-plus me-1"></i> จัดพิมพ์ PDF
                </a>
            </div>
                <div class="row mb-4">
                    <div class="col-3">
                        <x-forms.input disabled id="name" :value="$product->name" :label="'ชื่อ' . __('orders.shop')"
                                       :optionals="['placeholder' => 'กรอกข้อมูลชื่อ' . __('orders.shop')]"/>
                    </div>
                    <div class="col-3">
                        <x-forms.input id="name" :value="$product->name" :label="'ชื่อผู้สั่งซื้อ/' . __('orders.shop')"
                                       :optionals="['placeholder' => 'กรอกข้อมูลชื่อ' . __('orders.shop')]"/>
                    </div>
                    <div class="col-3">
                        <x-forms.input id="name" :value="$product->name" :label="'เบอร์ติดต่อ'"
                                       :optionals="['placeholder' => 'เบอร์ติดต่อ']"/>
                    </div>
                    <div class="col-3">
                        <x-forms.input id="name" :value="$product->name"
                                       :label="'ที่อยู่' . __('orders.shop') . 'จัดส่ง'"
                                       :optionals="['placeholder' => 'ที่อยู่' . __('orders.shop'). 'จัดส่ง']"/>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-3">
                        <x-forms.input id="mfg_date" :value="$product->mfg_date" :label="'วันที่สั่งซื้อ'"
                                       :optionals="['input_class' => 'js-flatpickr', 'placeholder' => 'Y-m-d',]"/>
                    </div>

                    <div class="col-3">
                        <x-forms.input id="exp_date" :value="$product->exp_date" :label="'วันที่จัดส่ง'"
                                       :optionals="['input_class' => 'js-flatpickr', 'placeholder' => 'Y-m-d',]"/>
                    </div>
                </div>

        </div>

        <div class="block block-rounded">
            <div class="block-content">
                <!-- All Category Table -->
                <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                    <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">เพึ่มสินค้า</h1>
                    <a href="#" type="button" class="btn btn-alt-primary my-2" data-bs-toggle="modal" data-bs-target="#modal-block-popout">
                        <i class="fa fa-fw fa-plus me-1"></i> เพึ่มข้อมูล
                    </a>
                @include('orders.modal')
                </div>


                <div class="table-responsive">
                    <table class="table table-striped table-borderless table-vcenter">
                        <thead>
                        <tr class="bg-body-dark">
                            <th class="d-none d-sm-table-cell text-center" style="width: 40px;">#</th>
                            <th>ชื่อ{{ __('products.page_title') }}</th>
                            <th>{{ __('categories.page_title') }}</th>
                            <th>ราคาขาย</th>
                            <th>จำนวน</th>
                            <th>Sub total</th>
                            <th>Total</th>
                            <th class="text-center">เครื่องมือ</th>
                        </tr>
                        </thead>
                        <tbody id="orderDetailsTableBody">
                        <!-- ตารางจะแสดงข้อมูลที่ถูกเพิ่มจาก Modal ที่นี่ -->

                        </tbody>
                    </table>
                </div>
                <div class="d-flex flex-row d-flex justify-content-end">
                    {{ $products->links() }}
                </div>

            </div>
        </div>
        <div class="row">
            <input type="hidden" name="id" id="id" value="{{ $product->id }}">
            <div class="col-12 text-end">
                <a href="{{ route('orders.index') }}"
                   class="btn btn-secondary btn-custom-size me-2">{{ __('manage.back') }}</a>
                @if (!isset($view))
                    <button type="button" id="btnOrderSave"
                            class="btn btn-primary btn-custom-size btn-save-form">{{ __('manage.save') }}</button>
                @endif
            </div>
        </div>
        </form>

    </section>
@endsection

@push('scripts')
    <script>
        $('.js-select2-default').select2({
            placeholder: "",
            dropdownParent: $('#modal-block-popout'),
        });

        // เก็บข้อมูลที่จะแสดงในตาราง
        var orderDetailsData = [];

        // เพิ่มข้อมูลจาก Modal เข้า Array
        function addOrderDetail(data) {
            orderDetailsData.push(data);
            refreshTable();
        }

        // รีเฟรชตาราง
        function refreshTable() {
            var tableBody = $('#orderDetailsTableBody');
            tableBody.empty();

            // แสดงข้อมูลในตาราง
            orderDetailsData.forEach(function (orderDetail, index) {
                var row = `<tr>
                    <td> ${index + 1}</td>
                    <td class="fw-semibold"><a href="javascript:void(0)">${orderDetail.productName}</a></td>
                    <td class="d-none d-sm-table-cell">${orderDetail.categoryName}</td>
                    <td class="d-none d-sm-table-cell">${orderDetail.price}</td>
                    <td class="d-none d-sm-table-cell">${orderDetail.amount}</td>
                    <td class="d-none d-sm-table-cell">${orderDetail.sub_total.toFixed(2)}</td>
                    <td class="d-none d-sm-table-cell">${orderDetail.total.toFixed(2)}</td>
                    <td class="text-center">
                    <button type="button" class="btn btn-danger btn-sm" onclick="deleteOrderDetail(${index})">
                    <i class="fa fa-trash-alt"></i> ลบ
                    </button> +
                    </td> +
                    </tr>`;

                tableBody.append(row);
            });
        }

        // ลบข้อมูลจาก Array
        function deleteOrderDetail(index) {
            orderDetailsData.splice(index, 1);
            refreshTable();
        }

        // เมื่อคลิกปุ่มบันทึก Order
        $('#btnOrderSave').click(function () {
            // ทำบันทึก Order ตรงนี้
            // ...
            // รีเฟรชตารางหลังจากบันทึก
            orderDetailsData = [];
            refreshTable();
        });
    </script>
@endpush
