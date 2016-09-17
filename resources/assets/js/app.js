/**
 * @author lufficc
 */
(function ($) {
    var LufficcBlog = {
        init: function () {
            var self = this;
            var pjaxContainer = $('#lufficc-pjax-container');
            if (pjaxContainer.length > 0) {
                $(document).pjax('a:not(a[target="_blank"])', pjaxContainer, {
                    timeout: 2000,
                    maxCacheLength: 500,
                });
                $(document).on('pjax:start', function () {
                    NProgress.start();
                });
                $(document).on('pjax:end', function () {
                    NProgress.done();
                    self.bootUp();
                });
                $(document).on('pjax:complete', function () {
                    NProgress.done();
                });
            }
            self.bootUp();
        },
        bootUp: function () {
            console.log('bootUp');
            NProgress.configure({showSpinner: false});
            initMarkdownTarget();
            hightLightCode();
            initTables();
            autoSize();
            initDuoshuo();
        },
    };

    function initMarkdownTarget() {
        $('.markdown-target').each(function (i, element) {
            element.innerHTML =
                marked($(element).data("markdown"), {
                    renderer: new marked.Renderer(),
                    gfm: true,
                    tables: true,
                    breaks: false,
                    pedantic: false,
                    smartLists: true,
                    smartypants: false,
                });
        });
    }

    function hightLightCode() {
        $('pre code').each(function (i, block) {
            hljs.highlightBlock(block);
        });
    }

    function initTables() {
        $('table').addClass('table table-bordered table-responsive');
    }

    function autoSize() {
        autosize($('.autosize-target'));
    }

    function initDuoshuo() {
        if (Laravel.duoshuo_enable) {
            var dr = $(".ds-thread");
            var dus = $("#ds-thread");
            console.log('dus:' + $(dus).length);
            console.log('dr:' + $(dr).length);
            if ($(dus).length <= 1 && $(dr).length == 0) {
                var el = document.createElement('div');//该div不需要设置class="ds-thread"
                el.setAttribute('data-thread-key', $(dus).data('thread-key'));//必选参数
                el.setAttribute('data-url', $(dus).data('url'));//必选参数
                el.setAttribute('data-title', $(dus).data('title'));//必选参数
                DUOSHUO.EmbedThread(el);
                $(dus).html(el);
            }
        }

    }

    window.LufficcBlog = LufficcBlog;
})(jQuery);
$(document).ready(function () {
    LufficcBlog.init();
});
