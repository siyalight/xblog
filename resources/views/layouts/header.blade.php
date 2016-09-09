<header class="main-header">
    <div class="container-fluid" style="margin-top: -15px">
        <nav class="navbar site-navbar"  role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#blog-navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="blog-navbar-collapse">
                <ul class="nav navbar-nav">
                    <li><a href="{{ url('/') }}">文章</a></li>
                    <li><a href="http://blog.lufficc.com/">博客</a></li>
                    <li><a href="{{ route('page.about') }}">关于</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    @if(Auth::check())
                        <li>
                            <a href="{{ url('/logout') }}" style="color: white;"
                               onclick="event.preventDefault();
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
            </div>
        </nav>
    </div>
    <div class="container"  style="margin-top: -20px">
        <a style="text-decoration: none" class="branding" href="/">
            <h2>{{ Auth::check() ? Auth::user()->name : 'lufficc' }}</h2>
        </a>
        <p>Stay hungry.Stay Foolish.</p>
    </div>
</header>