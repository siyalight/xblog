@extends('layouts.plain')
@section('content')
    <div class="title">403,
        @if (isset($errors)&&count($errors) > 0)
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        @endif
    </div>
    <div class="urls">
        <a href="{{ route('post.index') }}">博客</a>
        <span>/</span>
        <a href="{{ route('page.about') }}">关于</a>
    </div>
@endsection
