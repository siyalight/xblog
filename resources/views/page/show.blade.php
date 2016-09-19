@extends('layouts.app')
@section('title',$page->display_name)
@section('description',$page->display_name)
@section('css')
    <link href="https://cdn.bootcss.com/highlight.js/9.6.0/styles/atelier-dune-dark.min.css" rel="stylesheet">
@endsection
@section('content')
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="{{ route('post.index') }}">博客</a></li>
            <li class="active">{{ ucfirst($page->name) }}</li>
        </ol>
        <div class="post-detail">
            @can('update',$page)
                <div class="btn-group pull-right" style="margin-top: -25px">
                    <a class="btn" href="{{ route('page.edit',$page->id) }}"><i class="fa fa-pencil"></i></a>
                </div>
            @endcan
            <div class="center-block">
                <h1>{{ $page->display_name }}</h1>
            </div>
            <div class="post-content">
                {!! $page->html_content !!}
            </div>
        </div>
        @include('widget.comment',['commentable'=>$page,'commentable_type'=>'App\Page'])
    </div>
@endsection