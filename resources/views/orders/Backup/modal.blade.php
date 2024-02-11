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
                </div>
            </div>
            <div class="block-content block-content-full text-end bg-body">
{{--                <input type="hidden" name="orderDetailIndex" id="orderDetailIndex" value="orderDetailIndex">--}}
                <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                <button type="button" class="btn btn-sm btn-primary" id="saveOrderDetail">บันทึก</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $("#productName").on('change', function(){
            var productName = $('#productName').val();
            axios.get("{{ route('orders.getProduct') }}", {
                params: {
                    productName: productName
                }
            }).then(function (response) {
                    if (response.data.success === true) {
                        var categoryName = response.data.categoryName;
                        var price = response.data.price;

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
                })
                .catch(function (error) {
                    console.error('Error fetching product data:', error);
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
                    sub_total: (price * amount) * (100 / 107),
                    total: price * amount
                };

                console.log(data);
                console.log(selectedOrderDetailIndex);
                if (selectedOrderDetailIndex !== null) {
                    updateOrderDetail();
                } else {
                    // เพิ่มข้อมูลลง Array และรีเฟรชตาราง
                    addOrderDetail(data);
                }

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

        // Function to update the order details array after editing
        function updateOrderDetail() {
            // Fetch the updated data from the modal
            var productName = $('#productName').val();
            var categoryName = $('#categoryName').val();
            var price = $('#price').val();
            var amount = $('#amount').val();

            // Update the order detail in the array
            orderDetailsData[selectedOrderDetailIndex] = {
                productName: productName,
                categoryName: categoryName,
                price: price,
                amount: amount,
                sub_total: (price * amount) * (100 / 7),
                total: price * amount
            };

            // Refresh the table with the updated data
            refreshTable();

            // Reset the selected index and close the modal
            selectedOrderDetailIndex = null;
            $('#modal-block-popout').modal('hide');
        }
    </script>
@endpush
