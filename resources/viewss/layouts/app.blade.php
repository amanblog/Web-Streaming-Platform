<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    {{-- Slider --}}
    <link rel="stylesheet" href="https://unpkg.com/swiper@6.5.7/swiper.min.css">



</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white mb-4">
            <div class="container">
                <div class="row w-100">
                    <div class="col-md-2 col-sm-6 col-6 order-md-first order-first">
                        <a class="navbar-brand dynpage" href="{{ url('/') }}">
                            {{ config('app.name', 'Laravel') }}
                        </a>
                    </div>
                    <div class="col-md-7 col-sm-12 col-12 order-sm-last order-last">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">
                            <span class="form-inline my-2 my-lg-0 w-100">
                                <input class="form-control mr-sm-2 w-100" id="search-bar" type="search"
                                    placeholder=" Search For Music, Albums, Artists" aria-label="Search">
                            </span>
                        </ul>
                    </div>

                    <div class="col-md-3 col-6 order-md-last col-sm-6">
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">


                            <!-- Right Side Of Navbar -->
                            <ul class="navbar-nav ml-auto">
                                <!-- Authentication Links -->
                                @guest
                                    <li class="nav-item">
                                        <a class="nav-link"
                                            href="{{ route('login') }}">{{ __('Login') }}</a>
                                    </li>
                                    @if(Route::has('register'))
                                        <li class="nav-item">
                                            <a class="nav-link"
                                                href="{{ route('register') }}">{{ __('Register') }}</a>
                                        </li>
                                    @endif
                                @else
                                    <li class="nav-item">
                                        <a class="nav-link" href="/home">Dashboard</a>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                            {{ Auth::user()->name }} <span class="caret"></span>
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                            <a href="/profile" class="dropdown-item">Profile</a>
                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                {{ __('Logout') }}
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}"
                                                method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                        </div>
                                    </li>
                                @endguest
                            </ul>
                        </div>
                    </div>

                </div> {{-- row --}}
            </div>
        </nav>

        <main>

            <div class="row mainbody">
                <div class="col-md-12 col-lg-2 col-sm-12 p-0" style="z-index: 5">
                    <h4 class="ml-3">Library</h4>

                    <div class="sideNav mt-3 ml-3">
                        <div class="menu-contents pt-4 pb-4">
                            <div class="menu-item active p-3 ">
                                <div class="row">
                                    <div class="col-md-2 p-0">
                                        <img src="{{ url('/storage/images/assets/homeicon.svg') }}"
                                            class="homeicon" alt="">

                                    </div>
                                    <div class="col-md-10 p-0 pl-1">
                                        <span class="ml-2">Home</span>
                                    </div>
                                </div>
                            </div>
                            <div class="menu-item p-3 ">
                                <div class="row">
                                    <div class="col-md-2 p-0">
                                        <img src="{{ url('/storage/images/assets/songicon.svg') }}"
                                            width="19px" alt="">

                                    </div>
                                    <div class="col-md-10 p-0 pl-1">
                                        <span class="ml-2">Song</span>
                                    </div>
                                </div>
                            </div>
                            <div class="menu-item p-3 ">
                                <div class="row">
                                    <div class="col-md-2 p-0">
                                        <img src="{{ url('/storage/images/assets/albums.svg') }}"
                                            alt="">

                                    </div>
                                    <div class="col-md-10 p-0 pl-1">
                                        <span class="ml-2">Albums</span>
                                    </div>
                                </div>
                            </div>
                            <div class="menu-item p-3 ">
                                <div class="row">
                                    <div class="col-md-2 p-0">
                                        <img src="{{ url('/storage/images/assets/artists.svg') }}"
                                            alt="">

                                    </div>
                                    <div class="col-md-10 p-0 pl-1">
                                        <span class="ml-2">Artists</span>
                                    </div>
                                </div>
                            </div>
                            <div class="menu-item p-3 ">
                                <div class="row">
                                    <div class="col-md-2 p-0">
                                        <img src="{{ url('/storage/images/assets/genres.svg') }}"
                                            alt="">

                                    </div>
                                    <div class="col-md-10 p-0 pl-1">
                                        <span class="ml-2">Genres</span>
                                    </div>
                                </div>
                            </div>
                            <div class="menu-item p-3 ">
                                <div class="row">
                                    <div class="col-md-2 p-0">
                                        <img src="{{ url('/storage/images/assets/fav.svg') }}"
                                            alt="">

                                    </div>
                                    <div class="col-md-10 p-0 pl-1">
                                        <span class="ml-2">My Favorites</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h4 class="ml-3 mt-4">My Playlists</h4>

                    <div class="sidePlay mt-3 ml-3">
                        <div class="play-contents pt-2 pb-2">
                            <div class="play-item p-3">
                                <span>Top 50 Hits</span>
                            </div>
                            <div class="play-item p-3">
                                <span>Classical Music</span>
                            </div>
                            <div class="add-play p-3">
                                <button class="btn btn-success playlist-btn">+ Create New</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-10 order-lg-last order-first col-sm-12">
                    @yield('content')
                </div>
            </div>
            <div class="overlay ">
                <div class="text-center load-spinner">
                    <div class="" role="status">
                        <div class="loader"></div>
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </div>

            {{-- Search --}}
            <div class="search-page d-none">
                <div class="row">
                    <div class="col-md-12 col-lg-2 col-sm-12 p-0"></div>
                    <div class="col-md-12 col-lg-10 order-lg-last order-first col-sm-12">

                    </div>
                </div>
            </div>

        </main>
    </div>

    <footer id="footer">
        <div class="playbar fixed-bottom">
            <div class="row">

                <div class="col-md-10 col-lg-8 offset-lg-3 col-sm-12 offset-md-1 p-0 card">
                    <div class="audio-player">
                        <div class="player row ">
                            <div class="controller col-md-8" style="display: inline-block">
                                <div class="d-flex">
                                    <img class="current-playing-art rounded-left"
                                        src="{{ url('/storage/images/player/download.png') }}"
                                        height="100%" width="74px" alt="">
                                    <div class="row w-100">
                                        <div class="col-md-5 m-auto pr-0" style="padding-left: 7px">
                                            <div class="playbar-name ">
                                                <span class="d-block name">Title</span>
                                                <span class="album">Album</span>
                                            </div>
                                        </div>
                                        <div class="col-md-5 m-auto pr-0">

                                            <div class="playBackBar flex-fill ">
                                                <input type="range" id="songProgress" min="0" value="0">

                                            </div>
                                        </div>
                                        <div class="col-md-2 m-auto p-0">
                                            <div class="song-timing m-auto">
                                                <span id="currentTime"
                                                    class="current-time d-block text-center">00:00</span>

                                                <span id="duration" class="duration d-block text-center">00:00</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                            </div>
                            <div class="d-inline-block col-md-4">
                                <div class="row">
                                    <img src="{{ url('/storage/images/player/prev.svg') }}"
                                        class="mr-3" width="19px" onclick="decreasePlaybackRate()">
                                    <img src="{{ url('/storage/images/player/play.svg') }}"
                                        width="38px" class="controllerplaybtn" onclick="playOrPauseSong(this)">
                                    <img src="{{ url('/storage/images/player/next.svg') }}"
                                        class="ml-3" width="19px" onclick="increasePlaybackRate()">

                                    <div class=" d-flex">
                                        <span class="dot-menu " style="margin-left: 2rem">...</span>
                                        <div class="btns-wrap">
                                            <img src="{{ url('/storage/images/player/repeat.svg') }}"
                                                data-toggle="tooltip" data-placement="top" title="Repeat" id="repeatbtn"
                                                style="margin-left: 2rem" width="15px" alt="">
                                            <img src="{{ url('/storage/images/player/shuffle.svg') }}"
                                                data-toggle="tooltip" data-placement="top" title="Shuffle"
                                                id="shufflebtn" class="ml-3" width="15px" alt="">
                                        </div>

                                        <div class="d-flex vol-wrapper">
                                            <img src="{{ url('/storage/images/player/volume.svg') }}"
                                                class="ml-3 vol-icon" class="ml-2" width="22px">
                                            <div class="volumeBar flex-fill"><input id="volumeSlider" type="range"
                                                    min="0" max="1" step="0.01" value="0.5" oninput="adjustVolume()">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Scripts -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
        </script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
        </script>
        {{-- slider --}}
        <script src="https://unpkg.com/swiper@6.5.7/swiper-bundle.min.js"></script>
        <script>
            $(document).ready(function () {

                $('.overlay').addClass('d-none'); //to stop loading screen


                //Initialize Swiper
                swiper_artist_fun();
                swiper_song_fun();

                //for positioning volume bar
                var pos = $('.vol-icon').position();
                $('.volumeBar').css({
                    'top': pos.top - 60,
                    'left': pos.left - 20,
                });

                $(function () {
                    $('[data-toggle="tooltip"]').tooltip();
                });


                var width = $(window).width();
                $(window).on('resize', function () {
                    if ($(this).width() !== width) {
                        $('.playbar-name a').css('width', $('span.d-block.name').width() * 0.90);
                        $('span.album').css('width', $('span.d-block.name').width() * 0.90);

                    }
                });

                //==========To dynamically change page==============================================================

                $('body').on('click', '.dynpage', function (e) {
                    e.preventDefault();
                    var url = $(this).attr('href');
                    getDynData(url, 1);
                });

                window.addEventListener('popstate', function (event) {
                    var url = window.location.pathname;
                    getDynData(url, 0);
                });

                function getDynData(url,
                    hist
                ) { //to get data of pages url=location of page to get data, hist=to change history or not
                    $.ajax({
                        type: 'GET',
                        url: url + "?req=ajax",
                        beforeSend: function () {
                            $('.overlay').removeClass('d-none'); //to show loading screen
                        },
                        success: function (data) {

                            $('.mainbody>.col-md-12.order-first').html(data);
                            if (hist !== 0) {
                                history.pushState(null, null, url);
                            }
                        },
                        complete: function () {
                            $('.search-page').addClass('d-none');
                            $('#search-bar').val("");
                            $('.overlay').addClass('d-none'); //to hide loading screen

                            swiper_artist_fun();

                            swiper_song_fun();
                        }
                    });
                }

                function swiper_artist_fun() {

                    var swiper_artist = new Swiper('.artists .swiper-container', {
                        slidesPerView: 7,
                        spaceBetween: 0,
                        freeMode: true,
                        navigation: {
                            nextEl: '.arr-right',
                            prevEl: '.arr-left',
                        },
                        breakpoints: {
                            0: {
                                slidesPerView: 3,
                                spaceBetween: 10
                            },
                            576: {
                                slidesPerView: 4,
                                spaceBetween: 10
                            },
                            768: {
                                slidesPerView: 5,
                                spaceBetween: 10
                            },
                            992: {
                                slidesPerView: 5,
                                spaceBetween: 0
                            },
                            1150: {
                                slidesPerView: 6,
                                spaceBetween: 0
                            },

                            1200: {
                                slidesPerView: 7,
                                spaceBetween: 0
                            },
                        },
                    });

                }

                function swiper_song_fun() {
                    var swiper_song = new Swiper('.song-swiper', {
                        slidesPerView: 7,
                        spaceBetween: 20,
                        freeMode: true,
                        navigation: {
                            nextEl: '.arr-rights',
                            prevEl: '.arr-lefts',
                        },
                        breakpoints: {
                            0: {
                                slidesPerView: 3,
                                spaceBetween: 10
                            },
                            576: {
                                slidesPerView: 4,
                                spaceBetween: 10
                            },
                            768: {
                                slidesPerView: 5,
                                spaceBetween: 10
                            },
                            992: {
                                slidesPerView: 5,
                                spaceBetween: 0
                            },
                            1150: {
                                slidesPerView: 6,
                                spaceBetween: 0
                            },

                            1200: {
                                slidesPerView: 7,
                                spaceBetween: 20
                            },
                        },
                    });
                }

                $('#search-bar').keyup(function (e) {
                    e.preventDefault();
                    var term = $(this).val();
                    if (term !== '') {
                        $.ajax({
                            type: 'GET',
                            url: '/search/' + term,
                            beforeSend: function () {
                                $('.overlay').removeClass(
                                    'd-none'); //to show loading screen
                            },
                            success: function (data) {
                                $('.search-page').removeClass('d-none');
                                $('.search-page>.row>.col-md-12.order-first').html(data);
                            },
                            complete: function () {
                                $('.overlay').addClass('d-none'); //to hide loading screen
                            }

                        });
                    } else {
                        if ($('.search-page').hasClass('d-none')) {

                        } else {
                            $('.search-page').addClass('d-none');
                        }
                    }

                });


            }); //document ready


            //==========Playbar==================================================================================
            var songSlider = $('#songProgress');
            var currentTime = $('#currentTime');
            var duration = $('#duration');
            var volumeSlider = $('#volumeSlider');
            var mouseDown = false;

            var song = new Audio();
            var currentSong = 0;

            $('body').on('click', 'button.playbtn', function (e) {

                var songsrcc = $(this).attr('data-songsrc');
                var songid = $(this).attr('data-songid');
                songsrcc.toString();
                loadSong(songsrcc, songid);
            });

            function loadSong(songsrc, songid) {
                songsrc = songsrc.replace('public/', '');

                $.ajax({
                    type: 'GET',
                    url: "/play/" + songid + "?req=playbar",
                    beforeSend: function () {},
                    success: function (data) {

                        var alb_art = '{{ url('storage/images/') }}' + '/' + data[0]
                            .thumb_120;
                        $('.current-playing-art').attr('src', alb_art);

                        $('.playbar-name .name').html('<a class="dynpage" href="/play/' + data[0].url +
                            '">' + data[0].title + '</a>');
                        $('.playbar-name .album').html('<a class="dynpage" href="/album/' + data[1] + '">' +
                            data[0].album + '</a>');
                        $('.playbar-name a').css('width', $('span.d-block.name').width() * 0.90);
                        $('span.album').css('width', $('span.d-block.name').width() * 0.90);
                    },
                    complete: function () {

                    }

                });

                song.src = window.location.origin + '/getAudio/' + songsrc;
                song.playbackrate = 1;
                song.currentTime = 0;
                volumeSlider.val('0.5');
                song.volume = volumeSlider.val();
                var vol = song.volume * 100;
                $('#volumeSlider').css('background', 'linear-gradient(90deg,rgb(144, 123, 222) ' + vol +
                    '%,rgb(204, 204, 204) ' + vol + '%)');

                setTimeout(showDuration, 1000);
                playOrPauseSong();
            }

            setInterval(updateSongSlider, 500);

            function updateSongSlider() {
                if (song.src) {
                    var c = Math.round(song.currentTime);
                    songSlider.val(c);

                    var progress = song.currentTime / song.duration * 100;
                    var color = 'linear-gradient(90deg,rgb(144, 123, 222) ' + progress + '%,rgb(204, 204, 204) ' +
                        progress + '%)';
                    $('#songProgress').css('background', color);
                    currentTime.text(convertTime(c));
                }
            }

            function convertTime(secs) {
                var min = Math.floor(secs / 60);
                var sec = secs % 60;
                min = (min < 10) ? "0" + min : sec;
                sec = (sec < 10) ? "0" + sec : sec;
                return (min + ":" + sec);
            }

            function showDuration() {
                var d = Math.floor(song.duration);
                songSlider.attr('max', d);
                duration.text(convertTime(d));
            }



            $('#songProgress').on('input ', function () {
                seekSong();
            });

            $('.vol-icon').mouseover(function () {
                $('.volumeBar').show();
            });

            $('.vol-wrapper').mouseleave(function () {
                $('.volumeBar').hide();
            });

            $('.volumeBar').mouseover(function () {
                $('.volumeBar').show();
            });

            song.addEventListener('volumechange', function () {
                if (song.volume == 0) {
                    $('.vol-icon').attr('src',
                        '{{ url('/storage/images/player/mute.svg') }}');
                } else {
                    $('.vol-icon').attr('src',
                        '{{ url('/storage/images/player/volume.svg') }}');
                }
                var vol = song.volume * 100;
                volumeSlider.css('background', 'linear-gradient(90deg,rgb(144, 123, 222) ' + vol +
                    '%,rgb(204, 204, 204) ' + vol + '%)');

            });




            $('.vol-icon').on('click', function () {
                // var vol = song.volume;

                if (song.volume > 0) {
                    song.volume = 0;
                    $(this).attr('src',
                        '{{ url('/storage/images/player/mute.svg') }}');
                } else {
                    song.volume = 0.5;
                    $(this).attr('src',
                        '{{ url('/storage/images/player/volume.svg') }}');
                }
                volumeSlider.val(song.volume);
            });


            function playOrPauseSong(img) {
                if (song.src) {
                    song.playbackrate = 1;
                    if (song.paused) {
                        song.play();
                        $('.controllerplaybtn').attr('src', window.location.origin +
                            "/storage/images/player/pause.svg");
                    } else {
                        song.pause();
                        $('.controllerplaybtn').attr('src', window.location.origin + "/storage/images/player/play.svg")
                    }
                }
            }

            function seekSong() {
                song.currentTime = songSlider.val();
                currentTime.text(convertTime(song.currentTime));
                var progress = song.currentTime / song.duration * 100;
                var color = 'linear-gradient(90deg,rgb(144, 123, 222) ' + progress + '%,rgb(204, 204, 204) ' +
                    progress + '%)';
                $('#songProgress').css('background', color);

            }

            function adjustVolume() {
                song.volume = volumeSlider.val();
                var vol = song.volume * 100;
                volumeSlider.css('background', 'linear-gradient(90deg,rgb(144, 123, 222) ' + vol +
                    '%,rgb(204, 204, 204) ' + vol + '%)');
            }

            function increasePlaybackRate() {
                song.playbackrate += 0.5;

            }

            function decreasePlaybackRate() {
                song.playbackrate -= 0.5;
            }

        </script>


        @yield('scripts')
    </footer>
</body>

</html>
