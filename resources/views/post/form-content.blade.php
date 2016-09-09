<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
    <label for="title" class="control-label">文章标题*</label>
    <input id="title" type="text" class="form-control" name="title"
           value="{{ isset($post) ? $post->title : old('title') }}"
           autofocus>

    @if ($errors->has('title'))
        <span class="help-block">
            <strong>{{ $errors->first('title') }}</strong>
        </span>
    @endif
</div>
<div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
    <label for="description" class="control-label">文章描述*</label>

    <input id="description" type="text" class="form-control" name="description"
           value="{{ isset($post) ? $post->description : old('description') }}">

    @if ($errors->has('description'))
        <span class="help-block">
            <strong>{{ $errors->first('description') }}</strong>
        </span>
    @endif
</div>

<div class="form-group{{ $errors->has('slug') ? ' has-error' : '' }}">
    <label for="slug" class="control-label">文章slug*</label>
    <input id="slug" type="text" class="form-control" name="slug"
           value="{{ isset($post) ? $post->slug : old('slug') }}">

    @if ($errors->has('slug'))
        <span class="help-block">
            <strong>{{ $errors->first('slug') }}</strong>
        </span>
    @endif
</div>

<div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
    <label for="categories" class="control-label">文章分类*</label>
    <select name="category_id" class="form-control">
        @foreach($categories as $category)
            @if((isset($post) ? $post->category_id : old('category_id',-1)) == $category->id)
                <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
            @else
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endif
        @endforeach
    </select>

    @if ($errors->has('description'))
        <span class="help-block">
            <strong>{{ $errors->first('description') }}</strong>
        </span>
    @endif
</div>
<div class="form-group{{ $errors->has('tags[]') ? ' has-error' : '' }}">
    <label for="tags[]" class="control-label">文章标签</label>
    <select id="post-tags" name="tags[]" class="form-control" multiple>
        @foreach($tags as $tag)
            @if(isset($post) && $post->tags->contains($tag))
                <option value="{{ $tag->name }}" selected>{{ $tag->name }}</option>
            @else
                <option value="{{ $tag->name }}">{{ $tag->name }}</option>
            @endif
        @endforeach
    </select>

    @if ($errors->has('tags[]'))
        <span class="help-block">
            <strong>{{ $errors->first('tags[]') }}</strong>
        </span>
    @endif
</div>
<div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
    <label for="content" class="control-label">文章内容*</label>

    <textarea spellcheck="false" id="content" type="text" class="form-control" name="content"
              rows="25"
              style="line-height: 1.85em; font-size:1.5em;resize: vertical">{{ isset($post) ? $post->content : old('content') }}</textarea>
    @if($errors->has('content'))
        <span class="help-block">
            <strong>{{ $errors->first('content') }}</strong>
        </span>
    @endif
</div>

<div class="form-group">
    <label for="status" class="control-label">文章狀態</label>
    <select id="status" name="status" class="form-control">
        @if(isset($post))
            <option value="0" {{ $post->status == 0?' selected':'' }}>草稿</option>
            <option value="1" {{ $post->status == 1?' selected':'' }}>发布</option>
        @else
            <option value="0">草稿</option>
            <option value="1">发布</option>
        @endif
    </select>
</div>
{{ csrf_field() }}