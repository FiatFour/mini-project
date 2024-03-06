<div class="table-wrap">
    <table class="table table-striped">
        <thead class="bg-body-dark">
        <th style="width: 2px;">#</th>
        <th style="width: 15%;">{{ __('products.name') }}</th>
        <th style="width: 15%;">{{ __('categories.page_title') }}</th>
        <th style="width: 10%;">{{ __('orders.price') }}</th>
        <th style="width: 10%;">{{ __('orders.amount') }}</th>
        <th style="width: 25%;">{{ __('orders.sub_total') }}</th>
        <th style="width: 25%;">{{ __('orders.total') }}</th>
        </thead>
        <tbody>
        @if (sizeof($order_detail_list) > 0)
            @foreach ($order_detail_list as $index => $order_detail)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $order_detail['product_name'] }}</td>
                    <td>{{ $order_detail['category_name'] }}</td>
                    <td>{{ $order_detail['price'] }}</td>
                    <td>{{ $order_detail['amount'] }}</td>
                    <td>{{ number_format($order_detail['sub_total'], 2) }}</td>
                    <td>{{ number_format($order_detail['total'], 2) }}</td>
                </tr>
        @endforeach
        @else
            <tr class="table-empty">
                <td class="text-center" colspan="8">“
                    {{ __('manage.no_list') . __('orders.sub_title') }} “
                </td>
            </tr>
        @endif
        </tbody>
    </table>
</div>
