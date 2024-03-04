{{--@extends('layouts.pdf.pdf-layout')--}}

{{--@push('custom_styles')--}}
{{--    <style>--}}
{{--        header {--}}
{{--            position: static;--}}
{{--            top: 0px;--}}
{{--            height: 250px;--}}
{{--        }--}}

{{--        @page {--}}
{{--            margin: 20px 25px 0px 25px;--}}
{{--        }--}}

{{--        .table-collapse {--}}
{{--            border-collapse: collapse;--}}
{{--        }--}}

{{--        .table-collapse td,--}}
{{--        .table-collapse th {--}}
{{--            border: 1px solid black;--}}
{{--        }--}}

{{--        .table-collapse .grid_border {--}}
{{--            border-bottom-color: #FFFFFF;--}}
{{--        }--}}

{{--        .table-collapse .lastborder {--}}
{{--            border-bottom: black;--}}
{{--        }--}}

{{--        .header-text-l {--}}
{{--            position: fixed;--}}
{{--            float: left;--}}
{{--            line-height: 5px;--}}
{{--            width: 50%;--}}
{{--        }--}}

{{--        .header-text-r {--}}
{{--            text-align: center;--}}
{{--            float: right;--}}
{{--            margin-right: 20px;--}}
{{--            line-height: 5px;--}}
{{--            width: 50%;--}}
{{--        }--}}

{{--        .left-p {--}}
{{--            font-size: 18px;--}}
{{--            margin-bottom: 2px;--}}
{{--        }--}}

{{--        hr {--}}
{{--            border: 0.5px solid;--}}
{{--        }--}}

{{--        .ml-50 {--}}
{{--            margin-left: 50px;--}}
{{--            margin-top: 5px;--}}
{{--            margin-bottom: 8px;--}}
{{--        }--}}

{{--        .display-left {--}}
{{--            display: flex;--}}
{{--            text-align: left;--}}
{{--        }--}}

{{--        .mt-40 {--}}
{{--            margin-top: 40px;--}}
{{--        }--}}

{{--        .pd-r10 {--}}
{{--            padding-right: 10px;--}}
{{--        }--}}

{{--        .pd-l10 {--}}
{{--            padding-left: 10px;--}}
{{--        }--}}

{{--        th,--}}
{{--        td {--}}
{{--            text-align: center;--}}
{{--        }--}}

{{--        .right {--}}
{{--            position: absolute;--}}
{{--            right: 0px;--}}
{{--            width: 300px;--}}
{{--            background: #FFFFFF;--}}
{{--            border: 1px solid #C2C2C2;--}}
{{--            bottom: 50px;--}}
{{--        }--}}

{{--        .table-payment {--}}
{{--            /* border-collapse: none !important; */--}}
{{--            background: #FFFFFF;--}}
{{--            border: 1px solid black;--}}
{{--            margin-top: 35px;--}}
{{--        }--}}

{{--        .checkbox-style {--}}
{{--            margin: 0px 4px 0px 4px;--}}
{{--            /* padding-top: -400px; */--}}
{{--        }--}}

{{--        .separated {--}}
{{--            border-bottom: 1px solid black;--}}
{{--            padding-top: 30px;--}}
{{--            margin: 10px;--}}
{{--        }--}}

{{--        .font-line {--}}
{{--            font-weight: bold;--}}
{{--            line-height: 5px;--}}
{{--        }--}}

{{--        .font-mt {--}}
{{--            font-weight: bold;--}}
{{--            margin-top: -15px;--}}
{{--        }--}}

{{--        .line-mt {--}}
{{--            line-height: 10px;--}}
{{--            margin-top: -10px;--}}
{{--        }--}}
{{--        .p-line {--}}
{{--            line-height: 10px;--}}
{{--        }--}}

{{--    </style>--}}
{{--@endpush--}}

{{--@include('admin.install-equipments.pdfs.purchase-order.header',--}}
{{--[--}}
{{--    'customer_name' => $d->supplier ? $d->supplier->name : '',--}}
{{--    'customer_address' => $d->supplier ? $d->supplier->address : '',--}}
{{--    'customer_tel' => $d->supplier ? $d->supplier->tel : '',--}}
{{--    'created_at' => $d->created_at,--}}
{{--    'qt_no' => $d->worksheet_no,--}}
{{--])--}}

{{--@section('content')--}}
{{--    <div class="content">--}}
{{--        @include('admin.install-equipments.pdfs.purchase-order.main')--}}
{{--        @include('admin.install-equipments.pdfs.purchase-order.footer')--}}
{{--    </div>--}}
{{--@endsection--}}

    <!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        @font-face {
            font-family: 'THSarabunNew';
            font-style: normal;
            font-weight: normal;
            src: url("{{ public_path('fonts/THSarabunNew.ttf') }}") format('truetype');
        }

        @font-face {
            font-family: 'THSarabunNew';
            font-style: normal;
            font-weight: bold;
            src: url("{{ public_path('fonts/THSarabunNew Bold.ttf') }}") format('truetype');
        }

        @font-face {
            font-family: 'THSarabunNew';
            font-style: italic;
            font-weight: normal;
            src: url("{{ public_path('fonts/THSarabunNew Italic.ttf') }}") format('truetype');
        }

        @font-face {
            font-family: 'THSarabunNew';
            font-style: italic;
            font-weight: bold;
            src: url("{{ public_path('fonts/THSarabunNew BoldItalic.ttf') }}") format('truetype');
        }

        @page {
            margin: 20px 25px;
        }

        body {
            /* margin: 250px 25px 250px 25px; */
            margin: 0px;
            padding: 0px;
            font-family: "THSarabunNew";
        }

        header {
            position: fixed;
            top: 0px;
            left: 0px;
            right: 0px;
            height: 250px;

            /** Extra personal styles **/
            /* background-color: #bde3f5; */
            color: rgb(0, 0, 0);
            text-align: center;
            line-height: 18px;
        }

        nav{
            position: relative;
            /* border: solid blue 1px; */
        }

        .p1{
            text-align: right;
            position: absolute;
            right: 0;
            /* top: 200px; */
            top: -100px;
            /* border: solid red 1px; */
        }

        #p_header{
            margin-right: 20px;
        }

        .p2{
            text-align: left;
            position: absolute;
            left: 0;
            /* top: 300px; */
            top: 50px;
            /* border: solid red 1px; */
        }

        table, th, td{
            margin-top: 250px;
            border: 1px solid black;
            border-collapse: collapse;
        }
        th, td {
            padding: 5px;
            text-align: left;
        }
    </style>
</head>
<body>

<header>
    <div>
        <p style="font-size: 20px;">ใบสั่งซื้อสินค้า</p>
        <p style="font-size: 15px;">(Purchase Order)</p>

    </div>
</header>

{{--<nav>--}}
{{--    <div class="p1">--}}
{{--        <div id="p_header">รหัสสินค้า OD20240200001</div>--}}
{{--        <p>วันที่สั่งซื้อ 28/02/2024</p>--}}
{{--        <p>วันที่จัดส่ง 07/03/2024</p>--}}
{{--    </div>--}}

{{--    <div class="p2">--}}
{{--        <p>ชื่อผู้สั่งซื้อ : ชื่อลูกค้า</p>--}}
{{--        <p>เบอร์ติดต่อ : 0987654321</p>--}}
{{--        <p>ที่อยู่ลูกค้า : 4444 ถ.แห่งหนึ่ง แขวง จอมพล เขต จตุจักร กรุงเทพ 109000</p>--}}
{{--    </div>--}}
{{--</nav>--}}

{{--<section>--}}
{{--    <table style="width:100%" class="table-page">--}}

{{--        <caption style="text-align: left; margin-top: 200px; margin-bottom: 20px;" >รายการสินค้าสั่งซื้อ</caption>--}}
{{--        <thead>--}}
{{--        <tr>--}}
{{--            <th style="width:10%;">ลำดับ</th>--}}
{{--            <th style="width:20%;">รายการสินค้า</th>--}}
{{--            <th style="width:20%;">ประเภทสินค้า</th>--}}
{{--            <th style="width:10%;">จำนวน</th>--}}
{{--            <th style="width:20%;">ราคา (ไม่รวม VAT)</th>--}}
{{--            <th style="width:20%;">ราคารวม</th>--}}
{{--        </tr>--}}
{{--        </thead>--}}

{{--        <tbody>--}}
{{--        <tr>--}}
{{--            <td>1</td>--}}
{{--            <td>ชื่อสินค้า 1</td>--}}
{{--            <td>ประเภทสินค้า</td>--}}
{{--            <td>1</td>--}}
{{--            <td>500.00</td>--}}
{{--            <td>535.00</td>--}}
{{--        </tr>--}}
{{--        <tr>--}}
{{--            <td>2</td>--}}
{{--            <td>ชื่อสินค้า 2</td>--}}
{{--            <td>ประเภทสินค้า</td>--}}
{{--            <td>2</td>--}}
{{--            <td>1500.00</td>--}}
{{--            <td>1535.00</td>--}}
{{--        </tr>--}}
{{--        <tr>--}}
{{--            <td>3</td>--}}
{{--            <td>ชื่อสินค้า 3</td>--}}
{{--            <td>ประเภทสินค้า</td>--}}
{{--            <td>3</td>--}}
{{--            <td>2500.00</td>--}}
{{--            <td>2535.00</td>--}}
{{--        </tr>--}}
{{--        </tbody>--}}

{{--        <tfoot>--}}
{{--        <tr>--}}
{{--            <td colspan="3" rowspan="5" style="text-align: center;">สรุปราคารวม</td>--}}
{{--            <td colspan="2">ราคารวม (ไม่รวม VAT)</td>--}}
{{--            <td colspan="2">6500</td>--}}
{{--        </tr>--}}
{{--        <tr>--}}
{{--            <td colspan="2">ภาษีมูลค่าเพึ่ม 7%</td>--}}
{{--            <td colspan="2">455</td>--}}
{{--        </tr>--}}
{{--        <tr>--}}
{{--            <td colspan="2">ภาษี ณ ที่จ่าย</td>--}}
{{--            <td colspan="2">0.00</td>--}}
{{--        </tr>--}}
{{--        <tr>--}}
{{--            <td colspan="2">ส่วนลด</td>--}}
{{--            <td colspan="2">0.00</td>--}}
{{--        </tr>--}}
{{--        <tr>--}}
{{--            <td colspan="2">ราคาสุทธิ (รวม VAT)</td>--}}
{{--            <td colspan="2">6955</td>--}}
{{--        </tr>--}}
{{--        </tfoot>--}}
{{--    </table>--}}
{{--</section>--}}

</body>
<footer>

</footer>
</html>
