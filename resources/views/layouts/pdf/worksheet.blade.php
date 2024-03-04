@extends('layouts.pdf.pdf-layout')
@push('custom_styles')
    <style>
        @page {
            margin: 140px 25px 10px 25px;
        }

        header {
            top: -100px;
            height: 10px;
            bottom: 0px;
        }

        table {
            width: 100% !important;
        }

        thead {
            display: table-header-group;
        }

        .text-left {
            text-align: left;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .table-collapse {
            border-collapse: collapse;
        }

        .table-collapse td,
            {
            border: 1px solid black;
            padding-left: 10px;
        }

        tbody {
            line-height: 16px;
            margin: 0;
            padding: 0;
        }

        .height-4 {
            height: 30px;
        }

        .height-max {
            height: 200px;
        }

        .font-xl {
            font-size: 20px;
            font-weight: bold;
        }

        footer {
            bottom: 20px;
        }

        .border-none {
            border: 0px !important;
        }

        .first-half {
            float: left;
            width: 70%;
        }

        .second-half {
            float: right;
            width: 30%;
        }

        .block-x {
            display:
        }

        .text-content {
            margin-left: 10%;
            color: #333333;
        }
    </style>
@endpush

<header>
    <div class="header-text-l">
        <div class="first-half">
            <img src="{{ base_path('storage/logo-pdf/true.jpg') }}" style="float: left;" alt="">
            <p style="font-size: 20px; padding:3px; margin-left:180px;">ใบสั่งซื้อสินค้า</p>
            <p style="font-size: 15px; margin-left:180px;">(Purchase Order)</p>
        </div>
        <div class="second-half">
            <p class="text-right" style="font-weight: bold; font-size: 20px;">{{ $data['worksheet_name'] ?? '' }}</p>
            <div class="display-left">
                <p class="text-right">{{ $data['worksheet_no'] ?? '' }}</p>
            </div>
        </div>
    </div>
</header>

@section('content')
    <div class="contet" style="">
        <table class="content table-collapse">
            <tbody class="content">
                <tr>
                    <td colspan="4">วันที่ / Date <span class="text-content">{{ $data['date'] ?? '' }}</span></td>
                    <td colspan="4">อ้างถึง / Ref. <span class="text-content">{{ $data['ref'] ?? '' }}</span></td>
                </tr>
                <tr>
                    <td class="font-xl" colspan="8">ลูกค้า / Customer</td>
                </tr>
                <tr>
                    <td colspan="8">ชื่อ / Name</td>
                </tr>
                <tr>
                    <td class="height-4 text-content" colspan="8">
                        <span class="text-content">{{ $data['customer_name'] ?? '' }}</span>
                    </td>
                </tr>
                <tr>
                    <td colspan="8">ที่อยู่ / Address</td>
                </tr>
                <tr>
                    <td class="height-4" colspan="8">
                        <span class="text-content">{{ $data['customer_address'] ?? '' }}</span>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">โทรศัพท์ / Telephone</td>
                    <td colspan="2">โทรสาร / Fax</td>
                    <td colspan="4">ชื่อผู้ประสานงาน / Contact Name</td>
                </tr>
                <tr>
                    <td class="height-4" colspan="2">
                        <span class="text-content">{{ $data['customer_tel'] ?? '' }}</span>
                    </td>
                    <td class="height-4" colspan="2">
                        <span class="text-content">{{ $data['customer_fax'] ?? '' }}</span>
                    </td>
                    <td class="height-4" colspan="4">
                        <span class="text-content">{{ $data['contact_name'] ?? '' }}</span>
                    </td>
                </tr>
                <tr>
                    <td class="font-xl" colspan="4">สัญญา / Contract</td>
                    <td class="font-xl" colspan="4">ประกันภัย / Insurance</td>
                </tr>
                <tr>
                    <td colspan="2">เลขที่ / No.</td>
                    <td colspan="2">ระยะเวลาเช่า / Period of Time</td>
                    <td colspan="4">บริษัทประกัน / Insurance Company</td>
                </tr>
                <tr>
                    <td class="height-4" colspan="2">
                        <span class="text-content">{{ $data['contract_no'] ?? '' }}</span>
                    </td>
                    <td class="height-4" colspan="2">
                        <span class="text-content">{{ $data['period_of_time'] ?? '' }}</span>
                    </td>
                    <td class="height-4" colspan="4">
                        <span class="text-content">{{ $data['insurance_company'] ?? '' }}</span>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">เริ่มต้น / สิ้นสุด / Starting Date / End Date</td>
                    <td colspan="2">เลขที่กรมธรรม์ / Policy No.</td>
                    <td colspan="2">เริ่มต้น / สิ้นสุด / Starting Date / End Date</td>
                </tr>
                <tr>
                    <td class="height-4" colspan="4">
                        <span class="text-content">{{ $data['contract_start'] ?? '' }}</span>
                        <span class="text-content"></span>
                        <span class="text-content">{{ $data['contract_end'] ?? '' }}</span>
                    </td>
                    <td class="height-4" colspan="2">
                        <span class="text-content">{{ $data['policy_no'] ?? '' }}</span>
                    </td>
                    <td class="height-4" colspan="2">
                        <span class="text-content">{{ $data['insurance_start'] ?? '' }}</span>
                        <span class="text-content"></span>
                        <span class="text-content">{{ $data['insurance_end'] ?? '' }}</span>
                    </td>
                </tr>
                <tr>
                    <td class="font-xl" colspan="8">รถยนต์ / Vehicle</td>
                </tr>
                <tr>
                    <td colspan="3">ยี่ห้อ / รุ่น / Brand / Model</td>
                    <td colspan="1">ปีผลิต / Year MFG.</td>
                    <td colspan="2">สี / Colors</td>
                    <td colspan="2">สถานะ / Status</td>
                </tr>
                <tr>
                    <td class="height-4" colspan="3">
                        <span class="text-content">{{ $data['car_class'] ?? '' }}</span>
                    </td>
                    <td class="height-4" colspan="1">
                        <span class="text-content">{{ $data['year_mfg'] ?? '' }}</span>
                    </td>
                    <td class="height-4" colspan="2">
                        <span class="text-content">{{ $data['car_color'] ?? '' }}</span>
                    </td>
                    <td class="height-4" colspan="2">
                        <span class="text-content">{{ $data['car_status'] ?? '' }}</span>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">เลขตัวถัง / Chassis No.</td>
                    <td colspan="1">เลขเครื่อง / Engine No.</td>
                    <td colspan="1">ทะเบียน / Plante No.</td>
                    <td colspan="2">เลขไมล์ / Mileage</td>
                    <td colspan="2">ความจุถังน้ำมัน / Fuel Tank</td>
                </tr>
                <tr>
                    <td class="height-4" colspan="2">
                        <span class="text-content">{{ $data['chassis_no'] ?? '' }}</span>
                    </td>
                    <td class="height-4" colspan="1">
                        <span class="text-content">{{ $data['engine_no'] ?? '' }}</span>
                    </td>
                    <td class="height-4" colspan="1">
                        <span class="text-content">{{ $data['license_plate'] ?? '' }}</span>
                    </td>
                    <td class="height-4" colspan="2">
                        <span class="text-content">{{ $data['mile_no'] ?? '' }}</span>
                    </td>
                    <td class="height-4" colspan="2">
                        <span class="text-content">{{ $data['fuel_tank'] ?? '' }}</span>
                    </td>
                </tr>
                <tr>
                    <td class="font-xl" colspan="8">กำหนดส่งมอบ / Delivery</td>
                </tr>
                <tr>
                    <td colspan="6">สถานที่ / Place</td>
                    <td colspan="2">วันที่ / เวลา / Date / Time</td>
                </tr>
                <tr>
                    <td class="height-4" colspan="6">
                        <span class="text-content">{{ $data['delivery_place'] ?? '' }}</span>
                    </td>
                    <td class="height-4" colspan="2">
                        <span class="text-content">{{ $data['delivery_date'] ?? '' }}</span>
                    </td>
                </tr>
                <tr>
                    <td colspan="8">ชื่อผู้ใช้รถ / User Name</td>
                </tr>
                <tr>
                    <td class="height-4" colspan="8">
                        <span class="text-content">{{ $data['user_name'] ?? '' }}</span>
                    </td>
                </tr>
                <tr>
                    <td class="height-max" colspan="8"></td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="8">
                        <table>
                            <tbody>
                                <tr class="text-center">
                                    <td class="border-none height-4">_______________________________</td>
                                    <td class="border-none height-4">_______________________________</td>
                                    <td class="border-none height-4">_______________________________</td>
                                </tr>
                                <tr class="text-center">
                                    <td class="border-none">ผู้ส่งมอบ</td>
                                    <td class="border-none">ผู้รับมอบ</td>
                                    <td class="border-none">ผู้อนุมัติ</td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tfoot>
        </table>

    </div>
@endsection
