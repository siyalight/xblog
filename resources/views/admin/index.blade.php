@extends('admin.layouts.app')
@section('title','Admin')
@section('content')
    <div class="row">
        <div class="col-lg-4 col-md-6">
            <div class="widget widget-default center-block">
                <h1>User</h1>
                <h3>{{ $info['user_count'] }}</h3>
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="widget widget-default center-block">
                <h1>Post</h1>
                <h3><a href="{{ route('admin.posts') }}">{{ $info['post_count'] }}</a></h3>
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="widget widget-default center-block">
                <h1>Tag</h1>
                <h3>{{ $info['tag_count'] }}</h3>
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="widget widget-default center-block">
                <h1>Category</h1>
                <h3>{{ $info['category_count'] }}</h3>
            </div>
        </div>


    </div>
@endsection