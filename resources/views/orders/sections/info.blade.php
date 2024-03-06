<div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
    <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">{{ __('orders.info') }}</h1>
    <a href="#" type="button" class="btn btn-alt-success my-2" onclick="exportOrders()"
       style="margin-right: 5px">
        <i class="fa fa-fw fa-plus me-1"></i> {{__('manage.download_excel')}}
    </a>
    <a href="{{ route('orders.print-detail-pdf') }}" type="button" class="btn btn-alt-danger my-2">
        <i class="fa fa-fw fa-plus me-1"></i> {{__('manage.pdf')}}
    </a>
</div>

<div class="row push">
    <div class="col-3">
        <label class="text-start col-form-label" for="shop_code">
            {{__('orders.code')}}
        </label>
        <input disabled type="text" class="form-control col-sm-4" placeholder=""
               value="{{isset($order) ? $order->shop_code : ' '}}">
        <p></p>
    </div>
    <div class="col-3">
        <x-forms.input id="order_name" :value="$order->name"
                       :label="__('orders.name')"
                       :optionals="['placeholder' => __('orders.input_name')]"/>
    </div>
    <div class="col-3">
        <label class="text-start col-form-label" for="order_phone">
            {{__('orders.phone')}}
        </label>
        <input type="text" id="order_phone" class="form-control col-sm-4" placeholder="{{__('orders.input_phone')}}"
               name="order_phone" maxlength="10" value="{{$order->phone}}">
        <p></p>
    </div>
    <div class="col-3">
        <x-forms.input id="order_address" :value="$order->address"
                       :label="__('orders.address')"
                       :optionals="['placeholder' => __('orders.input_address')]"/>
    </div>
    <div class="row mb-4">
        <div class="col-3">
            <x-forms.input id="order_date" :value="$order->order_date" :label="__('orders.order_date')"
                           :optionals="['input_class' => 'js-flatpickr', 'placeholder' => __('lang.date')]"/>
        </div>

        <div class="col-3">
            <x-forms.input id="shipping_date" :value="$order->shipping_date" :label="__('orders.shipping_date')"
                           :optionals="['input_class' => 'js-flatpickr', 'placeholder' => __('lang.date')]"/>
        </div>
    </div>
</div>
