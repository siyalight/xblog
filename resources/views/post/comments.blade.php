@forelse($comments as $comment)
    <div class="" style="margin: 10px 0 25px 0">
        <div class="pull-left">
            <a href="{{ route('user.show',$comment->user->name) }}">
                <img width="48px" height="48px" class="img-circle"
                     src="https://static.lufficc.com/image/e0b3974866e759a93e5d41a669dc2b61.png">
            </a>
        </div>
        <div class="comment-info" style="margin-left: 66px">
            <div>
                <a href="{{ route('user.show',$comment->user->name) }}">{{ $comment->user->name }}</a>
                <span>{{ $comment->created_at->format('y/m/d H:m') }}</span>
                <span class="pull-right">
                    @if(auth()->id() == $comment->user_id)
                        <a data-method="delete"
                           data-modal-target="确定删除评论吗?"
                           href="javascript:void (0);"
                           data-url="{{ route('comment.destroy',$comment->id) }}">
                            <i class="fa fa-trash-o fa-fw"></i>
                        </a>
                    @endif
                    <a href="javascript:void (0);" onclick="replySomeone('{{ $comment->user->name }}')">
                        <i class="fa fa-reply fa-fw"></i>
                    </a>
                </span>
            </div>
            <div class="markdown-content">
                <p>{!! $comment->html_content !!}</p>
            </div>
        </div>
        <div class="alone-divider"></div>
    </div>
@empty
    <p class="meta-item center-block">暂无评论~~</p>
@endforelse