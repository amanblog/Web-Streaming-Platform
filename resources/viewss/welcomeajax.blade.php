
    <div class=" container-fluid">
        <div class="row">
            <div class="col-md-12">

                {{--    Artist Section--}}
                <section class="artists">
                    <div class="row">
                        <div class="col-md-3">
                            <h3>Artists</h3>
                        </div>
                        <div class="col-md-9">
                            <div class="float-right">
                                <img class="arr-left" src="{{ url('/storage/images/assets/arr-left.svg')}}" height="40px" alt="">
                                <img class="arr-right" src="{{ url('/storage/images/assets/arr-right.svg')}}" height="40px" alt="">
                            </div>
                        </div>
                    </div>
                    <!-- Swiper Artist -->
                    <div class="swiper-container artist-swiper">
                        <div class="swiper-wrapper">
                            @foreach($artists as $artist)
                                <div class="swiper-slide">
                                    <figure class="figure">

                                        <a class="dynpage" href="/artist/{{$artist->url }}">
                                            <img src="{{ url('storage/images/artists/'.$artist->thumb_120)  }}" class="figure-img img-fluid rounded" alt="{{$artist->name}} pic">
                                        </a>
                                        <figcaption class="figure-caption"><a class="dynpage" href="/artist/{{$artist->url}}">{{$artist->name}}</a></figcaption>
                                    </figure>

                                </div>
                            @endforeach
                        </div>
                    </div>
                </section>

                {{--    Songs Section--}}
                <section class="songs mt-5">
                    <div class="row">
                        <div class="col-md-3">
                            <h3>Songs</h3>
                        </div>
                        <div class="col-md-9">
                            <div class="float-right">
                                <img class="arr-lefts" src="{{ url('/storage/images/assets/arr-left.svg')}}" height="40px" alt="">
                                <img class="arr-rights" src="{{ url('/storage/images/assets/arr-right.svg')}}" height="40px" alt="">
                            </div>
                        </div>
                    </div>
                    <!-- Swiper Song -->
                    <div class="swiper-container song-swiper">
                        <div class="swiper-wrapper ">
                            @foreach($songs as $song)
                                <div class="swiper-slide">
                                    <figure class="figure">
                                        <a class="dynpage" href="/play/{{$song->url}}">
                                            <img src="{{ url('storage/images/'.$song->thumb_120)  }}" class="figure-img img-fluid rounded" alt="{{$song->title}} album art">
                                        </a>
                                        <figcaption class="figure-caption song-name"><a class="dynpage" href="/play/{{$song->url}}">{{ \Illuminate\Support\Str::limit($song->title, 16, $end='...') }}</a></figcaption>

                                        <figcaption class="figure-caption artist-song">
                                            @php($art_len = 0)
                                            @foreach($song->artists as $artist)
                                                @php($art_len = $art_len + \Illuminate\Support\Str::length($artist->name))
                                                <a class="dynpage" href="artist/{{$artist->url}}">@if($art_len <= 18){{$artist->name}}@else{{ \Illuminate\Support\Str::limit($artist->name,\Illuminate\Support\Str::length($artist->name) - ($art_len - 17),$end='...')}}</a> @break @endif @if($loop->last)@else,@endif @endforeach
                                        </figcaption>

                                    </figure>

                                </div>
                            @endforeach
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </div>

