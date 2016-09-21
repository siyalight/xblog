## Laravel Blog

快速，优雅,  强大的博客系统，由Laravel5.3强力驱动。

### 特点

1. Markdown 编辑器，支持图片拖拽，粘贴板图片上传到七牛并返回链接。
1. 完善的评论系统。
1. Github账号登录。
1. 采用 Repository 设计模式分离 Controller 和 Model 。
1. 采用Redis缓存（Cache 采用数据库 `0` ， Session 采用数据库 `1`）.
1. 图片，文件管理。
1. ~~Pjax 局部加载~~。
1. 谷歌分析，后台管理。
1. 文章可以分类，贴标签，代码高亮。 
1. 更多自定义...
 
### 环境要求

1. "php": ">=5.6.4"
1. "mysql": ">=5.7"
1. 必须安装 Redis.

### 安装

```
git clone https://github.com/lufficc/laravel-blog.git

cd laravel-blog

// 配置你的.env文件

php artisan migrate

php artisan serve

// that's all

```

### 截图

![截图](https://static.lufficc.com/image/e4aefe08305aed5cd79c0e109d3c2c07.jpeg)


### 致谢

(laravel-china)[https://laravel-china.org/]

### 协议

本博客采用  [MIT license](http://opensource.org/licenses/MIT).
