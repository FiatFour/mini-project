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

{{--            <div class="block block-rounded">--}}
{{--                <div class="block-content">--}}
{{--                    <!-- All Category Table -->--}}
{{--                    @if (!isset($view))--}}
{{--                        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">--}}
{{--                            <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">ข้อมูลสินค้า</h1>--}}
{{--                            <a href="#" type="button" class="btn btn-alt-primary my-2" data-bs-toggle="modal"--}}
{{--                               data-bs-target="#modal-block-popout">--}}
{{--                                <i class="fa fa-fw fa-plus me-1"></i> เพึ่มข้อมูล--}}
{{--                            </a>--}}
{{--                            @include('orders.modal')--}}
{{--                        </div>--}}
{{--                    @endif--}}

{{--                    <div class="table-responsive">--}}
{{--                        <table class="table table-striped table-borderless table-vcenter">--}}
{{--                            <thead>--}}
{{--                            <tr class="bg-body-dark">--}}
{{--                                <th class="d-none d-sm-table-cell text-center" style="width: 40px;">#</th>--}}
{{--                                <th>ชื่อ{{ __('products.page_title') }}</th>--}}
{{--                                <th>{{ __('categories.page_title') }}</th>--}}
{{--                                <th>ราคาขาย</th>--}}
{{--                                <th>จำนวน</th>--}}
{{--                                <th>ราคา (ไม่รวม VAT)</th>--}}
{{--                                <th>ราคาสุทธิ (รวม VAT)</th>--}}
{{--                                <th class="text-center">เครื่องมือ</th>--}}
{{--                            </tr>--}}
{{--                            </thead>--}}
{{--                            <tbody id="orderDetailsTableBody">--}}
{{--                            @if (isset($edit) || isset($view))--}}
{{--                                @if (sizeof($orderDetailsWithRelations) > 0 )--}}
{{--                                    @foreach ($orderDetailsWithRelations as $index => $orderDetailsWithRelation)--}}
{{--                                        <tr>--}}
{{--                                            <td class="d-none d-sm-table-cell text-center">--}}
{{--                                                {{ $index + 1 }}</td>--}}
{{--                                            <td class="fw-semibold">--}}
{{--                                                <a href="javascript:void(0)">{{ $orderDetailsWithRelation->productName }}</a>--}}
{{--                                            </td>--}}
{{--                                            <td class="d-none d-sm-table-cell">--}}
{{--                                                {{ $orderDetailsWithRelation->categoryName }}--}}
{{--                                            </td>--}}
{{--                                            <td class="d-none d-sm-table-cell">--}}
{{--                                                {{ number_format($orderDetailsWithRelation->price, 2) }}--}}
{{--                                            </td>--}}
{{--                                            <td class="d-none d-sm-table-cell">--}}
{{--                                                {{ $orderDetailsWithRelation->amount }}--}}
{{--                                            </td>--}}
{{--                                            <td class="d-none d-sm-table-cell">--}}
{{--                                                {{ number_format($orderDetailsWithRelation->sub_total, 2) }}--}}
{{--                                            </td>--}}
{{--                                            <td class="d-none d-sm-table-cell">--}}
{{--                                                {{ number_format($orderDetailsWithRelation->total, 2) }}--}}
{{--                                            </td>--}}
{{--                                            <td class="text-center">--}}
{{--                                                <div class="block-options">--}}
{{--                                                    <div class="dropdown">--}}
{{--                                                        <button type="button" class="btn-block-option"--}}
{{--                                                                data-bs-toggle="dropdown" aria-haspopup="true"--}}
{{--                                                                aria-expanded="false">--}}
{{--                                                            <i class="fa fa-ellipsis-v"></i>--}}
{{--                                                        </button>--}}
{{--                                                        <div class="dropdown-menu dropdown-menu-end">--}}
{{--                                                            <a href="{{ route('orders.show', ['order' => $order]) }}"--}}
{{--                                                               class="dropdown-item">--}}
{{--                                                                <i class="fa fa-fw fa-eye me-1"></i> ดูข้อมูล--}}
{{--                                                            </a>--}}
{{--                                                            <a onclick="editOrderDetail({{$index}})"--}}
{{--                                                               class="dropdown-item">--}}
{{--                                                                <i class="fa fa-fw fa-edit me-1"></i> แก้ไข--}}
{{--                                                            </a>--}}
{{--                                                            <a class="dropdown-item" href="#"--}}
{{--                                                               onclick="deleteRecord({{ $order->id }})">--}}
{{--                                                                <i class="fa fa-fw fa-trash-alt me-1"></i> ลบ--}}
{{--                                                            </a>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}

{{--                                            </td>--}}
{{--                                        </tr>--}}
{{--                                    @endforeach--}}
{{--                                @endif--}}
{{--                            @endif--}}
{{--                            </tbody>--}}
{{--                        </table>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

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
                            <input disabled type="text" class="form-control col-sm-4" value="{{$order->total - $order->discount}}">
                        </div>
                        <div class="col-3">
                            <label class="text-start col-form-label">
                                ส่วนลด
                            </label>
                            <input type="text" class="form-control col-sm-4" id="discount" name="discount" value="{{$order->discount != 0 ? $order->discount : null}}">
                        </div>

                    </div>

                    <label class="text-start col-form-label">
                        หักภาษี
                    </label>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="withholding_tax"
                               name="withholding_tax" {{$order->withholding_tax != false ? 'checked' : ''}}>
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
