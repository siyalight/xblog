@forelse($comments as $comment)
    <div class="" style="margin: 5px 0 25px 0">
        <div class="pull-left">
            <a href="{{ route('user.show',$comment->user->name) }}">
                <img width="48px" height="48px" class="img-circle" src="https://static.lufficc.com/image/e0b3974866e759a93e5d41a669dc2b61.png">
            </a>
        </div>
        <div class="comment-info" style="margin-left: 66px">
            <div style="font-size: 1.2em">
                <a href="{{ route('user.show',$comment->user->name) }}">{{ $comment->user->name }}</a>
                <span class="pull-right" style="color: #d0d0d0">
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
            <div style="font-size: 0.9em;color: #d0d0d0">
                <span>{{ $comment->created_at->format('Y/m/d H:m') }}</span>
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