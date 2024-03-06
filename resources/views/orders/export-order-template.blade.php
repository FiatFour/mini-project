<table>
    @if($order_id != null)
        <thead>
        <tr>
            <th>{{ __('categories.code') }}</th>
            <th>{{ __('categories.name') }}</th>
            <th>{{ __('categories.phone') }}</th>
            <th>{{ __('categories.phone') }}</th>
            <th>{{ __('categories.order_date') }}</th>
            <th>{{ __('categories.shipping_date') }}</th>
            <th>{{ __('categories.amount') }}</th>
            <th>{{ __('categories.total') }}</th>
            <th>{{ __('categories.sub_total') }}</th>
            <th>{{ __('categories.vat') }}</th>
            <th>{{ __('categories.discount') }}</th>
            <th>{{ __('categories.withholding_tax') }}</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>
                {{ $d->shop_code }}
            </td>
            <td>
                {{ $d->name }}
            </td>
            <td>
                {{ $d->phone }}
            </td>
            <td>
                {{ $d->address }}
            </td>
            <td>
                {{ $d->order_date }}
            </td>
            <td>
                {{ $d->shipping_date }}
            </td>
            <td>
                {{ get_count_order_detail($d->id) }}
            </td>
            <td>
                {{ number_format($d->total - ($d->withholding_tax + $d->discount), 2) }}
            </td>
            <td>
                {{ number_format($d->sub_total, 2) }}
            </td>
            <td>
                {{ number_format($d->vat, 2) }}
            </td>
            <td>
                {{ number_format($d->discount, 2) }}
            </td>
            <td>
                {{ number_format($d->withholding_tax, 2) }}
            </td>
        </tr>
        </tbody>
    @else
        <thead>
        <tr>
            <th>#</th>
            <th>{{ __('categories.name') }}</th>
            <th>{{ __('categories.order_date') }}</th>
            <th>{{ __('categories.shipping_date') }}</th>
            <th>{{ __('categories.amount') }}</th>
            <th>{{ __('categories.sub_total') }}</th>
            <th>{{ __('categories.total') }}</th>
            <th>{{ __('categories.vat') }}</th>
            <th>{{ __('categories.discount') }}</th>
            <th>{{ __('categories.withholding_tax') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($d as $index => $order)
            <tr>
                <td>
                    {{ $index + 1 }}</td>
                <td>
                    {{ $order->name }}
                </td>
                <td>
                    {{ $order->order_date }}
                </td>
                <td>
                    {{ $order->shipping_date }}
                </td>
                <td>
                    {{ get_count_order_detail($order->id) }}
                </td>
                <td>
                    {{ number_format($order->total - ($order->withholding_tax + $order->discount), 2) }}
                </td>
                <td>
                    {{ number_format($order->sub_total, 2) }}
                </td>
                <td>
                    {{ number_format($order->vat, 2) }}
                </td>
                <td>
                    {{ number_format($order->discount, 2) }}
                </td>
                <td>
                    {{ number_format($order->withholding_tax, 2) }}
                </td>
            </tr>
        @endforeach
        </tbody>
    @endif
</table>
