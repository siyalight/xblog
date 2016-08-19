@extends('admin.layouts.app')
@section('css')
    <link href="https://cdn.bootcss.com/select2/4.0.3/css/select2.min.css" rel="stylesheet">
    <link href="https://cdn.bootcss.com/highlight.js/9.6.0/styles/atelier-dune-dark.min.css" rel="stylesheet">
    <link href="//cdn.bootcss.com/simplemde/1.11.2/simplemde.min.css" rel="stylesheet">
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="widget widget-default">
                <form role="form" class="form-horizontal" action="{{ route('post.store') }}" method="post">

                    @include('post.form-content')

                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                创建
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.bootcss.com/select2/4.0.3/js/select2.min.js"></script>
    <script src="https://cdn.bootcss.com/highlight.js/9.6.0/highlight.min.js"></script>
    <script src="//cdn.bootcss.com/simplemde/1.11.2/simplemde.min.js"></script>
    <script>
        $("#post-tags").select2({
            tags: true
        })

        new SimpleMDE({
            autoDownloadFontAwesome:true,
            autosave: {
                enabled: true,
                uniqueId: "post.create",
                delay: 1000,
            },
            renderingConfig:{
                codeSyntaxHighlighting:true,
            },
            spellChecker:false,
            toolbar: ["bold", "italic", "heading", "|", "quote",'code','ordered-list','unordered-list','link','image','table','|','preview','side-by-side','fullscreen'],
        });
    </script>
@endsection