@extends('layouts.app')
@section('title','文章')
@section('content')
    <ol class="breadcrumb">
        <li><a href="/">Home</a></li>
        <li class="active">{{ $name }}</li>
    </ol>
    <div class="row">
        <div class="col-md-4">
            @include('widget.user')
            @include('widget.categories')
        </div>
        <div class="col-md-8">
            @if($posts->isEmpty())
                <div class="widget widget-default">
                    <h1>Sorry...Nothing here</h1>
                </div>
            @else
                @each('post.item',$posts,'post')
                {{ $posts->links() }}
            @endif
        </div>
    </div>
@endsection