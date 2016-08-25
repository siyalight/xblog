@extends('layouts.app')
@section('title','文章')
@section('content')
    <div class="row">
        <div class="col-md-4">
            @include('widget.user')
            @include('widget.categories')
        </div>
        <div class="col-md-8">
            <passport-clients></passport-clients>
            <passport-authorized-clients></passport-authorized-clients>
            <passport-personal-access-tokens></passport-personal-access-tokens>
            @if(empty($posts))
                <div class="widget widget-default">
                    <h1>Nothing here</h1>
                </div>
            @else
                @each('post.item',$posts,'post');
                {{ $posts->links() }}
            @endif
        </div>
    </div>
@endsection
@section('script')
    <script src="js/app.js"></script>
@endsection