@if(isset($background_image) && $background_image)
    <style>
        @media screen and (min-width: 768px) {
            .main-header {
                background: url("{{ $background_image }}") no-repeat center center;
                background-size: 100% auto;
                position: static;
            }
        }
    </style>
@endif
<header class="main-header">
    <div class="container-fluid" style="margin-top: -15px">
        <nav class="navbar site-navbar" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#blog-navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse fix-top" id="blog-navbar-collapse">
                <ul class="nav navbar-nav">
                    <li><a href="{{ route('post.index') }}">文章</a></li>
                    {{--<li><a href="http://blog.lufficc.com/">博客</a></li>--}}
                    {{--<li><a href="{{ url('projects') }}">项目</a></li>--}}
                    <li><a href="{{ route('page.about') }}">关于</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    @if(Auth::check())
                        @if(isAdmin(Auth::user()))
                            <li><a href="{{ route('admin.index') }}">后台</a></li>
                        @endif
                        <li>
                            <a href="{{ url('/logout') }}" onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
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
                <form class="navbar-form navbar-right" role="search" method="get" action="{{ route('search') }}">
                    <input type="text" class="form-control" name="query" placeholder="搜索" required>
                    {{--<button type="submit" class="btn btn-default">搜索</button>--}}
                </form>
            </div>
        </nav>
    </div>
    <div class="container-fluid" style="margin-top: -20px">
        <a style="text-decoration: none" class="branding" href="{{ route('post.index') }}">
            <h2>{{ $author or ''}}</h2>
        </a>
        <p>{{ $description or '' }}</p>
    </div>
</header>