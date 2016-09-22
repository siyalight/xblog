## Laravel Blog

快速，优雅,  强大的博客系统，由Laravel5.3强力驱动。点击 [这里](https://lufficc.com/blog) 查看.

这是一个我个人使用的博客，也曾经使用Hexo 和 github pages 搭过网站，都是都不灵活。因此用Laravel写了这个博客。
我想说的是Laravel是最好的php框架。

后续会分享一些写这个博客的心得，欢迎关注。

如果你发现bugs,欢迎 issue.

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
1. XSS 保护
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

<img src="https://static.lufficc.com/image/6e349fb9cbb7ec3813569724fee36e8a.jpeg" width="400">&nbsp;<img src="https://static.lufficc.com/image/0ed12f108e87a8cb8ec5a3bd0d364baa.jpeg" width="400">
<br><br>
<img src="https://static.lufficc.com/image/76e6dc58db7b497e9a6e1adab447b2df.jpeg" width="400">&nbsp;<img src="https://static.lufficc.com/image/5da149dba4f57db2d6b45079f2911dcd.jpeg" width="400">
<br><br>
<img src="https://static.lufficc.com/image/85ac3814b42a1fe97ac0d97d88f28cb0.jpeg" width="400">&nbsp;<img src="https://static.lufficc.com/image/863db4bf6604dd1e6196799b130f1276.jpeg" width="400">
<br><br>
<img src="https://static.lufficc.com/image/e3b3d5e6a2ea2238000b7cbd809ad1e9.jpeg" width="400">&nbsp;<img src="https://static.lufficc.com/image/9d1a2c7a3c97a29440c7def9868c1f38.jpeg" width="400">



### 致谢

[laravel-china](https://laravel-china.org/)

### 协议

本博客采用  [MIT license](http://opensource.org/licenses/MIT).
