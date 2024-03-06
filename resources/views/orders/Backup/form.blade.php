@extends('layouts.app')

@section('content')
    <section class="content">

        <form id="save-form">

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
                            {{'รหัส' . __('orders.shop')}}
                        </label>
                        <input disabled type="text" class="form-control col-sm-4" placeholder="กรอกข้อมูลร้านค้า"
                               value="{{isset($order) ? $order->id : ' '}}">
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

            <div class="block block-rounded">
                <div class="block-content">
                    <!-- All Category Table -->
                    @if (!isset($view))
                        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                            <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">ข้อมูลสินค้า</h1>
                            <a href="#" type="button" class="btn btn-alt-primary my-2" data-bs-toggle="modal"
                               data-bs-target="#modal-block-popout">
                                <i class="fa fa-fw fa-plus me-1"></i> เพึ่มข้อมูล
                            </a>
                            @include('orders.Backup.modal')
                        </div>
                    @endif

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
                            @if (isset($edit) || isset($view))
                                @if (sizeof($orderDetailsWithRelations) > 0 )
                                    @foreach ($orderDetailsWithRelations as $index => $orderDetailsWithRelation)
                                        <tr>
                                            <td class="d-none d-sm-table-cell text-center">
                                                {{ $index + 1 }}</td>
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
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <a href="{{ route('orders.show', ['order' => $order]) }}"
                                                               class="dropdown-item">
                                                                <i class="fa fa-fw fa-eye me-1"></i> ดูข้อมูล
                                                            </a>
                                                            <a onclick="editOrderDetail({{$index}})"
                                                               class="dropdown-item">
                                                                <i class="fa fa-fw fa-edit me-1"></i> แก้ไข
                                                            </a>
                                                            <a class="dropdown-item" href="#"
                                                               onclick="deleteRecord({{ $order->id }})">
                                                                <i class="fa fa-fw fa-trash-alt me-1"></i> ลบ
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>

                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            @if (isset($edit) || isset($view))
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
                                   value="{{$order->total - $order->sub_total}}">
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
                            <input type="text" class="form-control col-sm-4" value="" id="discount">
                        </div>

                    </div>

                    <label class="text-start col-form-label">
                        หักภาษี
                    </label>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="taxCheckbox"
                               name="taxCheckbox">
                        <label class="form-check-label" for="taxCheckbox">หักภาษี ณ ที่จ่าย 3 %</label>
                    </div>
                </div>
            @endif

            <div class="row">
                <input type="hidden" name="order_id" id="order_id" value="{{ $order->id }}">
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

@include('components.select2-default')
@include('components.sweetalert')
@include('components.form-save', [
    'store_uri' => route('orders.store'),
])

@push('scripts')
    <script>
        {{--('{{count($orderDetailsWithRelations)}}')}--}}
            $view = '{{ isset($view) }}';
        $edit = '{{ isset($edit) }}';
        var count = 1;
        if ($edit) {
            // Convert orderDetailsWithRelations to JavaScript array
            {{--var orderDetailsWithRelations = {!! json_encode($orderDetailsWithRelations) !!};--}}

            {{--if (Array.isArray(orderDetailsWithRelations)) {--}}
            {{--    orderDetailsWithRelations.forEach(function (orderDetail) {--}}
            {{--        addOrderDetail(orderDetail);--}}
            {{--    });--}}
            {{--} else {--}}
            {{--    console.error('Invalid or empty server response for orderDetailsWithRelations');--}}
            {{--}--}}
        }
        if ($view) {
            $('#order_name').prop('disabled', true);
            $('#order_phone').prop('disabled', true);
            $('#order_address').prop('disabled', true);
            $('#order_date').prop('disabled', true);
            $('#shipping_date').prop('disabled', true);
            $('#discount').prop('disabled', true);
            $('#taxCheckbox').prop('disabled', true);
        }

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
            var count = 1; // Initialize count

            {{--if ($edit) {--}}
            {{--    count += {{count($orderDetailsWithRelations)}};--}}
            {{--}--}}

            // แสดงข้อมูลในตาราง
            orderDetailsData.forEach(function (orderDetail, index) {
                var row =
                    `<tr>
                            <td> ${(count + index)} </td> // Updated this line
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

        $("#btnOrderSave").on("click", function () {
            console.log('hi');
            let storeUri = "{{ route('orders.store') }}";
            var formData = new FormData(document.querySelector('#orderForm'));
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

                        $.each(errors, function (key, value) {
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
