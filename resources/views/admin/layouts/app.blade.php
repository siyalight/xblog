<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#607D8B">
    <title>lufficc  @yield('title')</title>
    <link href="//cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="//cdn.bootcss.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="https://static.lufficc.com/favicon.ico"/>
    <link href="{{ elixir('css/app.css') }}" rel="stylesheet">
    @yield('css')
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
    @include('admin.layouts.header')
    <div id="content-wrap">
        <div class="container">
            @include('partials.errors')
            @include('partials.success')
            @yield('content')
        </div>
    </div>
    @include('layouts.footer')
    @if(isset($site_js) && $site_js)
        <script src="{{ $site_js }}"></script>
    @else
        <script src="{{ elixir('js/app.js') }}"></script>
    @endif
    @yield('script')
</body>
</html>
