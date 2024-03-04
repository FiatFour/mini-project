@extends('admin.layouts.pdf.pdf-layout')
{{-- @section('page_title', $page_title) --}}
@push('custom_styles')
    <style>
        @page {
            margin: 140px 25px 10px 25px;
        }

        header {
            top: -110px;
            height: 130px;
            bottom: 0px;
        }

        .table-border {
            border-collapse: collapse;
        }

        .table-page {
            page-break-after: always;
        }

        .border-all {
            border: 1px solid #010101 !important;
        }

        .border-tr {
            border-top: 1px solid #010101 !important;
            border-bottom: 1px solid #010101 !important;
        }

        .border-tr-bottom {
            border-bottom: 1px solid #010101 !important;
        }
        .border-right {
            border-right: 1px solid #010101 !important;
        }

        .content {
            top: 100px;
        }

        .header-text-l {
            /* top: 0; */
            text-align: left;
            line-height: 3px;
        }

        .header-text-r {
            text-align: right;
            margin-right: 20px;
            margin: 0px;
        }

        .right-p {
            font-size: 15px;
            text-align: right;
            margin: 2px;
            line-height: 12px;
        }

        .right-span {
            font-size: 13px;
            text-align: left;
            padding: 3px;
        }

        table {
            width: 100%;
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

        

        tr {
            line-height: 12px;
        }

        .separated {
            border-bottom: 1px solid black;
            padding-top: 50px;
        }

        footer {
            bottom: 20px;
        }

    </style>
@endpush

@include('admin.layouts.pdf.header2', [])

@section('content')
    <div class="content" style="">
        @include('admin.install-equipments.pdfs.component.header')
        @include('admin.install-equipments.pdfs.component.content')
    </div>
@endsection

@section('footer')
<table>
    <tr>
        <td>ฉบับที่:</td>
        <td>แก้ไขคร้ังที่:</td>
        <td>วันที่ประกาศใช้:</td>
        <td>บริษัท ทรู ลิซซิ่ง จำกัด</td>
    </tr>
</table>
@endsection
