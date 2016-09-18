# Laravel Blog

[![Build Status](https://travis-ci.org/laravel/framework.svg)](https://travis-ci.org/laravel/framework)
[![License](https://poser.pugx.org/laravel/framework/license.svg)](https://packagist.org/packages/laravel/framework)

A fast and powerful blog system powed by laravel 5.3.

## Features

1. Markdown editor,upload images to qiniu cloud by draging or from clipboard.
1. Separate models from controllers with repository design pattern.
1. Cache with redis database `0` and session with redis database `1`.
1. Images and files management.
1. Pjax support.
1. Google analytics,admin management,posts with category and tags.
1. More customs...
 
## Requires

1. "php": ">=5.6.4"
1. "mysql": ">=5.7"
1. Redis is must.

## install

```
git clone https://github.com/lufficc/laravel-blog.git

cd laravel-blog

// compelete your .env file

php artisan migrate

php artisan serve

// that's all

```

## screen shots


## License

This blog is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
