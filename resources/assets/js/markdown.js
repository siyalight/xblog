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