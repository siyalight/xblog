<article class="post">
    <!-- post header -->
    <div class="post-header">
        <h1 class="post-title">
            <a href="{{ route('post.show',$post->slug) }}">{{ $post->title }}</a>
        </h1>
        <div class="post-meta">
                           <span class="post-time">
                           <i class="fa fa-calendar-o"></i>
                           <time datetime="2016-08-05T00:10:14+08:00" content="2016-08-05">
                           {{ $post->created_at->format('Y-m-d') }}
                           </time>
                           </span>
            <span class="post-category">
                           &nbsp;|&nbsp;
                           <i class="fa fa-folder-o"></i>
                           <span>
                           <a href="{{ route('category.show',$post->category->name) }}">
                           <span>{{ $post->category->name }}</span>
                           </a>
                           </span>
                           </span>
            {{--<span class="post-comments-count">
                           &nbsp;|&nbsp;
                           <i class="fa fa-comment-o" aria-hidden="true"></i>
                           <span>7条评论</span>
                           </span>
            <span>
                           &nbsp;|&nbsp;
                           <span class="post-meta-item-icon">
                           <i class="fa fa-eye"></i>
                           </span>
                           <span class="post-meta-item-text">热度</span>
                           <span class="leancloud-visitors-count">872</span>
                           </span>--}}
        </div>
    </div>
    <!-- post content -->
    <div class="post-content">
        <p>
            {{ $post->description }}
        </p>
    </div>
    <!-- read more -->
    <div class="post-permalink">
        <a href="{{ route('post.show',$post->slug) }}" class="btn btn-more">阅读全文</a>
    </div>
    <!-- post footer -->
    <div class="post-footer clearfix">
        <div class="pull-left tag-list">
            <i class="fa fa-tags"></i>
            @foreach($post->tags as $tag)
                <a href="#">{{ $tag->name }}</a>
            @endforeach
        </div>
    </div>
</article>