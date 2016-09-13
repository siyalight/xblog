@extends('layouts.app')
@section('title','博客')
@section('content')
    <div class="row">
        <div class="col-md-8">
            @if(empty($posts))
                @include('partials.empty')
            @else
                @each('post.item',$posts,'post')
                @if($posts->lastPage() > 1)
                    {{ $posts->links() }}
                @endif
            @endif
        </div>
        <div class="col-md-4">
            <div class="slide">
                @include('layouts.widgets')
            </div>
        </div>
    </div>
@endsection
