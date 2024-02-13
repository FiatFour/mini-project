@push('scripts')
    <script>
        let addOrderDetailVue = new Vue({
            el: '#order-detail',
            data: {
                order_detail_list: @if (isset($order_detail_list)) @json($order_detail_list) @else [] @endif,
                edit_index: null,
                mode: null,
            },
            methods: {
                display: function () {
                    $("#order-detail").show();
                },
                addOrderDetail: function () {
                    this.setIndex(this.setLastIndex());
                    this.clearModalData();
                    this.mode = 'add';
                    this.openModal();
                },
                editOrderDetail: function (index) {
                    this.setIndex(index);
                    this.loadModalData(index);
                    this.mode = 'edit';
                    $("#order-detail-modal-label").html('แก้ไขข้อมูล');
                    this.openModal();
                },
                clearModalData: function () {
                    $("#amount").val('');
                    $("#price").val('');
                    $("#product_id").val('').change();
                    $("#category_name").val('').change();
                },
                loadModalData: function (index) {
                    var temp = this.order_detail_list[index];
                    $("#amount_field").val(temp.amount);
                    $("#category_field").val(temp.category_name);
                    $("#price_field").val(temp.price);
                    //$("#province_field").val(temp.province_id).change();

                    if (temp.product_id) {
                        set_select2($("#product_field"), temp.product_id, temp.product_name);
                    }
                    // if (temp.category_id) {
                    //     set_select2($("#category_field"), temp.category_id, temp.category_name);
                    // }
                    // if (temp.price) {
                    //     set_select2($("#price_field"), temp.price, temp.price);
                    // }


                },
                openModal: function () {
                    $("#modal-order-detail").modal("show");
                },
                hideModal: function () {
                    $("#modal-order-detail").modal("hide");
                },
                save: function () {
                    var _this = this;
                    var order_detail = _this.getDataFromModal();
                    if (_this.validateDataObject(order_detail)) {
                        if (_this.mode == 'edit') {
                            var index = _this.edit_index;
                            _this.saveEdit(order_detail, index);
                        } else {
                            _this.saveAdd(order_detail);
                        }
                        _this.edit_index = null;
                        _this.display();
                        _this.hideModal();
                    } else {
                        warningAlert("{{ __('lang.required_field_inform') }}");
                    }
                },
                getDataFromModal: function () {
                    var amount = document.getElementById("amount_field").value;
                    var product_id = document.getElementById("product_field").value;
                    var product_name = (product_id) ? document.getElementById('product_field').selectedOptions[0].text : '';
                    // var category_id = document.getElementById("category_field").value;
                    // var category_name = (category_id) ? document.getElementById('category_field').selectedOptions[0].text : '';
                    // var category_name = (category_id) ? document.getElementById('category_field').text : '';
                    var category_name = document.getElementById("category_field").value;
                    console.log(category_name);
                    // var price = (price_field) ? document.getElementById('price_field').selectedOptions[0].text : '';
                    // var price = (price_field) ? document.getElementById('price_field').selectedOptions[0].text : '';
                    var price = document.getElementById("price_field").value;
                    var price_field = document.getElementById("price_field").value;
                    return {
                        amount: amount,
                        product_id: product_id,
                        product_name: product_name,
                        // category_id: category_id,
                        category_name: category_name,
                        price: price,
                        sub_total: (price * amount) * (100 / 107),
                        total: price * amount
                    };
                },
                validateDataObject: function (order_detail) {
                    if (order_detail.product_id && order_detail.amount) {
                        return true;
                    } else {
                        return false;
                    }
                },
                saveAdd: function (order_detail) {
                    this.order_detail_list.push(order_detail);
                    console.log(this.order_detail_list);
                },
                saveEdit: function (order_detail, index) {
                    addOrderDetailVue.$set(this.order_detail_list, index, order_detail);
                },
                removeOrderDetail: function (index) {
                    this.order_detail_list.splice(index, 1);
                },
                setIndex: function (index) {
                    this.edit_index = index;
                },
                getIndex: function () {
                    return this.edit_index;
                },
                setLastIndex: function () {
                    return this.order_detail_list.length;
                },
                /* set_select2: function(selector, id, value){
                    set_select2(selector, id, value);
                } */
            },
            props: ['title'],
        });
        addOrderDetailVue.display();

        function addOrderDetail() {
            addOrderDetailVue.addOrderDetail();
        }

        function saveOrderDetail() {
            addOrderDetailVue.save();
        }

        $('#category_field').prop('disabled', true);
        $('#price_field').prop('disabled', true);

        $("#product_field").on('select2:select', function (e) {
            var data = e.params.data;
            axios.get("{{ route('orders.getPriceAndCategory') }}", {
                params: {
                    id: data.id,
                }
            }).then(response => {
                if (response.data.success) {
                    console.log(response.data.price);
                    $("#category_field").val(response.data.data.category_name);
                    $("#price_field").val(response.data.data.price);
                }
            });
        });
    </script>
@endpush
