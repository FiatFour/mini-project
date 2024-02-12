<div id="order-detail" v-cloak data-detail-uri="" data-title="">
    <div class="table-wrap">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">ข้อมูลสินค้า</h1>
{{--            <button type="button" class="btn btn-alt-primary my-2" onclick="addOrderDetail()"--}}
{{--                    id="openModal">{{ __('manage.add') . __('orders.sub_title') }}</button>--}}

            <a href="#" type="button" class="btn btn-alt-primary my-2" onclick="addOrderDetail()"
               id="openModal">
                <i class="fa fa-fw fa-plus me-1"></i> {{ __('manage.add') . __('orders.sub_title') }}
            </a>
        </div>

        <table class="table table-striped">
            <thead class="bg-body-dark">
                <th style="width: 2px;">#</th>
                <th style="width: 25%;">ชื่อ{{ __('products.page_title') }}</th>
                <th style="width: 20%;">{{ __('categories.page_title') }}</th>
                <th style="width: 30%;">{{ __('orders.price') }}</th>
                <th style="width: 10%;">{{ __('orders.amount') }}</th>
                <th style="width: 10%;">{{ __('orders.sub_total') }}</th>
                <th style="width: 10%;">{{ __('orders.total') }}</th>
                <th class="sticky-col text-center">{{ __('manage.tools') }}</th>
            </thead>
            <tbody v-if="order_detail_list.length > 0">
                <tr v-for="(item, index) in order_detail_list">
                    <td>@{{ index + 1 }}</td>
                    <td>@{{ item.product_name }}</td>
                    <td>@{{ item.category_name }}</td>
                    <td class="td-break" style="white-space: pre-wrap;">@{{ item.price }}</td>
                    <td>@{{ item.amount }}</td>
                    <td>@{{ item.sub_total }}</td>
                    <td>@{{ item.total }}</td>
{{--                    <td>@{{ item.order_id }}</td>--}}
                    <td class="sticky-col text-center">
                        <div class="btn-group">
                            <div class="col-sm-12">
                                <div class="dropdown dropleft">
                                    <button type="button" class="btn btn-sm btn-alt-secondary dropdown-toggle"
                                        id="dropdown-dropleft-dark" data-bs-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        <i class="fa fa-ellipsis-vertical"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdown-dropleft-dark">
                                        <a class="dropdown-item" v-on:click="editOrderDetail(index)"><i
                                                class="far fa-edit me-1"></i> แก้ไข</a>
                                        <a class="dropdown-item btn-delete-row"
                                            v-on:click="removeOrderDetail(index)"><i
                                                class="fa fa-trash-alt me-1"></i> ลบ</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                    <input type="hidden" v-bind:name="'order_detail['+ index+ '][id]'" v-bind:value="item.id">
                    <input type="hidden" v-bind:name="'order_detail['+ index+ '][order_id]'" id="order_id"
                        v-bind:value="item.order_id">
                    <input type="hidden" v-bind:name="'order_detail['+ index+ '][product_id]'" id="product_id"
                        v-bind:value="item.product_id">
                    <input type="hidden" v-bind:name="'order_detail['+ index+ '][category_id]'" id="category_id"
                        v-bind:value="item.category_id">
                    <input type="hidden" v-bind:name="'order_detail['+ index+ '][price]'" id="price"
                        v-bind:value="item.price">
                    <input type="hidden" v-bind:name="'order_detail['+ index+ '][amount]'" id="amount"
                        v-bind:value="item.amount">
                    <input type="hidden" v-bind:name="'order_detail['+ index+ '][sub_total]'" id="sub_total"
                        v-bind:value="item.sub_total">
                    <input type="hidden" v-bind:name="'order_detail['+ index+ '][total]'" id="total"
                        v-bind:value="item.total">
                </tr>
            </tbody>
            <tbody v-else>
                <tr class="table-empty">
                    <td class="text-center" colspan="8">“
                        {{ __('manage.no_list') . __('orders.sub_title') }} “</td>
                </tr>
            </tbody>
        </table>
    </div>
{{--    <div class="row">--}}
{{--        <div class="col-md-12 text-end">--}}
{{--            <button type="button" class="btn btn-primary" onclick="addOrderDetail()"--}}
{{--                id="openModal">{{ __('manage.add') }}</button>--}}
{{--        </div>--}}
{{--    </div>--}}
</div>
@include('orders.modals.order-detail-modal')


