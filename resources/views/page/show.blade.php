@extends('layouts.app')
@section('title',$page->display_name)
@section('css')
    <link href="https://cdn.bootcss.com/highlight.js/9.6.0/styles/atelier-dune-dark.min.css" rel="stylesheet">
@endsection
@section('content')
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="/">Home</a></li>
            <li class="active">{{ ucfirst($page->name) }}</li>
        </ol>
        <div class="post-detail">
            @can('update',$page)
                <div class="btn-group pull-right" style="margin-top: -25px">
                    <a class="btn" href="{{ route('page.edit',$page->id) }}"><i class="fa fa-pencil"></i></a>
                </div>
            @endcan
            <div class="center-block">
                <h1>{{ $page->display_name }}</h1>
            </div>
            <div id="content" class="post-content">
            </div>
            <div id="field" data-content="{{ $page->content }}"></div>
        </div>
        @include('widget.duoshuo',[
        'duoshuo_data_key'=>'page-'.$page->name,
        'duoshuo_data_title'=>$page->title,
        'duoshuo_data_url'=>request()->url(),])
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
        $('table').addClass('table table-hover table-bordered table-responsive');
    </script>
@endsection