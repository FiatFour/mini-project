<html>

<head>
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
            margin: 290px 25px;
        }

        body {
            margin: 0px;
            padding: 0px;
            font-family: "THSarabunNew";
        }

        header {
            position: fixed;
            top: -260px;
            left: 0px;
            right: 0px;
            height: 250px;

            /** Extra personal styles **/
            /* background-color: #bde3f5; */
            color: rgb(0, 0, 0);
            text-align: center;
            line-height: 35px;
        }

        .table-border {
            border-collapse: collapse;
        }

        .table-page {
            page-break-after: always;
        }

        .border-tr {
            border-top: 1px solid #010101 !important;
            border-bottom: 1px solid #010101 !important;
        }

        .border-tr-bottom {
            border-bottom: 1px solid #010101 !important;
        }

        .content {
            /* margin-top: 200px; */
            /* background-color: #386072; */
            padding: 0px;
            margin: 0px;
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

        .font-size-20 {
            font-size: 20px;
        }

        .font-size-16 {
            font-size: 16px;
        }

        .text-center {
            text-align: center;
        }

        footer {
            position: fixed;
            bottom: -100px;
            left: 0px;
            right: 0px;
            height: 50px;
            color: rgb(0, 0, 0);
            line-height: 20px;
        }

        .separated {
            border-bottom: 1px solid black;
            padding-top: 50px;
        }

    </style>
    @stack('custom_styles')
    <title>@yield('page_title', 'blank')</title>
</head>

<body>
    @yield('header')
    @yield('content')
</body>
<footer>
    @yield('footer')
</footer>
</html>
