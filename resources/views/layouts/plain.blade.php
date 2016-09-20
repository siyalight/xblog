<!DOCTYPE html>
<html lang="Zh_cn" xmlns:v-on="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="{{ $author or '' }}">
    <title>@yield('title') {{ $site_title or '' }} </title>
    <meta name="keywords" content="{{ $site_keywords or '' }}">
    <meta name="description" content="@yield('description') {{ $site_description or '' }}">
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $site_title or '' }}">
    <meta property="og:site_name" content="{{ $site_title or '' }}">
    <meta property="og:description" content="{{ $site_description or '' }}">
    <meta name="theme-color" content="#607D8B">
    @include('widget.google_analytics')
    <style>
        html, body {
            height: 100%;
            background: #F5F8FA;
        }

        body {
            margin: 0;
            padding: 0;
            width: 100%;
            color: #607D8B;
            display: table;
            font-weight: 300;
            font-family: 'Lato', sans-serif;
        }

        .container {
            text-align: center;
            display: table-cell;
            vertical-align: middle;
        }

        a {
            text-decoration: none;
        }

        .content {
            text-align: center;
            display: inline-block;
        }

        .title {
            font-size: 36px;
            padding: 0 10px;
            margin-top: -100px;
        }

        .urls {
            margin-top: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="content">
        @yield('content')
    </div>
</div>
</body>
</html>
