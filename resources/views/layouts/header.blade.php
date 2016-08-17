<header class="main-header jumbotron">
    <ul class="menu pull-right">
        <li><a href="{{ url('/') }}">文章</a></li>
        @if(Auth::check())
            <li><a href="{{ route('post.create') }}">写作</a></li>
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
        @endif
    </ul>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a class="branding" href="/" title="title">
                    <img class="img-circle" src="https://avatars1.githubusercontent.com/u/20706332">
                </a>
                <h2>lufficc</h2>
                <p>Stay hungry.Stay Foolish.</p>
            </div>
        </div>
    </div>
</header>