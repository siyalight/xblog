@extends('layouts.app')
@section('title','分类')
@section('content')
    <ol class="breadcrumb">
        <li><a href="{{ route('post.index') }}">博客</a></li>
        <li class="active">分类</li>
    </ol>
    <div class="row">
        <div class="col-md-12">
            @include('widget.categories')
        </div>
    </div>
@endsection
