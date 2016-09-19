<div class="widget widget-default">
    <div class="widget-header">
        <h4 id="comments_count">评论{{--({{ $commentable->comments_count }})--}}</h4>
    </div>
    <div class="widget-body">
        <div id="comments-container" data-api-url="{{ route('comment.show',[$commentable->id,'commentable_type'=>$commentable_type]) }}">
        </div>
        <form class="form-group" id="comment-form" method="post" action="{{ route('comment.store') }}">
            {{ csrf_field() }}
            <input type="hidden" name="commentable_id" value="{{ $commentable->id }}">
            <input type="hidden" name="commentable_type" value="{{ $commentable_type }}">
            @if(!auth()->check())
                <label for="username">姓名<span class="required">*</span></label>
                <input class="form-control" id="username" type="text" name="username" placeholder="您的大名">
                <label for="email">邮箱<span class="required">*</span></label>
                <input class="form-control" id="email" type="email" name="email" placeholder="邮箱不会公开">
            @endif
            <label for="comment-content">评论内容<span class="required">*</span></label>
            <textarea placeholder="支持Markdown" style="resize: vertical" id="comment-content" name="content"
                      rows="5" spellcheck="false" class="form-control  autosize-target"></textarea>
            <input style="margin-top: 10px" type="submit" id="comment-submit" class="btn btn-primary"
                   value="回复"/>
        </form>
    </div>
</div>