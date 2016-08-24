<header class="main-header jumbotron">
    <div class="container-fluid" style="margin-top: -15px">
        <nav class="navbar">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle"
                        data-toggle="collapse" data-target="#example-navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="example-navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="{{ url('/') }}">文章</a></li>
                    <li><a href="{{ route('page.about') }}">关于</a></li>
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
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <a class="branding" href="/" title="title">
                                <img class="img-circle" src="https://avatars1.githubusercontent.com/u/20706332">
                            </a>
                            <h2>{{ Auth::check() ? Auth::user()->name : 'lufficc' }}</h2>
                            <p>Stay hungry.Stay Foolish.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>