/**
 * @author lufficc
 */
/*require('./footer')
require('./markdown')*/
(function ($) {
    var LufficcBlog = {
        init: function () {
            var self = this;
            $(document).pjax('a:not(a[target="_blank"])', '#lufficc-blog-container', {
                timeout: 2000,
                maxCacheLength: 500,
            });
            $(document).on('pjax:complete', function () {
                self.bootUp();
            });
        },
        bootUp: function () {
            initMarkdownTarget();
            initFooterPosition();
            $(window).resize(initFooterPosition);
        },
    };
    function initFooterPosition(){
        $("#footer").removeClass("fixed-bottom");
        var contentHeight = document.body.scrollHeight,//网页正文全文高度
            winHeight = window.innerHeight;//可视窗口高度，不包括浏览器顶部工具栏
        if(!(contentHeight > winHeight)){
            //当网页正文高度小于可视窗口高度时，为footer添加类fixed-bottom
            $("footer").addClass("fixed-bottom");
        } else {
            $("footer").removeClass("fixed-bottom");
        }
    }
    function initMarkdownTarget() {
        var markdownTarget = document.getElementById('markdown-target');
        if (markdownTarget) {
            markdownTarget.innerHTML =
                marked($('#markdown-content').data("markdown"), {
                    renderer: new marked.Renderer(),
                    gfm: true,
                    tables: true,
                    breaks: false,
                    pedantic: false,
                    smartLists: true,
                    smartypants: false,
                    highlight: function (code) {
                        return hljs.highlightAuto(code).value;
                    }
                });
        }
    }
    window.LufficcBlog = LufficcBlog;
})(jQuery);
$(document).ready(function () {
    LufficcBlog.bootUp();
});
