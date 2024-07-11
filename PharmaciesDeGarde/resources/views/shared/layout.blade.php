<html lang="en" style="height: auto;"><head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') | Pharmacy</title>
    
    @section('imports')
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">
    
    <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">

    <link rel="stylesheet" href="/dist/css/adminlte.min.css?v=3.2.0">
    
    <script src="/plugins/jquery/jquery.min.js"></script>
    <script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/dist/js/adminlte.min.js"></script>
    @show
    
    
</head>    <body class="layout-top-nav" style="height: auto;">
@include('shared.navbar')
@yield('content')
    </body></html>