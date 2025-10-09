<!DOCTYPE html>
<html lang="ml">

<head>
    <meta charset="UTF-8">
    <title>Cancer Remedy Assistance Bureau (CRAB)</title>
    <link rel="icon" href="{{ asset('/assets/images/favicon.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('/assets/images/favicon.png') }}" type="image/x-icon">
    <style>
        @font-face {
            font-family: 'NotoSansMalayalam';
            /* Choose a name for your font */
            src: url("{{ asset('/fonts/noto-sans/NotoSansMalayalam-Regular.ttf') }}") format('truetype');
        }

        /*.notoSans {
            font-family: notoSans !important;
            font-size: medium !important;
            line-height: 25px;
            color: #000 !important;
        }*/

        body {
            font-family: 'NotoSansMalayalam' sans-serif;
        }

        .body-bg {
            background: url('./assets/docs/crab-lh-bg.jpg');
            background-repeat: no-repeat;
            background-size: cover;
        }

        .font-big {
            font-size: 15px;
        }

        .text-center {
            text-align: center;
        }

        .text-right,
        .text-end {
            text-align: right;
        }

        .table,
        .no-border {
            border: none !important;
        }

        .mx-auto {
            margin: 0 auto !important;
        }

        .bordered td,
        .bordered th,
        .bordered {
            border: 1px solid #e6e6e6;
        }

        .border-0 {
            border: 0;
        }

        th,
        td {
            border: 1px solid #262525;
            padding: 5px;
            text-align: left;
        }

        .pd-1 {
            padding: 3px !important;
        }

        .mt-10 {
            margin-top: 10px;
        }

        .mt-30 {
            margin-top: 30px;
        }

        .mt-50 {
            margin-top: 50px;
        }

        .pt-50 {
            padding-top: 50px;
        }

        .mt-100 {
            margin-top: 100%;
        }

        .mb-50 {
            margin-bottom: 50px;
        }

        .h-50>tr>td {
            height: 50px;
        }

        .fw-bold {
            font-weight: bold;
        }

        .text-danger {
            color: red;
        }

        .text-dark {
            color: #000;
        }

        .txt {
            font-size: 10px !important;
        }

        .b-0 {
            border-bottom: none !important;
            border-top: none !important;
        }

        footer {
            position: fixed;
            bottom: -30px;
            left: 0px;
            right: 0px;
            height: 50px;
            text-align: center;
            line-height: 35px;
        }
    </style>
</head>

<body class="body-bg">
    <div class="container">
        <div class="row">
            <div class="col">
                <pre />
                <pre />
                <pre />
                <pre />
                <h2 class="text-center">ചറപറ! സുലോ വിന്തേന പിഷി വാട്ടിയം കിടിരാമൽ തൈവലം</h2>
                <P>{{ $message->message }}</P>
                <pre />
            </div>
        </div>
        <div class="footer text-end">Date: {{ date('d.M.Y h:i a') }}</div>
    </div>
</body>

</html>