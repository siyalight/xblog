<header class="main-header jumbotron">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a class="branding" href="/" title="title">
                    <img class="img-circle" src="https://avatars1.githubusercontent.com/u/20706332">
                </a>
                <h2>lufficc</h2>
                @if(Auth::check())
                    <p>Welcome {{ Auth::user()->name }}
                        <span>
                        <a href="{{ url('/logout') }}" style="color: white;"
                           onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                            Logout
                        </a>

                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </span>
                    </p>
                @else
                    <p>Stay hungry.Stay Foolish.</p>
                @endif
            </div>
        </div>
    </div>
</header>