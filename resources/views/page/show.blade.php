@extends('layouts.app')
@section('title',$page->display_name)
@section('keywords',$page->display_name)
@section('description',$page->display_name)
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 col-sm-12 phone-no-padding">
                <ol class="breadcrumb">
                    <li><a href="{{ route('post.index') }}">博客</a></li>
                    <li class="active">{{ ucfirst($page->display_name) }}</li>
                </ol>
                <div class="post-detail">
                    @can('update',$page)
                        <div class="btn-group pull-right" style="margin-top: -25px">
                            <a class="btn" href="{{ route('page.edit',$page->id) }}"><i class="fa fa-pencil"></i></a>
                        </div>
                    @endcan
                    <div class="center-block">
                        <div class="post-detail-title">{{ $page->display_name }}</div>
                    </div>
                    <div class="post-detail-content">
                        {!! $page->html_content !!}
                    </div>
                </div>

                @if($page->isShownComment())
                    <div class="mt-30">
                        @include('widget.comment',[
                        'comment_key'=>'page.'.$page->name,
                        'comment_title'=>$page->display_name,
                        'comment_url'=>route('page.show',$page->name),
                        'commentable'=>$page,
                        'redirect'=>request()->fullUrl(),
                        'commentable_type'=>'App\Page'])
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection