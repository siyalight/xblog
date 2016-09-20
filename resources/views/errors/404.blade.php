@extends('layouts.plain')
@section('content')
    <div class="title">404,{{ isset($errors)&&count($errors) ? $errors:'' }}</div>
    <div class="urls">
        <a href="{{ route('post.index') }}">博客</a>
        <span>/</span>
        <a href="{{ route('page.about') }}">关于</a>
    </div>
@endsection
