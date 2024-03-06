<div class="modal fade" id="modal-order-detail" tabindex="-1" aria-labelledby="modal-order-detail"
     aria-hidden="false">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-popout" style="width:1250px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="order-detail-modal-label">{{ __('manage.btn_add') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="block-content">
                    <div class="row mb-4">
                        <div class="col-6">
                            <x-forms.select-option id="product_field" :value="null" :list="null"
                                                   :label="'ชื่อ' . __('products.page_title')"
                                                   :optionals="[
                                'ajax' => true,
                                'select_class' => 'js-select2 js-select2-custom',
                            ]"/>
                        </div>
                        <div class="col-6">
                            <x-forms.input-new-line id="category_field" :value="null"
                                                    :label="__('categories.page_title')"
                                                    :optionals="['required' => true]"/>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-6">
                            <x-forms.input-new-line id="price_field" :value="null" :label="__('orders.price')"
                                                    :optionals="['required' => true]"/>
                        </div>

                        <div class="col-6">
                            <label class="text-start col-form-label" for="amount_field">
                                จำนวน
                            </label>
                            <input type="number" class="form-control col-sm-4" id="amount_field"
                                   name="amount" placeholder="00">
                            <p></p>
                        </div>
                    </div>
                    <input type="hidden" id="id_field" name="id_field">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-clear-search"
                        data-bs-dismiss="modal">{{ __('lang.cancel') }}</button>
                <button type="button" class="btn btn-primary"
                        onclick="saveOrderDetail()">{{ __('lang.save') }}</button>
            </div>
        </div>
    </div>
</div>


