@extends('layouts.app')
@section('title',$post->title)
@section('css')
    <link href="https://cdn.bootcss.com/highlight.js/9.6.0/styles/atelier-dune-dark.min.css" rel="stylesheet">
@endsection
@section('content')
    <div class="row" style="background-color: inherit">
        @can('update',$post)
            <div class="btn-group pull-right">
                <a class="btn" href="{{ route('post.edit',$post->id) }}"><i class="fa fa-edit"></i></a>
                <a class="btn" role="button" data-toggle="modal" data-target="#delete-post-modal">
                    <i class="fa fa-trash-o"></i>
                </a>
            </div>
            @include('post.delete-modal',$post)
        @endcan
        <div class="post-detail">
            <div class="center-block">
                <h1>{{ $post->title }}</h1>
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
                           <span>
                           <a href="{{ route('category.show',$post->category->name) }}">
                           <span>{{ $post->category->name }}</span>
                           </a>
                           </span>
                           </span>
                    {{--<span class="post-comments-count">
                           &nbsp;|&nbsp;
                           <i class="fa fa-comment-o" aria-hidden="true"></i>
                           <span>7条评论</span>
                           </span>
                    <span>
                           &nbsp;|&nbsp;
                           <span class="post-meta-item-icon">
                           <i class="fa fa-eye"></i>
                           </span>
                           <span class="post-meta-item-text">热度</span>
                           <span class="leancloud-visitors-count">872</span>
                           </span>--}}
                </div>
            </div>
            <br>
            <div id="field" data-content="{{ $post->content }}"></div>
            <div id="content">
            </div>
            <div class="pull-left tag-list post-footer" style="font-size: 80%">
                <i class="fa fa-tags"></i>
                @foreach($post->tags as $tag)
                    <a href="#">{{ $tag->name }}</a>
                @endforeach
            </div>
        </div>

        <div style="margin-top: 20px" class="ds-thread widget widget-default"
             data-thread-key="{{ $post->created_at.$post->title.$post->id }}"
             data-title="{{ $post->title }}" data-url="{{ request()->url() }}">
        </div>
    </div>

@endsection

@section('script')
    <script src="https://cdn.bootcss.com/marked/0.3.6/marked.min.js"></script>
    <script src="https://cdn.bootcss.com/highlight.js/9.6.0/highlight.min.js"></script>
    <script>

        document.getElementById('content').innerHTML =
                marked($('#field').data("content"), {
                    renderer: new marked.Renderer(),
                    gfm: true,
                    tables: true,
                    breaks: false,
                    pedantic: false,
                    smartLists: true,
                    smartypants: false,
                    highlight: function (code) {
                        return hljs.highlightAuto(code).value;
                    }
                });
    </script>

    <script type="text/javascript">
        var duoshuoQuery = {short_name: "lcc-luffy-blog"};
        (function () {
            var ds = document.createElement('script');
            ds.type = 'text/javascript';
            ds.async = true;
            ds.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') + '//static.duoshuo.com/embed.js';
            ds.charset = 'UTF-8';
            (document.getElementsByTagName('head')[0]
            || document.getElementsByTagName('body')[0]).appendChild(ds);
        })();
    </script>
@endsection