@extends('layouts.app')
@section('css')
    <link href="https://cdn.bootcss.com/select2/4.0.3/css/select2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/editor/0.1.0/editor.css">
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
    <script src="//cdn.jsdelivr.net/editor/0.1.0/editor.js"></script>
    <script src="https://cdn.bootcss.com/marked/0.3.6/marked.min.js"></script>
    <script>
        $("#post-tags").select2({
            tags: true
        })
        var editor = new Editor();
        editor.render();
    </script>
@endsection