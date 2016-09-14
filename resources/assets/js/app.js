/**
 * @author lufficc
 */

(function ($) {
    var LufficcBlog = {
        init: function () {
            var self = this;
            $(document).pjax('a:not(a[target="_blank"])', '#lufficc-blog-container', {
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
            self.bootUp();
        },
        bootUp: function () {
            NProgress.configure({showSpinner: false});
            initMarkdownTarget();
            hightLightCode();
            initTables();
            initInlineAttachment();
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
        console.log('hightLightCode');
        $('pre code').each(function(i, block) {
            hljs.highlightBlock(block);
        });
    }
    function initTables() {
        $('table').addClass('table table-bordered table-responsive');
    }
    function initInlineAttachment() {

    }

    window.LufficcBlog = LufficcBlog;
})(jQuery);
$(document).ready(function () {
    LufficcBlog.init();
});
