<table class="table-border"> 
    <thead>
        <tr>
            <td colspan="5" class="text-left">โปรดส่งมอบสินค้าตามรายการต่อไปนี้</td>
        </tr>
        <tr class="border-tr">
            <th style="width:2%;" class="text-center">ลำดับ</th>
            <th style="width:50%;" class="text-center">รายการ</th>
            <th style="text-align: right;">จำนวน</th>
            <th style="text-align: right;">ราคา/หน่วย</th>
            <th style="text-align: right;">จำนวนเงิน</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($install_equipment_po_lines as $index => $item)
            <tr style="line-height: 13px;vertical-align: top;" >
                <td style="width:2%;" class="text-center">{{ $index + 1 }}</td>
                <td style="width:50%;" class="text-left">{{ $item->accessory ? $item->accessory->name : '' }} </td>
                <td class="text-right">{{ number_format($item->amount) }}</td>
                <td class="text-right">{{ number_format($item->total, 2) }}</td>
                <td class="text-right">{{ number_format($item->total * $item->amount, 2) }}</td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr style="border-top:1px solid #000000">
            <td style="width:2%;"></td>
            <td style="width:50%;"></td>
            <td class="text-center"></td>
            <td class="text-right">รวมเป็นเงิน</td>
            <td class="text-right">{{ number_format($summary->total, 2) }}</td>
        </tr>
        <tr>
            <td style="width:2%;"></td>
            <td style="width:50%;"></td>
            <td class="text-center"></td>
            <td class="text-right">ส่วนลด</td>
            <td class="text-right">{{ number_format($summary->discount, 2) }}</td>
        </tr>
        <tr>
            <td style="width:2%;"></td>
            <td style="width:50%;"></td>
            <td class="text-center"></td>
            <td class="text-right">ภาษีมูลค่าเพ่ิม</td>
            <td class="text-right">{{ number_format($summary->vat, 2) }}</td>
        </tr>
        <tr class="border-tr">
            <td style="width:2%;"></td>
            <td class="text-center" style="width:50%;">{{ bahtText($summary->total_discount_include) }}</td>
            <td class="text-center"></td>
            <td class="text-right">รวมเป็นเงินทั้งสิ้น</td>
            <td class="text-right">{{ number_format($summary->total_discount_include, 2) }}</td>
        </tr>
        <tr>
            <td class="text-left" colspan="2">กําหนดส่งสินค้า &nbsp;&nbsp;
                {{ $d->time_of_delivery ?? '-' }}</td>
            <td class="text-left"></td>
            <td class="text-left"></td>
            <td class="text-left"></td>
        </tr>
        <tr>
            <td class="text-left" colspan="2">เงื่อนไขการชําระเงิน &nbsp;&nbsp;
                {{ $d->payment_term ?? '-' }}
            </td>
            <td class="text-left"></td>
            <td class="text-left"></td>
            <td class="text-left"></td>
        </tr>
        <tr>
            <td class="text-left" colspan="2">
                ติดต่อ &nbsp;&nbsp;
                {{ $d->contact ?? '-' }}
            </td>
            {{-- <td class="text-right">ผู้สั่งซื้อ&nbsp;&nbsp;</td> --}}
            {{-- <td colspan="2" style="border-bottom: 1px solid #444444"></td> --}}
        </tr>
        <tr>
            <td class="text-left" colspan="2">
                ผู้ใช้รถ &nbsp;&nbsp;
                {{ $d->car_user ?? '-' }}
            </td>
        </tr>
    </tfoot>
</table>
