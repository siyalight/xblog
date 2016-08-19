<div class="widget widget-default">
    <div class="widget-header">分类</div>
    <ul class="list-group">
        @foreach($categories as $category)
            <a href="{{ route('category.show',$category->name) }}"
               class="list-group-item{{ str_contains(request()->getPathInfo(),'category/'.$category->name) ?' active':'' }}">
                {{ $category->name }}
                <span class="badge">{{ $category->posts()->count() }}</span>
            </a>
        @endforeach
    </ul>
</div>