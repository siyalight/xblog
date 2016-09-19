## Laravel Blog

快速，优雅,  强大的博客系统，由Laravel5.3强力驱动。

### 特点

1. Markdown 编辑器，支持图片拖拽，粘贴板图片上传到七牛并返回链接。
1. 完善的评论系统。
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

// compelete your .env file

php artisan migrate

php artisan serve

// that's all

```

### 截图

![1](https://static.lufficc.com/image/fb64b85e479461649486aa126da693a2.jpeg)

![2](https://static.lufficc.com/image/a0798ecb83ed0a0be74baff3688fa730.jpeg)

![3](https://static.lufficc.com/image/4d1127cebf4533b26aa026829d36a47d.jpeg)

![4](https://static.lufficc.com/image/a719a0e1711084c142e889ad91d6dc39.jpeg)

![5](https://static.lufficc.com/image/b271b1c53654340c3f828d7f67cbb8bb.jpeg)

![6](https://static.lufficc.com/image/83f871667596b90d49cbf1657be06255.jpeg)

![7](https://static.lufficc.com/image/63c8a1409256fec6b088b5f50ac22703.jpeg)

![8](https://static.lufficc.com/image/89f0432eab0e4c8ba492505f98696a6e.jpeg)

![9](https://static.lufficc.com/image/8291c34b8560050f7cb7aa136c48a97e.jpeg)


### 协议

本博客采用  [MIT license](http://opensource.org/licenses/MIT).
