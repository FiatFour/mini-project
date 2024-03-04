@extends('admin.layouts.pdf.pdf-layout')

@push('custom_styles')
    <style>
        header {
            position: static;
            top: 0px;
            height: 250px;
        }

        @page {
            margin: 20px 25px 0px 25px;
        }

        .table-collapse {
            border-collapse: collapse;
        }

        .table-collapse td,
        .table-collapse th {
            border: 1px solid black;
        }

        .table-collapse .grid_border {
            border-bottom-color: #FFFFFF;
        }

        .table-collapse .lastborder {
            border-bottom: black;
        }

        .header-text-l {
            position: fixed;
            float: left;
            line-height: 5px;
            width: 50%;
        }

        .header-text-r {
            text-align: center;
            float: right;
            margin-right: 20px;
            line-height: 5px;
            width: 50%;
        }

        .left-p {
            font-size: 18px;
            margin-bottom: 2px;
        }

        hr {
            border: 0.5px solid;
        }

        .ml-50 {
            margin-left: 50px;
            margin-top: 5px;
            margin-bottom: 8px;
        }

        .display-left {
            display: flex;
            text-align: left;
        }

        .mt-40 {
            margin-top: 40px;
        }

        .pd-r10 {
            padding-right: 10px;
        }

        .pd-l10 {
            padding-left: 10px;
        }

        th,
        td {
            text-align: center;
        }

        .right {
            position: absolute;
            right: 0px;
            width: 300px;
            background: #FFFFFF;
            border: 1px solid #C2C2C2;
            bottom: 50px;
        }

        .table-payment {
            /* border-collapse: none !important; */
            background: #FFFFFF;
            border: 1px solid black;
            margin-top: 35px;
        }

        .checkbox-style {
            margin: 0px 4px 0px 4px;
            /* padding-top: -400px; */
        }

        .separated {
            border-bottom: 1px solid black;
            padding-top: 30px;
            margin: 10px;
        }

        .font-line {
            font-weight: bold;
            line-height: 5px;
        }

        .font-mt {
            font-weight: bold;
            margin-top: -15px;
        }

        .line-mt {
            line-height: 10px;
            margin-top: -10px;
        }
        .p-line {
            line-height: 10px;
        }

    </style>
@endpush

@include('admin.install-equipments.pdfs.purchase-order.header',
[
    'customer_name' => $d->supplier ? $d->supplier->name : '',
    'customer_address' => $d->supplier ? $d->supplier->address : '',
    'customer_tel' => $d->supplier ? $d->supplier->tel : '',
    'created_at' => $d->created_at,
    'qt_no' => $d->worksheet_no,
])

@section('content')
    <div class="content">
        @include('admin.install-equipments.pdfs.purchase-order.main')
        @include('admin.install-equipments.pdfs.purchase-order.footer')
    </div>
@endsection
