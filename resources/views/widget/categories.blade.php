<div class="widget widget-default">
    <div class="widget-header">分类</div>
    <ul class="list-group">
        @foreach($categories as $category)
            <a href="#" class="list-group-item">
                {{ $category->name }}
                <span class="badge">{{ $category->posts()->count() }}</span>
            </a>
        @endforeach
    </ul>
</div>