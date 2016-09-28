/**
 * @author lufficc
 */
(function ($) {
    var LufficcBlog = {
        init: function () {
            var self = this;
            /*var pjaxContainer = $('#lufficc-pjax-container');
             if (pjaxContainer.length > 0) {
             $(document).pjax('a:not(a[target="_blank"])', pjaxContainer, {
             timeout: 2000,
             maxCacheLength: 500,
             });
             $(document).on('pjax:start', function () {
             NProgress.start();
             });
             $(document).on('pjax:complete', function () {
             NProgress.done();
             self.bootUp();
             });
             }*/
            self.bootUp();
        },
        bootUp: function () {
            console.log('bootUp');
            /*initPostNavigation();*/
            /*NProgress.configure({showSpinner: false});*/
            loadComments(false);
            initComment();
            initMarkdownTarget();
            initTables();
            autoSize();
            initProjects();
            initDeleteTarget();
            highLightCode();
            initUploadAvatar();
        },
    };

    function initPostNavigation() {
        var postDetail = $('.post-detail');
        var hs = postDetail.find('h1,h2,h3,h4,h5,h6');
        if (hs.length < 2) {
            $('#post-detail-wrap').attr('class','col-md-12 col-sm-12');
            $('#comment-wrap').attr('class','col-md-12 col-sm-12');
            $('#post-navigation-wrap').remove();
            return;
        }
        var s = '';
        s += '<div style="clear:both"></div>';
        /*s += '<p class="post-navigation-title">文章目录</p>';*/
        s += '<ul class="nav" style="line-height:160%;">';
        var old_h = 0, ol_cnt = 0;
        for (var i = 0; i < hs.length; i++) {
            var h = parseInt(hs[i].tagName.substr(1), 10);
            if (!old_h)
                old_h = h;
            if (h > old_h) {
                s += '<ul>';
                ol_cnt++;
            }
            else if (h < old_h && ol_cnt > 0) {
                s += '</ul>';
                ol_cnt--;
            }
            if (h == 1) {
                while (ol_cnt > 0) {
                    s += '</ul>';
                    ol_cnt--;
                }
            }
            old_h = h;
            var tit = hs.eq(i).text().replace(/^\d+[.、\s]+/g, '');
            tit = tit.replace(/[^a-zA-Z0-9_\-\s\u4e00-\u9fa5]+/g, '');

            if (tit.length < 100) {
                s += '<li><a href="#title' + i + '">' + tit + '</a></li>';
                /*hs.eq(i).html('<a id="title' + i + '"></a>' + hs.eq(i).html());*/
                hs.eq(i).attr('id', 'title' + i);
            }
        }
        while (ol_cnt > 0) {
            s += '</ul>';
            ol_cnt--;
        }
        s += '</ul>';
        s += '<div style="clear:both"><br></div>';
        var navigation = $('#post-navigation');
        var navigationContent = navigation.find('#navigation-body');
        navigationContent.html(s);
        /*navigation.scrollspy("refresh");
         navigation.scrollspy();*/
        navigation.scrollToFixed({
            limit: $('#post-end').offsetHeight - $(this).outerHeight(true),
            zIndex: 999
        });
        $('body').scrollspy({ target: '#post-navigation' });
    }

    function initDeleteTarget() {
        $('[data-modal-target]').append(function () {
            return "\n" +
                "<form action='" + $(this).attr('data-url') + "' method='post' style='display:none'>\n" +
                "   <input type='hidden' name='_method' value='" + $(this).data('method') + "'>\n" +
                "   <input type='hidden' name='_token' value='" + Laravel.csrfToken + "'>\n" +
                "</form>\n"
        }).attr('style', 'cursor:pointer;text-decoration: none;')
            .click(function () {
                var deleteForm = $(this).find("form");
                var $modal = $('#delete-modal');
                $modal.find('[id=delete-modal-title]').text($(this).data('modal-target'));
                $modal.find('[id=delete-modal-submit]').on('click', function () {
                    deleteForm.submit();
                });
                $modal.modal('show');
            });
    }

    function loadComments(shouldMoveEnd) {
        var container = $('#comments-container');
        if (container.length > 0) {
            $.ajax({
                method: 'get',
                url: container.data('api-url'),
            }).done(function (data) {
                container.html(data);
                initDeleteTarget();
                highLightCodeOfChild(container);
                if (shouldMoveEnd) {
                    moveEnd($('#comment-submit'));
                }
            });
        }
    }

    function initUploadAvatar() {
        $('#upload-avatar').on('click', function () {

        });
    }

    function initComment() {
        var form = $('#comment-form');
        var submitBtn = form.find('#comment-submit');
        var commentContent = form.find('#comment-content');

        var username = form.find('input[name=username]');
        var email = form.find('input[name=email]');

        if (window.localStorage) {
            username.val(localStorage.getItem('comment_username'));
            email.val(localStorage.getItem('comment_email'));
        }

        form.on('submit', function () {
            if (username.length > 0) {
                if ($.trim(username.val()) == '') {
                    username.focus();
                    return false;
                }
                else if ($.trim(email.val()) == '') {
                    email.focus();
                    return false;
                }
            }

            if ($.trim(commentContent.val()) == '') {
                commentContent.focus();
                return false;
            }

            var usernameValue = username.val();
            var emailValue = email.val();

            submitBtn.val('提交中...').addClass('disabled').prop('disabled', true);
            $.ajax({
                method: 'post',
                url: $(this).attr('action'),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    commentable_id: form.find('input[name=commentable_id]').val(),
                    commentable_type: form.find('input[name=commentable_type]').val(),
                    content: commentContent.val(),
                    username: usernameValue,
                    email: emailValue,
                },
            }).done(function (data) {
                if (data.status === 200) {
                    if (window.localStorage) {
                        localStorage.setItem('comment_username', usernameValue);
                        localStorage.setItem('comment_email', emailValue);
                    }
                    username.val('');
                    email.val('');
                    commentContent.val('');
                    form.find('#comment_error_msg').text('');
                    loadComments(true);
                } else {
                    form.find('#comment_error_msg').text(data.msg);
                }
            }).always(function () {
                submitBtn.val("回复").removeClass('disabled').prop('disabled', false);
            });
            return false;
        });
    }

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

    function highLightCode() {
        $('pre code').each(function (i, block) {
            hljs.highlightBlock(block);
        });
    }

    function highLightCodeOfChild(parent) {
        $('pre code', parent).each(function (i, block) {
            console.log(block);
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
        /*if (Laravel.duoshuo_enable) {
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
         }*/
    }

    function initProjects() {
        var projects = $('.projects');
        if (projects.length > 0) {
            $.get('https://api.github.com/users/lufficc/repos?type=owner',
                function (repositories) {
                    if (!repositories) {
                        projects.html('<div><h3>加载失败</h3><p>请刷新或稍后再试...</p></div>');
                        return;
                    }
                    projects.html('');
                    repositories = repositories.sort(function (repo1, repo2) {
                        return repo2.stargazers_count - repo1.stargazers_count;
                    });
                    repositories = repositories.filter(function (repo) {
                        return repo.description != null;
                    });
                    repositories.forEach(function (repo) {
                        var repoTemplate = $('#repo-template').html();
                        var item = repoTemplate.replace(/\[(.*?)\]/g, function () {
                            return eval(arguments[1]);
                        });
                        projects.append(item)
                    })
                });
        }
    }

    window.LufficcBlog = LufficcBlog;
})(jQuery);
$(document).ready(function () {
    LufficcBlog.init();
});
function replySomeone(username) {
    var commentContent = $("#comment-content");
    var oldContent = commentContent.val();
    prefix = "@" + username + " ";
    var newContent = '';
    if (oldContent.length > 0) {
        newContent = oldContent + "\n" + prefix;
    } else {
        newContent = prefix
    }
    commentContent.focus();
    commentContent.val(newContent);
    moveEnd(commentContent);
}

var moveEnd = function (obj) {
    obj.focus();
    var len = obj.value === undefined ? 0 : obj.value.length;

    if (document.selection) {
        var sel = obj.createTextRange();
        sel.moveStart('character', len);
        sel.collapse();
        sel.select();
    } else if (typeof obj.selectionStart == 'number' && typeof obj.selectionEnd == 'number') {
        obj.selectionStart = obj.selectionEnd = len;
    }
}