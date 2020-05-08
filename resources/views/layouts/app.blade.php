<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

<title>{{ config('app.name', 'Laravel') }} @yield("title")</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Theme style -->
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        @include('layouts.includes.navbar')
        <!-- Main Sidebar Container -->
        @include('layouts.includes.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @include('layouts.includes.page-header')

            <!-- Main content -->
            <div class="content">
                @yield("content")
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        @include('layouts.includes.right-sidebar')
        <!-- /.control-sidebar -->
        @include('layouts.includes.footer')
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</body>

</html>
