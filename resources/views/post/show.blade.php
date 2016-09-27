@extends('layouts.app')
@section('description',$post->description)
@section('title',$post->title)
@section('content')
    <div class="row" style="background-color: white">
        <div class="col-md-9 col-sm-12">
            <div class="post-detail">
                @can('update',$post)
                    <div class="btn-group pull-right" style="margin-top: -25px">
                        <a class="btn" href="{{ route('post.edit',$post->id) }}"><i class="fa fa-pencil"></i></a>
                        <a class="btn" role="button"
                           data-method="delete"
                           data-url="{{ route('post.destroy',$post->id) }}"
                           data-modal-target="{{ $post->title }}">
                            <i class="fa fa-trash-o"></i>
                        </a>
                    </div>
                @endcan
                <div class="center-block">
                    <div class="post-detail-title">{{ $post->title }}</div>
                    <div class="post-meta">
                           <span class="post-time">
                           <i class="fa fa-calendar-o"></i>
                           <time datetime="2016-08-05T00:10:14+08:00" content="2016-08-05">
                           {{ $post->published_at==null?'Un Published':$post->published_at->format('Y-m-d H:i') }}
                           </time>
                           </span>
                        <span class="post-category">
                           &nbsp;|&nbsp;
                           <i class="fa fa-folder-o"></i>
                           <a href="{{ route('category.show',$post->category->name) }}">
                           {{ $post->category->name }}
                           </a>
                           </span>
                        <span class="post-comments-count">
                           &nbsp;|&nbsp;
                           <i class="fa fa-comment-o" aria-hidden="true"></i>
                           <span>{{ $post->comments_count }}</span>
                           </span>
                        <span>
                           &nbsp;|&nbsp;
                           <i class="fa fa-eye"></i>
                           <span>{{ $post->view_count }}</span>
                           </span>
                    </div>
                </div>
                <br>
                <div class="post-detail-content">
                    {!! $post->html_content !!}
                </div>
                <div class="tag-list">
                    <i class="fa fa-tags"></i>
                    @foreach($post->tags as $tag)
                        <a class="tag" href="{{ route('tag.show',$tag->name) }}">{{ $tag->name }}</a>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-3 hidden-sm">
            <div id="post-navigation"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-9 col-sm-12 mt-30">
            @include('widget.comment',['commentable'=>$post,
        'redirect'=>request()->fullUrl(),
        'commentable_type'=>'App\Post'])
        </div>
    </div>
@endsection