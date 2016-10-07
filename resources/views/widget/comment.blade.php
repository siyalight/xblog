@if(XblogConfig::getValue('comment_type','raw') == 'raw')
    @include('widget.raw_comment')
@elseif(XblogConfig::getValue('comment_type') == 'duoshuo')
    @include('widget.duoshuo_comment')
@elseif(XblogConfig::getValue('comment_type') == 'disqus')
    @include('widget.disqus_comment')
@endif