<table>
    <thead>
    <tr>
        <th>#</th>
        <th>ชื่อผู้สั่งซื้อ/ร้านค้า</th>
        <th>วันที่ซื้อ</th>
        <th>วันที่จัดส่ง</th>
        <th>จำนวนรายละเอียดสินค้าทั้งหมด</th>
        <th>จำนวนสินค้าเงินรวมทั้งสิ้น</th>
        <th>จำนวนสินค้าเงินรวมทั้งสิ้น(ไม่รวม VAT)</th>
        <th>ราคา VAT 7%</th>
        <th>ส่วนลด</th>
        <th>ราคาหักภาษี ณ ที่จ่าย 3 %</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($orders as $index => $order)
        <tr>
            <td>
                {{ $index + 1 }}
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
</table>
