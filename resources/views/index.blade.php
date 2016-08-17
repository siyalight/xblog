@extends('layouts.app')
@section('title','文章')
@section('content')
    <div class="row">
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
        <div class="col-md-4">
            @include('widget.user')
        </div>
    </div>
@endsection