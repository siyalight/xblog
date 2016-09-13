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
            font-size: 60px;
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
        <div class="title">{{ $description or 'lufficc' }}</div>
        <div class="urls">
            <a href="{{ route('post.index') }}">博客</a>
            <span>/</span>
            <a href="{{ route('page.about') }}">关于</a>
        </div>
    </div>
</div>
</body>
</html>
