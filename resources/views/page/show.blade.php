@extends('layouts.app')
@section('title',$page->display_name)
@section('css')
    <link href="https://cdn.bootcss.com/highlight.js/9.6.0/styles/atelier-dune-dark.min.css" rel="stylesheet">
@endsection
@section('content')
    <div class="row" style="background-color: inherit">
        <ol class="breadcrumb">
            <li><a href="/">Home</a></li>
            <li class="active">{{ $page->name }}</li>
        </ol>
        @can('update',$page)
            <div class="btn-group pull-right">
                <a class="btn" href="{{ route('page.edit',$page->id) }}"><i class="fa fa-edit"></i></a>
            </div>
        @endcan
        <div class="post-detail">
            <div class="center-block">
                <h1>{{ $page->display_name }}</h1>
            </div>
            <div id="content">
            </div>
            <div id="field" data-content="{{ $page->content }}"></div>
        </div>
        <div style="margin-top: 20px" class="ds-thread widget widget-default"
             data-thread-key="{{$page->name.$page->display_name }}"
             data-title="{{ $page->title }}" data-url="{{ request()->url() }}">
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