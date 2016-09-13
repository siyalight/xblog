<!DOCTYPE html>
<html lang="Zh_cn" xmlns:v-on="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="{{ $author or '' }}">
    <meta name="description" content="@yield('description') {{ $description or '' }}">
    <meta name="Keywords" content="聪聪,博客,海贼王,One Piece,爱科技,爱生活,Php,Android,Laravel,Spring,Java">
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $title or '' }}">
    <meta property="og:site_name" content="{{ $title or '' }}">
    <meta property="og:description" content="Stay Hungry.Stay Foolish.">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="lufficc">
    <meta name="twitter:description" content="Stay Hungry.Stay Foolish.">
    <meta name="theme-color" content="#607D8B">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') {{ $title or '' }} </title>
    <link href="//cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="//cdn.bootcss.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">
    <link href="//cdn.bootcss.com/highlight.js/9.6.0/styles/atelier-heath.light.min.css" rel="stylesheet">
    <meta http-equiv="x-pjax-version" content="{{ elixir('css/app.css') }}">
    <link href="{{ elixir('css/app.css') }}" rel="stylesheet">
    @yield('css')
    <script>
        window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
        ]); ?>
    </script>
    @include('widget.google_analytics')
</head>
<body id="lufficc-blog-container">
@include('layouts.header')
<div class="content-wrap" style="margin-top: 30px">
    <div class="container">
        @include('partials.errors')
        @include('partials.success')
        @yield('content')
    </div>
</div>
@include('layouts.footer')
<script src="//cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
<script src="//cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="//cdn.bootcss.com/jquery.pjax/1.9.6/jquery.pjax.min.js"></script>
<script src="//cdn.bootcss.com/marked/0.3.6/marked.min.js"></script>
<script src="//cdn.bootcss.com/highlight.js/9.6.0/highlight.min.js"></script>
<script src="//cdn.bootcss.com/nprogress/0.2.0/nprogress.js"></script>
<script src="{{ elixir('js/app.js') }}"></script>
@yield('script')
</body>
</html>
