@extends('admin.layouts.app')
@section('title','Admin')
@section('content')
    <div class="row">

        <div class="col-lg-3 col-md-4">
            <div class="widget widget-default center-block">
                <div class="widget-header">
                    <h3><i class="fa fa-user fa-fw"></i>User</h3>
                </div>
                <div class="widget-body">
                    <h3>
                        <a href="{{ route('admin.users') }}">{{ $info['user_count'] }}</a>
                    </h3>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-4">
            <div class="widget widget-default center-block">
                <div class="widget-header">
                    <h3><i class="fa fa-file fa-fw"></i>Page</h3>
                </div>
                <div class="widget-body">
                    <h3>
                        <a href="{{ route('admin.pages') }}">{{ $info['page_count'] }}</a>
                    </h3>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-4">
            <div class="widget widget-default center-block">
                <div class="widget-header">
                    <h3><i class="fa fa-sticky-note fa-fw"></i>Post</h3>
                </div>
                <div class="widget-body">
                    <h3>
                        <a href="{{ route('admin.posts') }}">{{ $info['post_count'] }}</a>
                    </h3>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-4">
            <div class="widget widget-default center-block">
                <div class="widget-header">
                    <h3><i class="fa fa-sticky-note fa-fw"></i>Comment</h3>
                </div>
                <div class="widget-body">
                    <h3>
                        <a href="{{ route('admin.comments') }}">{{ $info['comment_count'] }}</a>
                    </h3>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-4">
            <div class="widget widget-default center-block">
                <div class="widget-header">
                    <h3><i class="fa fa-tags fa-fw"></i>Tag</h3>
                </div>
                <div class="widget-body">
                    <h3>
                        <a href="{{route('admin.tags')}}">{{ $info['tag_count'] }}</a>
                    </h3>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-4">
            <div class="widget widget-default center-block">
                <div class="widget-header">
                    <h3><i class="fa fa-folder fa-fw"></i>Category</h3>
                </div>
                <div class="widget-body">
                    <h3>
                        <a href="{{ route('admin.categories') }}">{{ $info['category_count'] }}</a>
                    </h3>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-4">
            <div class="widget widget-default center-block">
                <div class="widget-header">
                    <h3><i class="fa fa-image fa-fw"></i>Images</h3>
                </div>
                <div class="widget-body">
                    <h3>
                        <a href="{{ route('admin.images') }}">{{ $info['image_count'] }}</a>
                    </h3>
                </div>
            </div>
        </div>

    </div>
@endsection