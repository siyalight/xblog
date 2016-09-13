@extends('admin.layouts.app')
@section('css')
    <link href="//cdn.bootcss.com/select2/4.0.3/css/select2.min.css" rel="stylesheet">
    <link href="//cdn.bootcss.com/highlight.js/9.6.0/styles/atelier-dune-dark.min.css" rel="stylesheet">
    <link href="//cdn.bootcss.com/simplemde/1.11.2/simplemde.min.css" rel="stylesheet">
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div id="data" class="widget widget-default" data-id="{{ $post->id }}">
                <div class="widget-header">
                    <h3>编辑文章</h3>
                </div>
                <div class="widget-body" style="font-size: 1.1em;font-weight: normal;line-height: 1.5em">
                    <form role="form" class="form-horizontal" action="{{ route('post.update',$post->id) }}" method="post">

                        @include('post.form-content')
                        <input type="hidden" name="_method" value="put">
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    修改
                                </button>
                            </div>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="//cdn.bootcss.com/select2/4.0.3/js/select2.min.js"></script>
    <script src="//cdn.bootcss.com/highlight.js/9.6.0/highlight.min.js"></script>
    <script src="//cdn.bootcss.com/simplemde/1.11.2/simplemde.min.js"></script>
    <script>
        $("#post-tags").select2({
            tags: true
        })

        new SimpleMDE({
            autoDownloadFontAwesome:true,
            element: document.getElementById("post-content-textarea"),
            renderingConfig:{
                codeSyntaxHighlighting:true,
            },
            spellChecker:false,
            toolbar: ["bold", "italic", "heading", "|", "quote",'code','ordered-list','unordered-list','link','image','table','|','preview','side-by-side','fullscreen'],
        });
    </script>
@endsection