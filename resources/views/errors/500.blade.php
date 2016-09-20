@extends('layouts.plain')
@section('content')
    <div class="title">500</div>
    <div class="urls">
        <a href="{{ route('post.index') }}">博客</a>
        <span>/</span>
        <a href="{{ route('page.about') }}">关于</a>
    </div>
@endsection
