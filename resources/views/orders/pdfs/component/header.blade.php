<table class="table-border">
    <tbody>
        <tr>
            <td style="font-size:18px;font-weight:bold;">ฟอร์มส่งรถและตรวจรับรถที่ติดตั้งอุปกรณ์แล้ว</td>
        </tr>
        <tr >
            <td style="font-weight:bold;">Vehicle with Additional Accessories Set Up Check <Form></Form></td>
        </tr>
        <tr style="line-height: 20px;">
            <td style="width:50%;">
                <span>ผู้ขาย/Dealer : {{ $creditor_name }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span style="style=width:30%; ">ยี่ห้อ : {{ ($car->brand) ?  $car->brand->name : '-' }}</span>
            </td>
            <td>
                <span style=" style=width:30%; ">รุ่น : {{ $car->carClass ?  $car->carClass->name : '-' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span style=" style=width:30%; ">เลขเครื่อง : {{ $car->engine_no }}</span>
            </td>
            <td>
                <span style="style=width:30%; ">เลขตัวถัง : {{ $car->chassis_no }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span style="style=width:30%; ">CC : {{ $car->engine_size }}</span>
            </td>
            <td>
                <span style="style=width:30%; ">สี : {{ $car->carColor ?  $car->carColor->name : '-'}}</span>
            </td>
        </tr>
        <tr></tr>
        <tr></tr>
        <tr></tr>
    </tbody>
</table>