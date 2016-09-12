/**
 * @author lufficc
 */
require('./footer')
$(document).ready(function()
{
    $(document).pjax('a:not(a[target="_blank"])', '#lufficc-blog-container',{
        timeout: 2000,
        maxCacheLength:500,
    });
    $(document).on('pjax:complete', function() {
        initMarkdownTarget();
        initFooterPosition();
        $(window).resize(initFooterPosition);
    });
});

function initMarkdownTarget() {
    var markdownTarget = document.getElementById('markdown-target');
    if (markdownTarget)
    {
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