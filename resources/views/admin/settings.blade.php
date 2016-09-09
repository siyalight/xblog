@extends('layouts.app')
@section('title','文章')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="widget widget-default">
                <div class="widget-header">
                    <h3>设置</h3>
                </div>
                <div class="widget-body">
                    <form role="form" class="form-horizontal" action="{{ route('post.store') }}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <div class="col-md-4 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    保存
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
