@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-8">
            @each('post.item',$posts,'post')
            {{ $posts->links() }}
        </div>
        <div class="col-md-4">
            @include('widget.user')
        </div>
    </div>
@endsection