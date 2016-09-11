<div class="widget widget-default">
    <div class="widget-header"><h4><i class="fa fa-tags fa-fw"></i>标签</h4></div>
    <ul class="widget-body">
        <div class="tag-list">
            @foreach($tags as $tag)
                <a href="{{ route('tag.show',$tag->name) }}" class="tag">
                    {{ $tag->name }}
                    <span class="badge">{{ $tag->posts_count }}</span>
                </a>
            @endforeach
        </div>
    </ul>
</div>