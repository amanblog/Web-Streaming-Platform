<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Web Music') }}</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    {{--    Slider--}}
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">



</head>
<body>
<?php
if(!is_null(\Illuminate\Support\Facades\Auth::user())){

    $playlists = \App\Playlist::where('owner',Auth::user()->id)->get();
}
?>

<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white mb-4">
        <div class="container">
            <div class="row w-100">
                <div class="col-md-2 col-sm-6 col-6 order-md-first order-first">
                    <a class="navbar-brand dynpage" href="{{ url('/') }}">
                        {{ config('app.name', 'Web Music') }}
                    </a>
                </div>
                <div class="col-md-7 col-sm-12 col-12 order-sm-last order-last">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                    <span class="form-inline my-2 my-lg-0 w-100">
                        <input class="form-control mr-sm-2 w-100" id="search-bar" type="search" placeholder=" Search For Music, Albums, Artists" aria-label="Search">
                    </span>
                    </ul>
                </div>

                <div class="col-md-3 col-6 order-md-last col-sm-6">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                            aria-controls="navbarSupportedContent" aria-expanded="false"
                            aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">


                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
                            @guest
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif
                            @else
                                @can('isAdmin')
                                    <li class="nav-item">
                                        <a class="nav-link" href="/home">Dashboard</a>
                                    </li>
                                @endcan
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

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                              style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>

            </div> {{--row--}}
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
                                    <img src="{{ url('/storage/images/assets/homeicon.svg') }}" class="homeicon" alt="">

                                </div>
                                <div class="col-md-10 p-0 pl-1">
                                    <span class="ml-2">Home</span>
                                </div>
                            </div>
                        </div>
                        <div class="menu-item p-3 ">
                            <div class="row">
                                <div class="col-md-2 p-0">
                                    <img src="{{ url('/storage/images/assets/songicon.svg') }}" width="19px" alt="">

                                </div>
                                <div class="col-md-10 p-0 pl-1">
                                    <span class="ml-2">Song</span>
                                </div>
                            </div>
                        </div>
                        <div class="menu-item p-3 ">
                            <div class="row">
                                <div class="col-md-2 p-0">
                                    <img src="{{ url('/storage/images/assets/albums.svg') }}" alt="">

                                </div>
                                <div class="col-md-10 p-0 pl-1">
                                    <span class="ml-2">Albums</span>
                                </div>
                            </div>
                        </div>
                        <div class="menu-item p-3 ">
                            <div class="row">
                                <div class="col-md-2 p-0">
                                    <img src="{{ url('/storage/images/assets/artists.svg') }}" alt="">

                                </div>
                                <div class="col-md-10 p-0 pl-1">
                                    <span class="ml-2">Artists</span>
                                </div>
                            </div>
                        </div>
                        <div class="menu-item p-3 ">
                            <div class="row">
                                <div class="col-md-2 p-0">
                                    <img src="{{ url('/storage/images/assets/genres.svg') }}" alt="">

                                </div>
                                <div class="col-md-10 p-0 pl-1">
                                    <span class="ml-2">Genres</span>
                                </div>
                            </div>
                        </div>
                        <div class="menu-item p-3 ">
                            <div class="row">
                                <div class="col-md-2 p-0">
                                    <img src="{{ url('/storage/images/assets/fav.svg') }}" alt="">

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
                            <span><a class="dynpage" href="/charts/top">Top Hits</a></span>
                        </div>
                        <div class="play-item p-3">
                            <span><a class="dynpage" href="/charts/trending">Trending Hits</a></span>
                        </div>
                        @if(isset($playlists) && $playlists->count())
                            @foreach($playlists as $playlist)
                                <div class="play-item p-3">
                                    <span><a class="dynpage" href="/playlist/{{$playlist->url}}">{{$playlist->name}}</a></span>

                                </div>
                            @endforeach
                        @endif
                        <div class="add-play p-3">
                            <button class="btn btn-success playlist-btn" data-toggle="modal" data-target="#playlistmodal">+ Create New</button>
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

        {{-- Search--}}
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
    <div class="playbar fixed-bottom" style="z-index: 1;">
        <div class="row">

            <div class="col-md-10 col-lg-8 offset-lg-3 col-sm-12 offset-md-1 p-0 card">
                <div class="audio-player">
                    <div class="player row ">
                        <div class="controller col-md-8" style="display: inline-block">
                            <div class="d-flex">
                                <img class="current-playing-art rounded-left" src="{{ url('/storage/images/player/download.png')  }}" height="100%" width="74px" alt="">
                                <div class="row w-100">
                                    <div class="col-md-5 m-auto pr-0" style="padding-left: 7px">
                                        <div class="playbar-name ">
                                            <span class="d-block name">Title</span>
                                            <span class="album">Album</span>
                                        </div>
                                    </div>
                                    <div class="col-md-5 m-auto pr-0">

                                        <div class="playBackBar flex-fill ">
                                            <input type="range" id="songProgress" min="0" value="0" >

                                        </div>
                                    </div>
                                    <div class="col-md-2 m-auto p-0">
                                        <div class="song-timing m-auto">
                                            <span id="currentTime" class="current-time d-block text-center">00:00</span>

                                            <span id="duration" class="duration d-block text-center">00:00</span>
                                        </div>
                                    </div>
                                </div>
                            </div>



                        </div>
                        <div class="d-inline-block col-md-4">
                            <div class="row">
                                <img src="{{ url('/storage/images/player/Prev.svg')  }}" class="mr-3" width="19px" onclick="decreasePlaybackRate()">
                                <img src="{{ url('/storage/images/player/play.svg')  }}" width="38px" class="controllerplaybtn" onclick="playOrPauseSong(this)">
                                <img src="{{ url('/storage/images/player/Next.svg')  }}" class="ml-3" width="19px" onclick="increasePlaybackRate()">

                                <div class=" d-flex">
                                    <span class="dot-menu " style="margin-left: 2rem">...</span>
                                    <div class="btns-wrap">
                                        <img src="{{url('/storage/images/player/Repeat.svg')}}" data-toggle="tooltip" data-placement="top" title="Repeat" id="repeatbtn" style="margin-left: 2rem" width="15px" alt="">
                                        <img src="{{url('/storage/images/player/Shuffle.svg')}}" data-toggle="tooltip" data-placement="top" title="Shuffle" id="shufflebtn" class="ml-3" width="15px" alt="">
                                    </div>

                                    <div class="d-flex vol-wrapper">
                                        <img src="{{ url('/storage/images/player/Volume.svg')  }}" class="ml-3 vol-icon" class="ml-2" width="22px" >
                                        <div class="volumeBar flex-fill" ><input id="volumeSlider" type="range" min="0" max="1" step="0.01" value="0.5" oninput="adjustVolume()"></div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <ul class="dropdown-menu d-none context-menu position-absolute">
        <h6 class="dropdown-header font-weight-bold text-uppercase" data-toggle="modal" data-target="#playlistallmodal">Add to playlist</h6>
        <h6 class="dropdown-header font-weight-bold text-uppercase view-artist" data-toggle="modal" data-target="#artistmodal">Show Artist(s)</h6>
        <h6 class="dropdown-header font-weight-bold text-uppercase "><a class="view-album">View Album</a></h6>

    </ul>

    <div class="modal" tabindex="-1" role="dialog" id="playlistmodal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create Playlist</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form id="create_playlist" method="post" enctype="multipart/form-data">
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="play_name">Playlist name</label>
                                <input type="text" name="play_name" class="form-control" id="play_name" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="play_img">Image (Optional)</label>
                                <input type="file" name="play_img" class="form-control" id="play_img" accept="image/*">
                            </div>
                            <div class="col-md-6 offset-md-6">
                                <img src="" alt="" id="preview" width="100px">
                            </div>
                            @csrf
                        </div>
                        <button class="btn btn-primary" type="submit">Create</button>
                    </form>

                </div>
            </div>
        </div>
    </div>


    <div class="modal" tabindex="-1" role="dialog" id="playlistallmodal">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Select Playlist</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="dropdown-items">
                        <?php
                        if(is_null(\Illuminate\Support\Facades\Auth::user())){
                        ?>
                        <a class="dropdown-itemm" href="/login">Login to add to playlist</a>

                        <?php
                        }else{


                        $playlists = \App\Playlist::where('owner',Auth::user()->id)->get();
                        ?>
                        @if($playlists->count())
                            @foreach($playlists as $playlist)
                                <span class="dropdown-item" href="/playlist/{{$playlist->url}}">{{$playlist->name}}</span>
                            @endforeach
                        @else
                            <li class="dropdown-item">No Playlists Available!
                            </li>
                        @endif

                    </div>
                    <li class="bg-dark text-white create-playlist-button" style="padding: 0.25rem 1.5rem;cursor: pointer" data-toggle="modal" data-target="#playlistmodal">Create New Playlist</li>
                    <?php }
                    ?>

                </div>
            </div>
        </div>
    </div>



    <div class="modal" role="dialog" id="artistmodal">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">View Artist(s)</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="dropdown-items">
                            <li class="dropdown-item">No Artist Available!</li>
                    </div>

                </div>
            </div>
        </div>
    </div>



    <div class="toast border-0 rounded-pill mt-3 " role="alert" aria-live="assertive" aria-atomic="true" data-delay="1000" style="position: fixed; top: 0; right: 0;left: 0;margin: auto;z-index: 11">
        <div class="toast-header p-3 bg-success">
            <strong class="mr-auto text-white font-weight-normal"></strong>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close" style="opacity: 1">
                <span aria-hidden="true" class="text-white">&times;</span>
            </button>
        </div>
    </div>



    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    {{--slider--}}
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>

        function readURL(input) {
            if(input.files && input.files[0]){
                reader = new FileReader();

                reader.onload = function(e) {
                    $('#preview').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }

        }

        $('document').ready(function () {
            $('#play_img').change(function () {
                readURL(this);
            });


            $('body').on('submit','#create_playlist',function (e) {
                e.preventDefault();

                $.ajax({
                    type: 'POST',
                    contentType: false,
                    processData: false,
                    data: new FormData($(this)[0]),
                    url: '/playlist',
                    beforeSend: function(){

                    },
                    complete: function(data){
                        $('#playlistmodal').modal('hide');
                        $('.toast strong.text-white').html(JSON.parse(data.responseText).success);

                        $('.toast').toast('show');
                        $.get(window.location.href,function (data) {
                            $('.context-menu').html($(data).find('.context-menu').html());
                        })

                        $(".context-menu").addClass('d-none');
                        $(".context-menu").removeClass('d-block');

                    }
                });

            }); //create playlist


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).contextmenu(function (e) {
                e.preventDefault();
            })

            $('body').on('click','.create-playlist-button',function () {
                $('#playlistallmodal').modal('hide');
            })

            var closest_songid = null;
            // var sid = null;

            $('body').contextmenu(function (e) {
                e.preventDefault();
                if ($(e.target).closest('[data-songid]').data('songid')){
                    console.log($(e.target).closest('[data-songid]').data('songid'));
                    var sid = $(e.target).closest('[data-songid]').data('songid');
closest_songid = sid;
                }

                closest_songid = sid;
                if (closest_songid == null){
                    $('#playlistallmodal .dropdown-item').addClass('disabled');
                    $('.context-menu .dropdown-header').addClass('disabled text-muted').attr('data-toggle','');
                    $('.context-menu .view-album').removeAttr('href').removeClass('dynpage');
                }
                else{
                    $('#playlistallmodal .dropdown-item').removeClass('disabled');
                    $('.context-menu .dropdown-header').removeClass('disabled text-muted').attr('data-toggle','modal');

                    $.ajax({
                        type: 'GET',
                        url: "/view-album/"+closest_songid,
                        beforeSend: function(){
                        },
                        success: function(data){
                            // console.log(data);
                            // console.log(data.albumurl);
                            $('.context-menu .view-album').attr('href',data.albumurl).addClass('dynpage');
                            }
                    });

                }
                $('.dropdown-item.bg-dark').removeClass('disabled');

                $('.context-menu').removeClass('d-none');
                $('.context-menu').addClass('d-block');
                if (($(window).width() - e.clientX) < $('.context-menu').width()){
                    e.clientX = $(window).width() - $('.context-menu').width() - 10;
                }
                if (($(window).height() - e.clientY) < $('.context-menu').height()){
                    e.clientY = $(window).height() - $('.context-menu').height() - 50;
                }
                $('.context-menu').css('top',e.clientY + $(document).scrollTop());
                $('.context-menu').css('left',e.clientX);

            });

            $('body').on('click','.view-artist',function () {
                $.ajax({
                    type: 'GET',
                    url: "/view-artist/"+closest_songid,
                    beforeSend: function(){
                    },
                    success: function(data){
                        $('#artistmodal .dropdown-items').html(data.albumurl);
                        $('#artistmodal').modal('show');
                    }
                });
            });
            $('body').on('click','#playlistallmodal span.dropdown-item',function (e) {
                e.preventDefault();
                e.stopPropagation();
console.log($(this).attr('href').split('/')[2]);
                if ($(this) != $('li.dropdown-item')){
                    $.ajax({
                        type: 'POST',
                        url: "/playlistsave",
                        data: {songid:closest_songid, playid : $(this).attr('href').split('/')[2], "_token": "{{ csrf_token() }}",},
                        success: function(data){
                            $(".context-menu").addClass('d-none');
                            $(".context-menu").removeClass('d-block');

                            $('#playlistallmodal').modal('hide');
                            if (data.success != null){
                                $('.toast').toast('hide');
                                $('.toast strong.text-white').html(data.success);
                                $('.toast').toast('show');
                            }

                        },
                        complete: function(){
                        }
                    });
                }


            });

            $(document).on('click', function (e) {
                if ($(e.target).closest(".context-menu").length === 0) {

                    $(".context-menu").addClass('d-none');
                    $(".context-menu").removeClass('d-block');
                }
            });


            $('.overlay').addClass('d-none'); //to stop loading screen

            <!-- Initialize Swiper -->
            swiper_artist_fun();
            swiper_song_fun();

            //for positioning volume bar
            var pos = $('.vol-icon').position();
            $('.volumeBar').css({
                'top' : pos.top-60,
                'left' : pos.left-20,
            });

            $(function () {
                $('[data-toggle="tooltip"]').tooltip();
            });


            var width = $(window).width();
            $(window).on('resize', function() {
                if ($(this).width() !== width) {
                    $('.playbar-name a').css('width',$('span.d-block.name').width() * 0.90);
                    $('span.album').css('width',$('span.d-block.name').width() * 0.90);

                }
            });

//==========To dynamically change page==============================================================

            $('body').on('click','.dynpage',function(e){
                e.preventDefault();
                var url = $(this).attr('href');
                getDynData(url,1);
            });

            window.addEventListener('popstate', function (event) {
                var url = window.location.pathname;
                getDynData(url,0);
            });

            function getDynData(url,hist){ //to get data of pages url=location of page to get data, hist=to change history or not
                $.ajax({
                    type: 'GET',
                    url: url+"?req=ajax",
                    beforeSend: function(){
                        $('.overlay').removeClass('d-none'); //to show loading screen
                    },
                    success: function(data){

                        $('.mainbody>.col-md-12.order-first').html(data);
                        if (hist!==0){
                            history.pushState(null,null,url);
                        }
                    },
                    complete: function(){
                        $(window).scrollTop(0);
                        $(".context-menu").addClass('d-none');
                        $(".context-menu").removeClass('d-block');
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
                            slidesPerView: 5,
                            spaceBetween: 0
                        },

                        1200: {
                            slidesPerView: 6,
                            spaceBetween: 0
                        },
                    },
                });

            }

            function swiper_song_fun(){
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
                            slidesPerView: 5,
                            spaceBetween: 0
                        },

                        1200: {
                            slidesPerView: 6,
                            spaceBetween: 20
                        },
                    },
                });
            }

            $('#search-bar').keyup(function (e) {
                e.preventDefault();
                var term = $(this).val();
                if (term !== ''){
                    $.ajax({
                        type: 'GET',
                        url: '/search/'+term,
                        beforeSend: function(){
                            $('.overlay').removeClass('d-none'); //to show loading screen
                        },
                        success: function(data){
                            $('.search-page').removeClass('d-none');
                            $('.search-page>.row>.col-md-12.order-first').html(data);
                        },
                        complete: function(){
                            $('.overlay').addClass('d-none'); //to hide loading screen
                        }

                    });
                }
                else{
                    if($('.search-page').hasClass('d-none')){

                    }
                    else{
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
        var mouseDown  = false;
        var songid = 0;

        var currentplayingid = null;

        var song = new Audio();
        var currentSong = 0;
        var previousVol = null;

        $('body').on('click','.playbtn',function(e){

            var songsrcc = $(this).attr('data-songsrc');
            songid = $(this).attr('data-songid');
            songsrcc.toString();
            loadSong(songsrcc,songid);
        });

        var time_total = 0;
        function loadSong(songsrc, songid){

            time_total = 0;
            songsrc = songsrc.replace('public/','');

            $.ajax({
                type: 'GET',
                url: "/play/"+songid+"?req=playbar",
                beforeSend: function(){
                },
                success: function(data){

                    var alb_art = '{{ url('storage/images/')  }}'+'/'+data[0].thumb_120;
                    $('.current-playing-art').attr('src',alb_art);
                    currentplayingid = data[0].id;

                    $('.playbar-name .name').html('<a class="dynpage" href="/play/'+data[0].url+'">'+data[0].title+'</a>');
                    $('.playbar-name .album').html('<a class="dynpage" href="/album/'+data[1]+'">'+data[0].album+'</a>');
                    $('.playbar-name a').css('width',$('span.d-block.name').width() * 0.90);
                    $('span.album').css('width',$('span.d-block.name').width() * 0.90);
                },
                complete: function(){

                }

            });

            song.src = window.location.origin+'/getAudio/'+songsrc;
            song.playbackrate=1;
            song.currentTime = 0;
            if(previousVol != null){
                volumeSlider.val(previousVol);
            }
            else{
                volumeSlider.val('0.5');
                previousVol = 0.5;
            }

            song.volume = volumeSlider.val();
            var vol = song.volume * 100;
            $('#volumeSlider').css('background', 'linear-gradient(90deg,rgb(144, 123, 222) '+vol+'%,rgb(204, 204, 204) '+vol+'%)');

            setTimeout(showDuration,1000);
            playOrPauseSong();
        }

        setInterval(updateSongSlider, 1000);

        function updateSongSlider(){
            if (song.src){
                var c = Math.round(song.currentTime);
                songSlider.val(c);

                var progress = song.currentTime / song.duration * 100;
                var color = 'linear-gradient(90deg,rgb(144, 123, 222) '+progress+'%,rgb(204, 204, 204) '+progress+'%)';
                $('#songProgress').css('background',color);
                currentTime.text(convertTime(c));
            }
        }

        function convertTime(secs){

            if (!song.seeking){
                time_total++;
                if (time_total === 15){
                    $.ajax({
                        type: 'POST',
                        url: "/playnum/"+songid,
                        data: {_token: '{{csrf_token()}}'},

                    }).done(function (data) {
                    });
                }
            }
            var min = Math.floor(secs/60);
            var sec = secs % 60;
            min = (min<10)? "0" + min : sec;
            sec = (sec<10)? "0" + sec : sec;
            return (min+":"+sec);
        }

        function showDuration(){
            var d = Math.floor(song.duration);
            songSlider.attr('max', d);
            duration.text(convertTime(d));
        }

        $('#songProgress').on('input ',function () {
            seekSong();
        });

        $('.vol-icon').mouseover(function () {
            $('.volumeBar').show();
        });

        $('.vol-wrapper').mouseleave(function(){
            $('.volumeBar').hide();
        });

        $('.volumeBar').mouseover(function () {
            $('.volumeBar').show();
        });

        song.addEventListener('volumechange',function () {
            if(song.volume == 0){
                $('.vol-icon').attr('src', '{{ url('/storage/images/player/mute.svg')  }}');
            }
            else{
                $('.vol-icon').attr('src', '{{ url('/storage/images/player/Volume.svg')  }}');
            }
            var vol = song.volume * 100;
            volumeSlider.css('background', 'linear-gradient(90deg,rgb(144, 123, 222) '+vol+'%,rgb(204, 204, 204) '+vol+'%)');

        });




        $('.vol-icon').on('click',function () {
            // var vol = song.volume;

            if(song.volume > 0){
                song.volume = 0;
                $(this).attr('src', '{{ url('/storage/images/player/mute.svg')  }}');
            }
            else{
                song.volume = previousVol;
                $(this).attr('src', '{{ url('/storage/images/player/Volume.svg')  }}');
            }
            volumeSlider.val(song.volume);
        });


        function playOrPauseSong(img) {
            if (song.src) {
                song.playbackrate = 1;
                if (song.paused) {
                    song.play();
                    $('.playbar .controllerplaybtn').attr('src', window.location.origin + "/storage/images/player/pause.svg");
                    if (window.location.pathname === '/charts/top' || window.location.pathname === '/charts/trending' || window.location.pathname.split( '/' )[1] === 'playlist'){
                        $('.topplaybtn[data-songid="'+currentplayingid+'"]').attr('src', window.location.origin+"/storage/images/player/pause.svg");
                    }
                } else {
                    song.pause();
                    $('.playbar .controllerplaybtn').attr('src', window.location.origin + "/storage/images/player/play.svg");
                    if (window.location.pathname === '/charts/top' || window.location.pathname === '/charts/trending' || window.location.pathname.split( '/' )[1] === 'playlist'){
                        $('.topplaybtn[data-songid="'+currentplayingid+'"]').attr('src', window.location.origin+"/storage/images/player/play.svg");
                    }
                }
            }
        }


        $(document).ajaxComplete(function() {
            if ($('.topplaybtn').length) {
                $('.topplaybtn').each(function () {

                    if (parseInt(currentplayingid) === parseInt($(this).attr('data-songid'))) {
                        if (song.paused) {
                            $(this).attr('src', window.location.origin+"/storage/images/player/play.svg");
                        }
                        else{
                            $(this).attr('src', window.location.origin+"/storage/images/player/pause.svg");
                        }
                    }
                });
            }
        });


        $('body').on('click','.topplaybtn',function () {

            if (parseInt(currentplayingid) !== parseInt($(this).attr('data-songid'))){
                var songsrcc = $(this).attr('data-songsrc');
                songid = $(this).attr('data-songid');
                songsrcc.toString();
                loadSong(songsrcc,songid);
                $('.topplaybtn').attr('src', "{{ url('/storage/images/player/play.svg')  }}");
                $(this).attr('src', window.location.origin+"/storage/images/player/pause.svg");
            }
            else if (parseInt(currentplayingid) === parseInt($(this).attr('data-songid'))) {
                if (song.paused) {
                    $(this).attr('src', window.location.origin+"/storage/images/player/pause.svg");
                    playOrPauseSong();
                }
                else{
                    $(this).attr('src', window.location.origin+"/storage/images/player/play.svg");
                    playOrPauseSong();
                }
            }

        });

        function seekSong(){
            song.currentTime = songSlider.val();
            currentTime.text(convertTime(song.currentTime));
            var progress = song.currentTime / song.duration * 100;
            var color = 'linear-gradient(90deg,rgb(144, 123, 222) '+progress+'%,rgb(204, 204, 204) '+progress+'%)';
            $('#songProgress').css('background',color);

        }

        function adjustVolume(){
            song.volume = volumeSlider.val();
            var vol = song.volume * 100;
            previousVol = volumeSlider.val();
            volumeSlider.css('background', 'linear-gradient(90deg,rgb(144, 123, 222) '+vol+'%,rgb(204, 204, 204) '+vol+'%)');
        }

        volumeSlider.on('wheel',function (e) {
            e.preventDefault();
            if(e.originalEvent.deltaY < 0){
                // wheeled up
                if (song.volume !== 1 && (1-song.volume) >= 0.1){
                    song.volume = song.volume + 0.1;
                }
                else if((1-song.volume) < 0.1){
                    song.volume = 1;
                }
            }
            else {
                // wheeled down
                if (song.volume !== 0 && (1-song.volume) <= 0.9){
                    song.volume = song.volume - 0.1;
                }
                else if((1-song.volume) > 0.9){
                    song.volume = 0;
                }
            }
            volumeSlider.val(song.volume) ;
            var vol = song.volume * 100;
            volumeSlider.css('background', 'linear-gradient(90deg,rgb(144, 123, 222) '+vol+'%,rgb(204, 204, 204) '+vol+'%)');

            previousVol = song.volume;
        });

        function increasePlaybackRate(){
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
