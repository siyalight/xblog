# Laravel Blog

[![Build Status](https://travis-ci.org/laravel/framework.svg)](https://travis-ci.org/laravel/framework)
[![License](https://poser.pugx.org/laravel/framework/license.svg)](https://packagist.org/packages/laravel/framework)

A fast and powerful blog system powed by laravel 5.3.

## Features

1. Markdown editor,upload images to qiniu cloud by drag or from clipboard.
1. Separate models from controllers with repository design pattern.
1. Cache with redis database `0` and session with redis database `1`.
1. Images and files management.
1. Pjax support.
1. Google analytics,admin management.
1. Posts with category, tags and different status. 
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

![1](https://static.lufficc.com/image/fb64b85e479461649486aa126da693a2.jpeg)

![2](https://static.lufficc.com/image/c06518bf4839623e1482e77dc8759431.jpeg)

![3](https://static.lufficc.com/image/b271b1c53654340c3f828d7f67cbb8bb.jpeg)

![4](https://static.lufficc.com/image/83f871667596b90d49cbf1657be06255.jpeg)

![5](https://static.lufficc.com/image/63c8a1409256fec6b088b5f50ac22703.jpeg)

![6](https://static.lufficc.com/image/89f0432eab0e4c8ba492505f98696a6e.jpeg)

![7](https://static.lufficc.com/image/8291c34b8560050f7cb7aa136c48a97e.jpeg)


## License

This blog is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
