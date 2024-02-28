@extends('layouts.app')

@section('content')
    <section class="content">
        <form id="save-form">

            <x-blocks.block :title="__('orders.shop')" >
                @include('orders.sections.info')
            </x-blocks.block>

            <x-blocks.block :title="__('orders.sub_title')" >
                @if (isset($view))
                    @include('orders.sections.views.order-detail')
                @else
                    @include('orders.sections.order-detail')
                @endif
            </x-blocks.block>

            @if (isset($edit) || isset($view))
                <div class="p-3 bg-body-extra-light rounded push">
                    <div class="row mb-4">
                        <div class="col-3">
                            <label class="text-start col-form-label">
                                ราคา (ไม่รวม VAT)
                            </label>
                            <input disabled type="text" class="form-control col-sm-4" value="{{ number_format($order->sub_total, 2) }}">
                        </div>
                        <div class="col-3">
                            <label class="text-start col-form-label">
                                VAT 7%
                            </label>
                            <input disabled type="text" class="form-control col-sm-4"
                                   value="{{ number_format($order->vat, 2) }}">
                        </div>
                        <div class="col-3">
                            <label class="text-start col-form-label">
                                จำนวนเงินรวมทั้งสิ้น
                            </label>
                            <input disabled type="text" class="form-control col-sm-4" value="{{number_format($order->total - ($order->withholding_tax + $order->discount), 2)}}">
                        </div>
                        <div class="col-3">
                            <label class="text-start col-form-label">
                                ส่วนลด
                            </label>
                            <input type="text" class="form-control col-sm-4" id="discount" name="discount" value="{{ $order->discount != 0 ? $order->discount : null }}" placeholder="0.00">
                        </div>
                    </div>

                    <label class="text-start col-form-label">
                        หักภาษี
                    </label>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="withholding_tax"
                               name="withholding_tax" {{$order->withholding_tax != 0 ? 'checked' : ''}}>
                        <label class="form-check-label" for="taxCheckbox">หักภาษี ณ ที่จ่าย 3 %</label>
                    </div>
                </div>
            @endif

            <div class="row">
                <input type="hidden" name="order_id" id="order_id" value="{{ $order->id }}">
                <x-forms.submit-group :optionals="['url' => 'orders.index', 'view' => empty($view) ? null : $view]" />
            </div>

        </form>
    </section>
@endsection

@include('orders.scripts.export-order-detail-script')
@include('components.select2-default')
@include('components.sweetalert')
@include('components.form-save', [
    'store_uri' => route('orders.store'),
])

@include('orders.scripts.order-detail-script')

{{--@include('components.select2-ajax', [--}}
{{--    'id' => 'product_id',--}}
{{--    'url' => route('util.select2.products'),--}}
{{--])--}}

@include('components.select2-ajax', [
    'id' => 'product_field',
    'modal' => '#modal-order-detail',
    'url' => route('util.select2.products'),
])

{{--@include('components.select2-ajax', [--}}
{{--    'id' => 'category_field',--}}
{{--    'parent_id' => 'product_field',--}}
{{--    'modal' => '#modal-order-detail',--}}
{{--    'url' => route('util.select2.categories'),--}}
{{--])--}}

{{--@include('components.select2-ajax', [--}}
{{--    'id' => 'price_field',--}}
{{--    'parent_id' => 'product_field',--}}
{{--    'modal' => '#modal-order-detail',--}}
{{--    'url' => route('util.select2.prices'),--}}
{{--])--}}

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

    </script>
@endpush
