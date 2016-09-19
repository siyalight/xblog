@extends('layouts.app')
@section('title','博客')
@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2 col-sm-12">
            <div class="widget widget-default">
                <div class="widget-header">
                    <h4>编辑评论</h4>
                </div>
                <div class="widget-body">
                    <form method="post"
                          action="{{ route('comment.update',[$comment->id,'redirect'=>request('redirect')]) }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="put">
                        <div class="form-group">
                            <label for="comment-content">评论内容<span class="required">*</span></label>
                            <textarea placeholder="支持Markdown" style="resize: vertical" id="comment-content"
                                      required
                                      name="content"
                                      rows="5" spellcheck="false"
                                      class="form-control  autosize-target">{{ $comment->content }}</textarea>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary"
                                   value="修改"/>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
