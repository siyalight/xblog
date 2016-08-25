@extends('layouts.app')
@section('title','文章')
@section('content')
    <div class="row">
        <div class="col-md-4">
            @include('widget.user')
            @include('widget.categories')
        </div>
        <div class="col-md-8">
            @if(empty($posts))
                @include('partials.empty')
            @else
                @each('post.item',$posts,'post');
                {{ $posts->links() }}
            @endif
        </div>
    </div>
@endsection
