<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#607D8B">
    <title>lufficc  @yield('title')</title>
    <!-- Styles -->
    <link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.bootcss.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{ elixir('css/app.css') }}" rel="stylesheet">
    @yield('css')
    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>

    @include('admin.layouts.header')
    {{--@include('layouts.nav')--}}
    <section class="content-wrap" style="margin-top: 35px">
        <div class="container">
            @include('partials.errors')
            @include('partials.success')
            @yield('content')
        </div>
    </section>

    @include('layouts.footer')
    <!-- Scripts -->
    <script src="https://cdn.bootcss.com/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script>
        $(function(){
            function footerPosition(){
                $("#footer").removeClass("fixed-bottom");
                var contentHeight = document.body.scrollHeight,//网页正文全文高度
                        winHeight = window.innerHeight;//可视窗口高度，不包括浏览器顶部工具栏
                if(!(contentHeight > winHeight)){
                    //当网页正文高度小于可视窗口高度时，为footer添加类fixed-bottom
                    $("footer").addClass("fixed-bottom");
                } else {
                    $("footer").removeClass("fixed-bottom");
                }
            }
            footerPosition();
            $(window).resize(footerPosition);
        });
    </script>
    @yield('script')
</body>
</html>
