@extends('layouts.app')

@section('content')
    <section class="content">

        <form action="" method="POST" id="orderForm" name="orderForm">

            <!-- Search -->
            <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">{{ $page_title }}</h1>
            <div class="p-3 bg-body-extra-light rounded push">
                <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                    <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">ข้อมูล{{ __('orders.shop') }}</h1>
                    <a href="{{ route('products.create') }}" type="button" class="btn btn-alt-danger my-2">
                        <i class="fa fa-fw fa-plus me-1"></i> จัดพิมพ์ PDF
                    </a>
                </div>
                <div class="row mb-4">
                    <div class="col-3">
                        <label class="text-start col-form-label" for="shop_code">
                            {{'ชื่อ' . __('orders.shop')}}
                        </label>
                        <input disabled type="text" class="form-control col-sm-4" placeholder="กรอกข้อมูลร้านค้า">
                        <p></p>
                    </div>

                    <div class="col-3">
                        <x-forms.input id="order_name" :value="$order->name"
                                       :label="'ชื่อผู้สั่งซื้อ/' . __('orders.shop')"
                                       :optionals="['placeholder' => 'กรอกข้อมูลชื่อ' . __('orders.shop')]"/>
                    </div>

                    <div class="col-3">
                        <label class="text-start col-form-label" for="order_phone">
                            เบอร์ติดต่อ
                        </label>
                        <input type="text" id="order_phone" class="form-control col-sm-4" placeholder="เบอร์ติดต่อ"
                               name="order_phone" maxlength="10" value="{{$order->phone}}">
                        <p></p>
                    </div>
                    {{--                    <div class="col-3">--}}
                    {{--                        <x-forms.input id="order_phone" :value="$order->phone" :label="'เบอร์ติดต่อ'"--}}
                    {{--                                       :optionals="['placeholder' => 'เบอร์ติดต่อ']"/>--}}
                    {{--                    </div>--}}

                    <div class="col-3">
                        <x-forms.input id="order_address" :value="$order->address"
                                       :label="'ที่อยู่' . __('orders.shop') . 'จัดส่ง'"
                                       :optionals="['placeholder' => 'ที่อยู่' . __('orders.shop'). 'จัดส่ง']"/>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-3">
                        <x-forms.input id="order_date" :value="$order->order_date" :label="'วันที่สั่งซื้อ'"
                                       :optionals="['input_class' => 'js-flatpickr', 'placeholder' => 'Y-m-d',]"/>
                    </div>

                    <div class="col-3">
                        <x-forms.input id="shipping_date" :value="$order->shipping_date" :label="'วันที่จัดส่ง'"
                                       :optionals="['input_class' => 'js-flatpickr', 'placeholder' => 'Y-m-d',]"/>
                    </div>
                </div>
            </div>
        </form>

        <div class="block block-rounded">
            <div class="block-content">
                <!-- All Category Table -->
                <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                    <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">ข้อมูลสินค้า</h1>
                    <a href="#" type="button" class="btn btn-alt-primary my-2" data-bs-toggle="modal"
                       data-bs-target="#modal-block-popout">
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
                            <th>ราคา (ไม่รวม VAT)</th>
                            <th>ราคาสุทธิ (รวม VAT)</th>
                            <th class="text-center">เครื่องมือ</th>
                        </tr>
                        </thead>
                        <tbody id="orderDetailsTableBody">
                        @if ($orderDetailsWithRelations->isNotEmpty())
                            @foreach ($orderDetailsWithRelations as $orderDetailsWithRelation)
                                <tr>
                                    <td class="d-none d-sm-table-cell text-center">
                                        {{ $orderDetailsWithRelations->firstItem() + $loop->index }}</td>
                                    <td class="fw-semibold">
                                        <a href="javascript:void(0)">{{ $orderDetailsWithRelation->productName }}</a>
                                    </td>
                                    <td class="d-none d-sm-table-cell">
                                        {{ $orderDetailsWithRelation->categoryName }}
                                    </td>
                                    <td class="d-none d-sm-table-cell">
                                        {{ number_format($orderDetailsWithRelation->price, 2) }}
                                    </td>
                                    <td class="d-none d-sm-table-cell">
                                        {{ $orderDetailsWithRelation->amount }}
                                    </td>
                                    <td class="d-none d-sm-table-cell">
                                        {{ number_format($orderDetailsWithRelation->sub_total, 2) }}
                                    </td>
                                    <td class="d-none d-sm-table-cell">
                                        {{ number_format($orderDetailsWithRelation->total, 2) }}
                                    </td>
                                    <td class="text-center">
                                        <div class="block-options">
                                            <div class="dropdown">
                                                <button type="button" class="btn-block-option"
                                                        data-bs-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                    <i class="fa fa-ellipsis-v"></i>
                                                </button>
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
                    {{ $orderDetailsWithRelations->links() }}
                </div>

            </div>
        </div>

        <div class="p-3 bg-body-extra-light rounded push">
            <div class="row mb-4">
                <div class="col-3">
                    <label class="text-start col-form-label">
                        ราคา (ไม่รวม VAT)
                    </label>
                    <input disabled type="text" class="form-control col-sm-4" value="{{$order->sub_total}}">
                </div>
                <div class="col-3">
                    <label class="text-start col-form-label">
                        VAT 7%
                    </label>
                    <input disabled type="text" class="form-control col-sm-4"
                           value="{{$order->sub_total - $order->total}}">
                </div>
                <div class="col-3">
                    <label class="text-start col-form-label">
                        จำนวนเงินรวมทั้งสิ้น
                    </label>
                    <input disabled type="text" class="form-control col-sm-4" value="{{$order->total}}">
                </div>
                <div class="col-3">
                    <label class="text-start col-form-label">
                        ส่วนลด
                    </label>
                    <input type="text" class="form-control col-sm-4" value="{{$order->sub_total}}">
                </div>

            </div>

            <label class="text-start col-form-label">
                หักภาษี
            </label>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="example-checkbox-default1"
                       name="example-checkbox-default1" checked>
                <label class="form-check-label" for="example-checkbox-default1">หักภาษี ณ ที่จ่าย 3 %</label>
            </div>
        </div>

        <div class="row">
            <input type="hidden" name="id" id="id" value="{{ $order->id }}">
            <div class="col-12 text-end">
                <a href="{{ route('orders.index') }}"
                   class="btn btn-secondary btn-custom-size me-2">{{ __('manage.back') }}</a>
                @if (!isset($view))
                    <button type="button" id="btnOrderSave"
                            class="btn btn-primary btn-custom-size btn-save-form">{{ __('manage.save') }}</button>
                @endif
            </div>
        </div>

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
                var row =
                    `<tr>
                            <td> ${index + 1}</td>
                            <td class="fw-semibold"><a href="javascript:void(0)">${orderDetail.productName}</a></td>
                            <td class="d-none d-sm-table-cell">${orderDetail.categoryName}</td>
                            <td class="d-none d-sm-table-cell">${orderDetail.price}</td>
                            <td class="d-none d-sm-table-cell">${orderDetail.amount}</td>
                            <td class="d-none d-sm-table-cell">${orderDetail.sub_total.toFixed(2)}</td>
                            <td class="d-none d-sm-table-cell">${orderDetail.total.toFixed(2)}</td>
                            <td class="text-center">
                                 <div class="block-options">
                                     <div class="dropdown">
                                         <button type="button" class="btn-block-option"
                                             data-bs-toggle="dropdown" aria-haspopup="true"
                                             aria-expanded="false">
                                             <i class="fa fa-ellipsis-v"></i>
                                         </button>
                                         <div class="dropdown-menu dropdown-menu-end">
                                             <a href="#" onclick="editOrderDetail(${index})"
                                                 class="dropdown-item" href="javascript:void(0)">
                                                 <i class="fa fa-fw fa-edit me-1"></i> แก้ไข
                                             </a>
                                             <a class="dropdown-item" href="#"
                                                 onclick="deleteOrderDetail(${index})">
                                                 <i class="fa fa-fw fa-trash-alt me-1"></i> ลบ
                                             </a>
                                         </div>
                                     </div>
                                 </div>
                             </td>
                        </tr>`;

                tableBody.append(row);
            });
        }

        // ลบข้อมูลจาก Array
        function deleteOrderDetail(index) {
            orderDetailsData.splice(index, 1);
            refreshTable();
        }

        $('#btnOrderSave').click(function () {
            var orderForm = $('#orderForm').serializeArray();
            $.ajax({
                url: "{{ route('orders.store') }}",
                type: 'post',
                data: JSON.stringify({
                    orderDetails: orderDetailsData,
                    orderForm: orderForm,
                }),
                dataType: 'json',
                success: function (response) {
                    $(".btnOrderSave").prop('disabled', false);

                    if (response['success']) {
                        window.location.href = "{{ route('orders.index') }}";
                    } else {
                        var errors = response.errors;
                        $('.error').removeClass('invalid-feedback').html('');
                        $("input[type='text'], select").removeClass('is-invalid');

                        $.each(errors, function (key, value) {
                            $(`#${key}`,).addClass('is-invalid')
                                .siblings('p')
                                .addClass('invalid-feedback')
                                .html(value);
                        });
                    }
                },
                error: function (jqXHR, exception) {
                    // Handle error here, e.g., display an error message
                    console.log("Something went wrong");
                    console.log(jqXHR);
                }
            });

            orderDetailsData = [];
            refreshTable();
        });

        // Variable to store the index of the order detail being edited
        var selectedOrderDetailIndex = null;

        // Function to populate the modal fields for editing
        function editOrderDetail(index) {
            selectedOrderDetailIndex = index;

            // Fetch the order detail from the array
            var orderDetail = orderDetailsData[index];

            // Populate the modal fields with the order detail data
            $('#productName').val(orderDetail.productName).trigger('change');
            $('#categoryName').val(orderDetail.categoryName).trigger('change');
            $('#price').val(orderDetail.price).trigger('change');
            $('#amount').val(orderDetail.amount);
            $('#orderDetailIndex').val(index);

            // Show the modal for editing
            $('#modal-block-popout').modal('show');
        }
    </script>
@endpush
