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
                @include('partials.empty')
            @else
                @each('post.item',$posts,'post')
                @if($posts->lastPage() > 1)
                    {{ $posts->links() }}
                @endif
            @endif
        </div>
    </div>
@endsection