@extends('layouts.appdash')
@section('content')
<div class="row">
    <div class="col-md-6">
        <h3>{{ $song->title }}</h3>
        <p><strong>Artist(s): </strong>@foreach($song->artists as
            $artist){{ $artist->name }}@if($loop->last)@else,@endif @endforeach</p>
        <p><strong>Album: </strong>{{ $song->album }}</p>
        <p><strong>Year: </strong>{{ $song->year }}</p>
        <p><strong>Explicit: </strong>@if($song->explicit==1)Yes @else No @endif</p>
        <p><strong>Genre(s): </strong>@foreach($song->genres as $genre){{ $genre->name }}@if($loop->last)@else,@endif
            @endforeach</p>

            <a class="btn btn-primary" href="/edit/{{ $song->id }}">Edit</a>
    </div>
    <div class="col-md-6">
        <img src="{{ url('storage/images/'.$song->album_art) }}"
            alt="{{ $song->title }}_album_art" class="img-fluid" width="250px">
    </div>
</div>
<div class="row">
    <div class="col-md-12">

        <div class="audio-player">
            <div class="player">
                <input type="range" id="songSlider" class="song-slider" min="0" step="1" oninput="seekSong()" />
                <div>
                    <div id="currentTime" class="current-time">00:00</div>
                    <div id="duration" class="duration">00:00</div>
                </div>
                <div class="controller">
                    <img src="{{ url('storage/images/player/Prev.svg') }}" width="30px"
                        onclick="decreasePlaybackRate()">
                    <img src="{{ url('storage/images/player/play.svg') }}" width="40px"
                        onclick="playOrPauseSong(this)">
                    <img src="{{ url('storage/images/player/Next.svg') }}" width="30px"
                        onclick="increasePlaybackRate()">
                    <!-- <img src="{{ url('storage/images/player/volume_down.png') }}" width="30px"> -->
                    <input id="volumeSlider" type="range" min="0" max="1" step="0.01" oninput="adjustVolume()" />
                    <img src="{{ url('storage/images/player/Volume.svg') }}" width="30px">
                </div>
            </div>
        </div>
    </div>
</div>
@stop
    @section('scripts')

    <script>
        var songSlider = $('#songSlider');
        var currentTime = $('#currentTime');
        var duration = $('#duration');
        var volumeSlider = $('#volumeSlider');

        var song = new Audio();
        var currentSong = 0;

        window.onload = loadSong;

        function loadSong() {

            song.src =
                "{{ route('audio',str_replace('public/','',$song->path)) }}";
            song.playbackrate = 1;
            song.currentTime = 0;
            song.volume = volumeSlider.val();

            setTimeout(showDuration, 1000);
        }

        setInterval(updateSongSlider, 1000);

        function updateSongSlider() {
            var c = Math.round(song.currentTime);
            songSlider.val(c);
            console.log(c);
            currentTime.text(convertTime(c));

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

        function playOrPauseSong(img) {
            song.playbackrate = 1;
            if (song.paused) {
                song.play();
                img.src = window.location.origin + "/storage/images/player/pause.svg";
            } else {
                song.pause();
                img.src = window.location.origin + "/storage/images/player/play.svg";
            }
        }

        function seekSong() {
            song.currentTime = songSlider.val();
            currentTime.text(convertTime(song.currentTime));
        }

        function adjustVolume() {
            song.volume = volumeSlider.val();
        }

        function increasePlaybackRate() {
            song.playbackrate += 0.5;

        }

        function decreasePlaybackRate() {
            song.playbackrate -= 0.5;
        }

    </script>
    @stop
