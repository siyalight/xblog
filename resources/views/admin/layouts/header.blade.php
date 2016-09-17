<header class="main-header" style="padding: 10px 0;">
    <div class="container-fluid">
        <nav class="navbar site-navbar" style="margin-bottom: 0" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#blog-navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="blog-navbar-collapse">
                <ul class="nav navbar-nav">
                    <li><a href="{{ route('admin.index') }}">后台主页</a></li>
                    <li><a href="{{ route('post.create') }}">写作</a></li>
                    <li><a href="{{ route('admin.images') }}">图片</a></li>
                    <li><a href="{{ route('admin.files') }}">文件</a></li>
                    <li><a href="{{ route('admin.settings') }}">设置</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="{{ route('post.index') }}">回到站点</a></li>
                    @if(Auth::check())
                        <li>
                            <a href="{{ url('/logout') }}"
                               onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                退出登录
                            </a>
                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    @else
                        <li><a href="{{ url('login') }}">登录</a></li>
                        <li><a href="{{ url('register') }}">注册</a></li>
                    @endif
                </ul>
            </div>
        </nav>
    </div>
</header>