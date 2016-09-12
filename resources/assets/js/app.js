/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

/*require('./bootstrap');

/!**
 * Next, we will create a fresh Vue application instance and attach it to
 * the body of the page. From here, you may begin adding components to
 * the application, or feel free to tweak this setup for your needs.
 *!/

Vue.component('example', require('./components/Example.vue'));
Vue.component('categories', require('./components/Category.vue'));
Vue.component('posts', require('./components/Posts.vue'));
Vue.component('post', require('./components/Post.vue'));
Vue.component('passport-clients', require('./components/passport/Clients.vue'));
Vue.component('passport-authorized-clients', require('./components/passport/AuthorizedClients.vue'));
Vue.component('passport-personal-access-tokens', require('./components/passport/PersonalAccessTokens.vue'));

const app = new Vue({
    el: 'body',
});*/
require('./footer');
$(document).ready(function()
{
    $(document).pjax('a:not(a[target="_blank"])', '#lufficc-blog-container',{
        timeout: 2000,
        maxCacheLength:500,
    });
    $(document).on('pjax:complete', function() {
        initMarkdownTarget();
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


