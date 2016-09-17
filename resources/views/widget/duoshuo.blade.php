@if(isset($duoshuo_enable) && $duoshuo_enable == 'true')
    <div class="widget widget-default">
        <div id="ds-thread" class="widget-body"
             data-thread-key="{{ $duoshuo_data_key }}"
             data-title="{{ $duoshuo_data_title }}"
             data-url="{{ $duoshuo_data_url }}">
        </div>
    </div>
@endif