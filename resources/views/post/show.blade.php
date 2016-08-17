@extends('layouts.app')
@section('content')
    <div class="row">
        <main class="col-md-12 post-detail">
            @can('update',$post)
                <a href="{{ route('post.edit',$post->id) }}">编辑</a>
            @endcan
            <div class="center-block">
                <h1>{{ $post->title }}</h1>
                <div class="post-meta">
                           <span class="post-time">
                           <i class="fa fa-calendar-o"></i>
                           <time datetime="2016-08-05T00:10:14+08:00" content="2016-08-05">
                           {{ $post->created_at }}
                           </time>
                           </span>
                    <span class="post-category">
                           &nbsp;|&nbsp;
                           <i class="fa fa-folder-o"></i>
                           <span>
                           <a href="#">
                           <span>{{ $post->category->name }}</span>
                           </a>
                           </span>
                           </span>
                    <span class="post-comments-count">
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
                           </span>
                </div>
            </div>
            <br>
            <div id="field" data-content="{{ $post->content }}"></div>
            <div id="content">

            </div>
        </main>
    </div>
@endsection

@section('script')
    <script src="http://cdn.bootcss.com/marked/0.3.6/marked.min.js"></script>
    <script>
        document.getElementById('content').innerHTML =
                marked($('#field').data("content"), {
                    renderer: new marked.Renderer(),
                    gfm: true,
                    tables: true,
                    breaks: false,
                    pedantic: false,
                    smartLists: true,
                    smartypants: false
                });
    </script>
@endsection