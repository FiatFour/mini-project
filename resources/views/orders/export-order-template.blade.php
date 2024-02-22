<table>
    @if($order_id != null)
        <thead>
        <tr>
            <th>รหัสร้านค้า</th>
            <th>ชื่อผู้สั่งซื้อ/ร้านค้า</th>
            <th>เบอร์ติดต่อ</th>
            <th>ที่อยู่ร้านค้าจัดส่ง</th>
            <th>วันที่ซื้อ</th>
            <th>วันที่จัดส่ง</th>
            <th>จำนวนสินค้า</th>
            <th>จำนวนสินค้าเงินรวมทั้งสิ้น</th>
            <th>จำนวนสินค้าเงินรวมทั้งสิ้น(ไม่รวม VAT)</th>
            <th>ราคา VAT 7%</th>
            <th>ส่วนลด</th>
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
                    {{ number_format($d->total - $d->discount, 2) }}
                </td>
                <td>
                    {{ number_format($d->total * (100 / 107), 2) }}
                </td>
                <td>
                    {{ number_format($d->total - ($d->total * (100 / 107)), 2) }}
                </td>
                <td>
                    {{ number_format($d->discount, 2) }}
                </td>
            </tr>
        </tbody>
    @else
        <thead>
        <tr>
            <th>#</th>
            <th>ชื่อผู้สั่งซื้อ/ร้านค้า</th>
            <th>วันที่ซื้อ</th>
            <th>วันที่จัดส่ง</th>
            <th>จำนวนสินค้า</th>
            <th>จำนวนสินค้าเงินรวมทั้งสิ้น</th>
            <th>จำนวนสินค้าเงินรวมทั้งสิ้น(ไม่รวม VAT)</th>
            <th>ราคา VAT 7%</th>
            <th>ส่วนลด</th>
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
    @endif
</table>
