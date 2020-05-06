<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        .loading {
            font-family: "Arial Black", "Arial Bold", Gadget, sans-serif;
            text-transform:uppercase;

            width:150px;
            text-align:center;
            line-height:50px;

            position:absolute;
            left:0;right:0;top:50%;
            margin:auto;
            transform:translateY(-50%);
        }
        .loading span {
            position: relative;
            z-index: 999;
            color: #fff;
        }

        .loading:before {
            content: '';
            background: #61bdb6;
            width: 128px;
            height: 36px;
            display: block;
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            margin: auto;

            animation: 2s loadingBefore infinite ease-in-out;
        }

        @keyframes loadingBefore {
            0% {
                transform: translateX(-14px);
            }

            50% {
                transform: translateX(14px);
            }

            100% {
                transform: translateX(-14px);
            }
        }


        .loading:after {
            content: '';
            background: #ff3600;
            width: 14px;
            height: 60px;
            display: block;
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            margin: auto;
            opacity: .5;

            animation: 2s loadingAfter infinite ease-in-out;
        }

        @keyframes loadingAfter {
            0% {
                transform: translateX(-50px);
            }

            50% {
                transform: translateX(50px);
            }

            100% {
                transform: translateX(-50px);
            }
        }
    </style>
</head>

<body class="hold-transition sidebar-mini">
    <div id="root">
        <div class="loading">
            <span>Loading</span>
        </div>
    </div>
</body>

</html>
