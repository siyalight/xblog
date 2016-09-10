@extends('layouts.app')
@section('title','文章')
@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="slide">
                @include('widget.user')
                @include('widget.categories')
            </div>
        </div>
        <div class="col-md-8">
            @if($posts->count() == 0)
                <div class="widget widget-default">
                    <div class="widget-header">
                        <h3>Search for "{{ request()->get('query') }}"</h3>
                    </div>
                    <div class="widget-body">
                        <h4>什么也没搜到...</h4>
                    </div>
                </div>
            @else
                <div class="widget widget-default">
                    <div class="widget-header">
                        <h3>Search for "{{ request()->get('query') }}"</h3>
                    </div>
                </div>
                @each('post.item',$posts,'post')
            @endif
        </div>
    </div>
@endsection
