<header>
    <div class="header-text-l" style="position: fixed; width:550px;">
{{--        <img src="{{ base_path('storage/logo-pdf/true.jpg') }}" style="float: left;" alt="">--}}
        <p style="font-size: 20px; padding:3px;">บริษัท ทรู ลีสซิ่ง จํากัด </p>
        <p style="font-size: 15px;">18 อาคารทรูทาวเวอร์ ถนนรัชดาภิเษก แขวงห้วยขวาง กรุงเทพฯ 10310</p>
        <p class="" style="margin-top:65px;">{{ ($rental_refer) ? 'วัตถุประสงค์ขอซื้อให้ลูกค้า อ้างอิงใบจอง ' . $rental_refer : null }}</p>
    </div>
    <div class="header-text-r">
        <p style="font-size: 25px; margin-top:50px;">{{$title_header}}</p>
        <p class="right-p" style="margin-top:-20px;">เลขที่ <span class="right-span">{{ $worksheet_no }}</span></p>
        <p class="right-p">วันที่ขอซื้อ
            <span class="right-span">{{ get_thai_date_format($request_date, 'd/m/Y') }}</span>
        </p>
        <p class="right-p">วันที่ต้องการรถ
            <span class="right-span">{{ $require_date ? get_thai_date_format($require_date, 'd/m/Y') : '-' }}</span>
        </p>
    </div>
</header>
