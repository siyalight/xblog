@extends('layouts.plain')
@section('content')
    <div id="particles" class="home-color-bg"></div>
    <div class="home-box">
        <h2 title="{{ $site_title or 'title' }}" style="margin: 0;">
            {{ $site_title or 'title' }}
            <a aria-hidden="true" href="{{ route('post.index') }}">
                <img class="img-circle" src="{{ $avatar or '' }}" alt="{{ $author or 'author' }}">
            </a>
        </h2>
        <h3 title="{{ $description or 'description' }}" aria-hidden="true" style="margin: 0">
            {{ $description or 'description' }}
        </h3>
        <p class="links">
            <font aria-hidden="true">»</font>
            <a href="{{ route('post.index') }}" aria-label="点击查看博客文章列表">博客</a>
            @if(isset($github_username) && $github_username)
                <font aria-hidden="true">/</font><a href="{{ route('projects') }}" aria-label="点击查看项目列表">项目</a>
            @endif
            @foreach($pages as $page)
                <font aria-hidden="true">/</font><a href="{{ route('page.show',$page->name) }}"
                                                    aria-label="查看{{ $author or 'author' }}的{{ $page->display_name }}">{{$page->display_name }}</a>

            @endforeach

        </p>
        <p class="links">
            <font aria-hidden="true">»</font>
            @foreach(config('social') as $key => $value)
                <a href="{{ $value['url'] }}" target="_blank"
                   aria-label="{{ $author or 'author' }} 的 {{ ucfirst($key) }} 地址">
                    <i class="{{ $value['fa'] }}" title="{{ ucfirst($key) }}"></i>
                </a>
            @endforeach
        </p>
    </div>
@endsection

@section('js')
    <script src="//cdn.bootcss.com/particles.js/2.0.0/particles.min.js"></script>
    <script>
        particlesJS('particles',
                {
                    "particles": {
                        "number": {
                            "value": 80,
                            "density": {
                                "enable": true,
                                "value_area": 800
                            }
                        },
                        "color": {
                            "value": "#ffffff"
                        },
                        "shape": {
                            "type": "circle",
                            "stroke": {
                                "width": 0,
                                "color": "#000000"
                            },
                            "polygon": {
                                "nb_sides": 5
                            },
                            "image": {
                                "src": "img/github.svg",
                                "width": 100,
                                "height": 100
                            }
                        },
                        "opacity": {
                            "value": 0.5,
                            "random": false,
                            "anim": {
                                "enable": false,
                                "speed": 1,
                                "opacity_min": 0.1,
                                "sync": false
                            }
                        },
                        "size": {
                            "value": 5,
                            "random": true,
                            "anim": {
                                "enable": false,
                                "speed": 40,
                                "size_min": 0.1,
                                "sync": false
                            }
                        },
                        "line_linked": {
                            "enable": true,
                            "distance": 150,
                            "color": "#ffffff",
                            "opacity": 0.4,
                            "width": 1
                        },
                        "move": {
                            "enable": true,
                            "speed": 6,
                            "direction": "none",
                            "random": false,
                            "straight": false,
                            "out_mode": "out",
                            "attract": {
                                "enable": false,
                                "rotateX": 600,
                                "rotateY": 1200
                            }
                        }
                    },
                    "interactivity": {
                        "detect_on": "canvas",
                        "events": {
                            "onhover": {
                                "enable": true,
                                "mode": "repulse"
                            },
                            "onclick": {
                                "enable": true,
                                "mode": "push"
                            },
                            "resize": true
                        },
                        "modes": {
                            "grab": {
                                "distance": 400,
                                "line_linked": {
                                    "opacity": 1
                                }
                            },
                            "bubble": {
                                "distance": 400,
                                "size": 40,
                                "duration": 2,
                                "opacity": 8,
                                "speed": 3
                            },
                            "repulse": {
                                "distance": 200
                            },
                            "push": {
                                "particles_nb": 4
                            },
                            "remove": {
                                "particles_nb": 2
                            }
                        }
                    },
                    "retina_detect": true,
                    "config_demo": {
                        "hide_card": false,
                        "background_color": "#b61924",
                        "background_image": "",
                        "background_position": "50% 50%",
                        "background_repeat": "no-repeat",
                        "background_size": "cover"
                    }
                }
        );
    </script>
@endsection