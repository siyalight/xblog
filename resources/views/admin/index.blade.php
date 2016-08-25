@extends('admin.layouts.app')
@section('title','Admin')
@section('content')
    <div class="row">

        <div class="col-lg-4 col-md-6">
            <div class="widget widget-default center-block">
                <div class="widget-header"><h1>User</h1></div>
                <div class="widget-body">
                    <h3><a href="{{ route('admin.users') }}">{{ $info['user_count'] }}</a></h3>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="widget widget-default center-block">
                <div class="widget-header"><h1>Page</h1></div>
                <div class="widget-body">
                    <h3>
                        <a href="{{ route('admin.pages') }}">{{ $info['page_count'] }}</a>
                    </h3>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="widget widget-default center-block">
                <div class="widget-header"><h1>Post</h1></div>
                <div class="widget-body">
                    <h3>
                        <a href="{{ route('admin.posts') }}">{{ $info['post_count'] }}</a>
                    </h3>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="widget widget-default center-block">
                <div class="widget-header"><h1>Tag</h1></div>
                <div class="widget-body">
                    <h3>
                        <a href="{{route('admin.tags')}}">{{ $info['tag_count'] }}</a>
                    </h3>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="widget widget-default center-block">
                <div class="widget-header"><h1>Category</h1></div>
                <div class="widget-body">
                    <h3>
                        <a href="{{ route('admin.categories') }}">{{ $info['category_count'] }}</a>
                    </h3>
                </div>
            </div>
        </div>

    </div>
@endsection