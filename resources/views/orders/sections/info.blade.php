<div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
    <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">ข้อมูล{{ __('orders.shop') }}</h1>
    <a href="{{ route('products.create') }}" type="button" class="btn btn-alt-danger my-2">
        <i class="fa fa-fw fa-plus me-1"></i> จัดพิมพ์ PDF
    </a>
</div>

<div class="row push">
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
    <div class="col-3">
        <x-forms.input id="order_address" :value="$order->address"
                       :label="'ที่อยู่' . __('orders.shop') . 'จัดส่ง'"
                       :optionals="['placeholder' => 'ที่อยู่' . __('orders.shop'). 'จัดส่ง']"/>
    </div>
</div>

