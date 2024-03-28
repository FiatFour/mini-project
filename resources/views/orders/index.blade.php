@extends('layouts.app')

@section('content')
    <div class="content">
        <!-- Search -->
        <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">{{ __('manage.manage') . __('orders.page_title') }}</h1>
        <div class="p-3 bg-body-extra-light rounded push">
            <form action="" method="GET">
                <div class="row mb-4">
                    <div class="col-3">
                        <x-forms.input id="keyword" :value="$keyword" :label="__('lang.search_label')"
                                       :optionals="['placeholder' => __('lang.input_search')]"/>
                    </div>

                    <div class="col-3">
                        <x-forms.select-option id="id" :value="$id" :list="$d"
                                               :label="__('orders.name')"/>
                    </div>

                    <div class="col-3">
                        <x-forms.input id="order_date" :value="$order_date" :label="__('orders.order_date')"
                                       :optionals="['input_class' => 'js-flatpickr', 'placeholder' => __('lang.date')]"/>
                    </div>

                    <div class="col-3">
                        <x-forms.input id="shipping_date" :value="$shipping_date" :label="__('orders.shipping_date')"
                                       :optionals="['input_class' => 'js-flatpickr', 'placeholder' => __('lang.date')]"/>
                    </div>
                </div>
                @include('components.btns.search')
            </form>
        </div>

        <div class="block block-rounded">
            <div class="block-content">
                <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                    <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3"></h1>
                    <a href="#" type="button" class="btn btn-alt-success my-2" onclick="exportOrders()"
                       style="margin-right: 5px">
                        <i class="fa fa-fw fa-plus me-1"></i> {{__('manage.download_excel')}}
                    </a>
                    <a href="{{ route('orders.create') }}" type="button" class="btn btn-alt-primary my-2">
                        <i class="fa fa-fw fa-plus me-1"></i> {{__('manage.btn_add')}}
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped table-borderless table-vcenter">
                        <thead>
                        <tr class="bg-body-dark">
                            <th class="d-none d-sm-table-cell text-center" style="width: 40px;">#</th>
                            <th>{{__('orders.name')}}</th>
                            <th>{{__('orders.order_date')}}</th>
                            <th>{{__('orders.shipping_date')}}</th>
                            <th>{{__('orders.count_order_detail')}}</th>
                            <th>{{__('orders.total')}}</th>
                            <th>{{__('orders.sub_total')}}</th>
                            <th>{{__('orders.vat')}}</th>
                            <th>{{__('orders.discount')}}</th>
                            <th class="text-center">{{ __('manage.tools') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if ($orders->isNotEmpty())
                            @foreach ($orders as $index => $order)
                                <tr>
                                    <td class="d-none d-sm-table-cell text-center">
                                        {{ $orders->firstItem() + $loop->index }}</td>
                                    <td class="fw-semibold">
                                        <a href="javascript:void(0)">{{ $order->name }}</a>
                                    </td>
                                    <td class="d-none d-sm-table-cell">
                                        {{ $order->order_date }}
                                    </td>
                                    <td class="d-none d-sm-table-cell">
                                        {{ $order->shipping_date }}
                                    </td>
                                    <td class="d-none d-sm-table-cell">
                                        {{ get_count_order_detail($order->id) }}
                                    </td>
                                    <td class="d-none d-sm-table-cell">
                                        {{ number_format($order->total - ($order->withholding_tax + $order->discount), 2) }}
                                    </td>
                                    <td class="d-none d-sm-table-cell">
                                        {{ number_format($order->sub_total, 2) }}
                                    </td>
                                    <td class="d-none d-sm-table-cell">
                                        {{ number_format($order->vat, 2) }}
                                    </td>
                                    <td class="d-none d-sm-table-cell">
                                        {{ number_format($order->discount, 2) }}
                                    </td>
                                    <td class="sticky-col text-center">
                                        @include('components.dropdown-action', [
                                            'view_route' => route('orders.show', ['order' => $order]),
                                            'edit_route' => route('orders.edit', ['order' => $order]),
                                            'delete_route' => route('orders.destroy', [
                                                'order' => $order,
                                            ]),
                                        ])
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr class="table-empty">
                                <td class="text-center" colspan="8">“
                                    {{ __('manage.no_list') }} “
                                </td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
                <div class="d-flex flex-row d-flex justify-content-end">
                    {{ $orders->links() }}
                </div>

            </div>
        </div>
    </div>

@endsection
@include('components.select2-default')
@include('orders.scripts.export-order-detail-script')
@include('components.sweetalert')

@push('scripts')
    <script>
    </script>
@endpush
