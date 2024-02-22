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
    </tr>
    </thead>
    <tbody>
    @foreach ($orders as $index => $order)
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
                {{ number_format($order->total - $order->discount, 2) }}
            </td>
            <td>
                {{ number_format($order->total * (100 / 107), 2) }}
            </td>
            <td>
                {{ number_format($order->total - ($order->total * (100 / 107)), 2) }}
            </td>
            <td>
                {{ number_format($order->discount, 2) }}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
