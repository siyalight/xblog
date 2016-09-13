@extends('layouts.app')
@section('title','标签')
@section('content')
    <ol class="breadcrumb">
        <li><a href="{{ route('post.index') }}">博客</a></li>
        <li class="active">标签</li>
    </ol>
    <div class="row">
        <div class="col-md-12">
            @include('widget.tags')
        </div>
    </div>
@endsection
