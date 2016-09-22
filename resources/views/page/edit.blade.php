@extends('admin.layouts.app')
@section('css')
    <link href="//cdn.bootcss.com/highlight.js/9.6.0/styles/atelier-dune-dark.min.css" rel="stylesheet">
    <link href="//cdn.bootcss.com/simplemde/1.11.2/simplemde.min.css" rel="stylesheet">
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div id="data" class="widget widget-default" data-id="{{ $page->id }}">
                <div class="widget-header">
                    <h3>修改页面</h3>
                </div>
                <div class="widget-body edit-form">
                    <form role="form" class="form-horizontal" action="{{ route('page.update',$page->id) }}" method="post">

                        @include('page.form-content')
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
    <script src="//cdn.bootcss.com/highlight.js/9.6.0/highlight.min.js"></script>
    <script src="//cdn.bootcss.com/simplemde/1.11.2/simplemde.min.js"></script>
    <script>
        new SimpleMDE({
            autoDownloadFontAwesome:true,
            renderingConfig:{
                codeSyntaxHighlighting:true,
            },
            spellChecker:false,
            toolbar: ["bold", "italic", "heading", "|", "quote",'code','ordered-list','unordered-list','link','image','table','|','preview','side-by-side','fullscreen'],
        });
    </script>
@endsection