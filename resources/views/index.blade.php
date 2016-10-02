@extends('layouts.plain')
@section('content')
    <div class="home-color-bg"></div>
    <div class="home-box">
        <h2 title="{{ $site_title or 'title' }}" style="margin: 0;">
            {{ $site_title or 'title' }}
            <a aria-hidden="true" href="{{ route('post.index') }}">
                <img class="img-circle" src="{{ $avatar or '' }}" alt="{{ $author or 'author' }}">
            </a>
        </h2>
        <h3 title="{{ $site_description or 'description' }}" aria-hidden="true" style="margin: 0">
            {{ $description or 'description' }}
        </h3>
        <p class="links">
            <font aria-hidden="true">»</font>
            <a href="{{ route('post.index') }}" aria-label="点击查看博客文章列表">博客</a><font aria-hidden="true">/</font>
            <a href="{{ route('projects') }}" aria-label="点击查看项目列表">项目</a><font aria-hidden="true">/</font>
            <a href="{{ route('page.about') }}" aria-label="查看聪聪的个人信息">关于</a>
        </p>
        <p class="links">
            <font aria-hidden="true">»</font>
            <a href="{{ config('social.github') }}" target="_blank" aria-label="{{ $author or 'author' }} 的 Github 地址">
                <i class="fa fa-github fa-fw" title="Github"></i>
            </a>
            <a href="{{ config('social.facebook') }}" target="_blank"
               aria-label="{{ $author or 'author' }} 的 Github 地址">
                <i class="fa fa-facebook fa-fw" title="facebook"></i>
            </a>
            <a href="{{ config('social.twitter') }}" target="_blank" aria-label="{{ $author or 'author' }} 的 Github 地址">
                <i class="fa fa-twitter fa-fw" title="twitter"></i>
            </a>
            <a href="{{ config('social.weibo') }}" target="_blank" aria-label="{{ $author or 'author' }} 的 Github 地址">
                <i class="fa fa-weibo fa-fw" title="weibo"></i>
            </a>
        </p>
    </div>
@endsection