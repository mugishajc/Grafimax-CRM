<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>{{(Utility::getValByName('header_text')) ? Utility::getValByName('header_text') : config('app.name', 'Workgo')}} - @yield('page-title')</title>

    <!-- Favicon -->
    <link rel="icon" href="{{asset(Storage::url('logo/favicon.png'))}}" type="image" sizes="16x16">

    <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/fontawesome/css/all.min.css') }}">

    <link href="{{ asset('assets/modules/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/modules/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet" type="text/css"/>

    <link href="{{ asset('assets/modules/jquery-selectric/selectric.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/modules/bootstrap-toastr/toastr.min.css') }}" rel="stylesheet" type="text/css"/>

    @stack('css-page')
    <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
</head>
