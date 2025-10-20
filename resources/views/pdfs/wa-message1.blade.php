<!DOCTYPE html>
<html lang="ml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Cancer Remedy Assistance Bureau (CRAB)</title>
    <link rel="icon" href="{{ asset('/assets/images/favicon.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('/assets/images/favicon.png') }}" type="image/x-icon">
    <style>
        body {
            font-family: 'notosansfont', sans-serif !important;
        }

        @page {
            background: url("{{ asset('/assets/docs/crab-lh-bg1.jpg') }}") no-repeat 0 0;
            background-image-resize: 6;
            footer: page-footer;
        }

        .font-big {
            font-size: 20px;
        }

        .text-center {
            text-align: center;
        }

        .text-right,
        .text-end {
            text-align: right;
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

        .txt-small {
            font-size: 12px !important;
        }
    </style>
</head>

<body class="body-bg">
    <div class="container">
        <div class="row">
            <div class="col">
                <br />
                <br />
                <br />
                <br />
                <br />
                <div class="text-end txt-small">{{ date('d.M.Y h:i a') }}</div>
                <div style="white-space:wrap">
                    <p class="font-big text-center">{!! $message->title ?? '' !!}</p>
                </div>
                <div style="white-space:wrap">
                    <p class="">{!! nl2br($message->message) !!}</p>
                </div>
            </div>
        </div>
    </div>
    <htmlpagefooter name="page-footer">
        <p class="txt-small text-center">This is a computer generated document, powered by <a href="https://softbugs.in" target="_blank">www.softbugs.in</a></p>
    </htmlpagefooter>
</body>

</html>