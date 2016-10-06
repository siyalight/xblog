<p align="center">
  <img src="images/logo.png" alt="Laravel blog: fast and powerful!" width="200">
  <br>
  <a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
  <a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>
<p align="center">Fast and powerful blog system powered by laravel 5.3. Click https://lufficc.com/blog to view.</p>
<p align="center"><img src="images/main1.png"  width="800"><p>
<br>

# Xblog

[中文readme](README_zh.md)|[Install](https://lufficc.com/blog/how-to-install-my-blog)

This blog is for my own use. I used to use hexo and github pages as my blog, but it's not flexible. Thus I write this
blog. What I want to say is laravel is the best php framework I've ever seen.

Later I will share some experience of writing this blog, welcome your watch.

If you find bugs , glad you to issue.

## Features

1. Markdown editor,upload images to qiniu cloud by drag or from clipboard.
1. Improved comment system. 
1. Github login.
1. Separate models from controllers with repository design pattern.
1. Cache with redis database `0` and session with redis database `1`.
1. Images and files management.
1. ~~Pjax support.~~
1. Google analytics,admin management.
1. Posts with category, tags,code highlight and different status. 
1. XSS protection
1. More customs...
 
## Requires

1. "php": ">=5.6.4"
1. "mysql": ">=5.7"

## Change log

1. Redis now is not a must, config your own cache drive.If you do not want to use cache,change `Repositories\Repository`'s`remember`method like below,it won't effect your logic:
```
     public function remember($key, Closure $entity, $tag = null)
    {
        return $entity();
        //return cache()->tags($tag == null ? $this->tag() : $tag)->remember($key, $this->time, $entity);
    }

```
2. add search powered by [algolia](https://www.algolia.com/)

3. rename from laravel-blog to Xblog ,RUN `git remote set-url origin https://github.com/lufficc/Xblog.git` to refresh your url if you have clone from laravel-blog.

## Install

```
git clone https://github.com/lufficc/laravel-blog.git

cd laravel-blog

// complete your .env file

composer update

php artisan migrate

php artisan serve

// that's all

```

## Attention

Please config your .env,you can copy `.env.example` and complete it:
```

// qiniu cloud for file upload
QINIU_AK= 
QINIU_SK=
QINIU_BUCKET=


// github oauth2 for github login
GITHUB_CLIENT_ID=
GITHUB_CLIENT_SECRET=
GITHUB_REDIRECT=

// default user avatar 
AVATAR=

```


## More screen shots
<p align="center">Code highlight post<p>
<p align="center"><img src="images/post.png" alt="post.png" width="85%"><p>
<br>

<p align="center">Markdown support comments<p>
<p align="center"><img src="images/markdown-support-comment.png" alt="markdown-support-comment.png" width="85%"><p>
<br>

<p align="center">Write post with creating multiple tags , selecting category , draging pictures to upload and auto saving.<p>
<p align="center"><img src="images/write-post.png" alt="write-post.png" width="85%"><p>
<br>

<p align="center">Writing post in fullscreen(with preview) mode without interruptting.<p>
<p align="center"><img src="images/write-post-fullscreen.png" alt="write-post-fullscreen.png" width="85%"><p>
<br>

<p align="center">Full states post management(publish,revoke,softdelete,delete,restore,draft)<p>
<p align="center"><img src="images/full-state-post-management.png" alt="full-state-post-management.png" width="85%"><p>
<br>

<p align="center">Admin dashboard<p>
<p align="center"><img src="images/admin-index.png" alt="admin-index.png" width="85%"><p>
<br>


<p align="center">Image management<p>
<p align="center"><img src="images/image-management.png" alt="image-management.png" width="85%"><p>
<br>

<p align="center">Comment management<p>
<p align="center"><img src="images/comment-management.png" alt="comment-management.png" width="85%"><p>
<br>

<p align="center">Site settings<p>
<p align="center"><img src="images/site-settings.png" alt="site-settings.png" width="85%"><p>
<br>

## Thanks

[laravel-china](https://laravel-china.org/)

## License

This blog is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
