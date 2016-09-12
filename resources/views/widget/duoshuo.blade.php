@if(isset($duoshuo_enable) && $duoshuo_enable == 'true')
    <div class="widget widget-default">
        <div class="ds-thread widget-body"
             data-thread-key="{{ $duoshuo_data_key }}"
             data-title="{{ $duoshuo_data_title }}" data-url="{{ $duoshuo_data_url }}">
        </div>
        <script type="text/javascript">
            var duoshuoQuery = {short_name: "lcc-luffy-blog"};
            (function () {
                var ds = document.createElement('script');
                ds.type = 'text/javascript';
                ds.async = true;
                ds.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') + '//static.duoshuo.com/embed.js';
                ds.charset = 'UTF-8';
                (document.getElementsByTagName('head')[0]
                || document.getElementsByTagName('body')[0]).appendChild(ds);
            })();
        </script>
    </div>
@endif