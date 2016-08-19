<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
    <label for="name" class="control-label">页面uri*</label>

    <input id="name" type="text" class="form-control" name="name"
           value="{{ isset($page) ? $page->name : old('name') }}"
           autofocus>

    @if ($errors->has('name'))
        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
    @endif
</div>


<div class="form-group{{ $errors->has('display_name') ? ' has-error' : '' }}">
    <label for="display_name" class="control-label">页面名称*</label>

    <input id="display_name" type="text" class="form-control" name="display_name"
           value="{{ isset($page) ? $page->display_name : old('display_name') }}">

    @if ($errors->has('display_name'))
        <span class="help-block">
                                        <strong>{{ $errors->first('display_name') }}</strong>
                                    </span>
    @endif
</div>


<div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
    <label for="content" class="control-label">页面内容*</label>

    <textarea spellcheck="false" id="content" type="text" class="form-control" name="content"
              rows="25"style="line-height: 1.85em; resize: vertical">{{ isset($page) ? $page->content : old('content') }}</textarea>
    @if ($errors->has('content'))
        <span class="help-block">
                                        <strong>{{ $errors->first('content') }}</strong>
                                    </span>
    @endif
</div>

{{ csrf_field() }}