<div class="modal fade" id="modal-block-popout" tabindex="-1" role="dialog" aria-labelledby="modal-block-popout"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-popout" role="document">
        <div class="modal-content">
            <div class="block block-rounded block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">{{ __('manage.btn_add') }}</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <form action="" method="POST" id="orderForm" name="orderForm">
                        <div class="row mb-4">
                            <div class="col-6">
                                <label class="text-start col-form-label"
                                       for="productId">{{'ชื่อ' . __('products.page_title')}}</label>
                                <select class="form-select js-select2-default" id="productName" name="productName"
                                        style="width: 100%;"
                                        data-placeholder="เลือก..">
                                    <option></option>
                                    <!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                    @if (!empty($products2))
                                        @foreach ($products2 as $product)
                                            <option {{ $product->name == '' ? 'selected' : '' }} value="{{ $product->name }}">
                                                {{ $product->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>

                            <div class="col-6">
                                <label class="text-start col-form-label"
                                       for="categoryName">{{'ชื่อ' . __('products.page_title')}}</label>
                                <select class="form-select js-select2-default" id="categoryName" name="categoryName"
                                        style="width: 100%;"
                                        data-placeholder="เลือก.." disabled>
                                    <option></option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-6">
                                <label class="text-start col-form-label"
                                       for="price">{{'ชื่อ' . __('products.page_title')}}</label>
                                <select class="form-select js-select2-default" id="price" name="price"
                                        style="width: 100%;"
                                        data-placeholder="เลือก.." disabled>
                                    <option></option>
                                </select>
                            </div>

                            <div class="col-6">
                                <label class="text-start col-form-label" for="amount">
                                    จำนวน
                                </label>
                                <input type="number" class="form-control col-sm-4" id="amount"
                                       name="amount" placeholder="00">
                                <p></p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="block-content block-content-full text-end bg-body">
                <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                <button type="button" class="btn btn-sm btn-primary"  id="saveOrderDetail" data-bs-dismiss="modal">บันทึก</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $("#productName").change(function () {
            var productName = $('#productName').val(); // $('#categoryForm')
            // var productId = $('.productId').val(); // $('#categoryForm')

            // console.log(pd);
            $.ajax({
                url: "{{route('orders.getProduct')}}", // Notice the double curly braces for route()
                type: 'get',
                data: {
                    productName: productName
                },
                dataType: 'json',
                success: function (response) {
                    if (response['success'] === true) {
                        var categoryName = response['categoryName'];
                        var price = response['price'];

                        // Clear existing options
                        $('#categoryName').empty();
                        $('#price').empty();

                        // Add the new option
                        $('#categoryName').append($('<option>', {
                            value: categoryName,
                            text: categoryName
                        }));
                        $('#price').append($('<option>', {
                            value: price,
                            text: price
                        }));

                        // Trigger Select2 to update the display
                        $('#categoryName').trigger('change');
                        $('#price').trigger('change');
                    }
                }
            });
        });

        // เมื่อคลิกปุ่มบันทึกใน Modal
        $('#saveOrderDetail').click(function () {
            var productName = $('#productName').val();
            var categoryName = $('#categoryName').val();
            var price = $('#price').val();
            var amount = $('#amount').val();

            // ตรวจสอบว่าข้อมูลไม่ว่างเปล่า
            if (productName && categoryName && price && amount) {
                var data = {
                    productName: productName,
                    categoryName: categoryName,
                    price: price,
                    amount: amount,
                    sub_total: price*amount,
                    total: (price*amount)*(100/7)
                };

                // เพิ่มข้อมูลลง Array และรีเฟรชตาราง
                addOrderDetail(data);

                // รีเซ็ตค่าใน Modal
                $('#productName').val('').trigger('change');
                $('#categoryName').val('').trigger('change');
                $('#price').val('').trigger('change');
                $('#amount').val('');

                // ปิด Modal
                $('#modal-block-popout').modal('hide');
            } else {
                alert('กรุณากรอกข้อมูลให้ครบถ้วน');
            }
        });
    </script>
@endpush
