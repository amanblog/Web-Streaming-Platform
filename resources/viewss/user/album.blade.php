@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <h3>{{$album->title}}</h3>
                <p><strong>Artist(s): </strong>@foreach($album->songs as $song)@foreach($song->artists as $artist)<a class="dynpage" href="/artist/{{$artist->url}}">{{$artist->name}}</a>@if($loop->last)@else,@endif @endforeach @endforeach</p>
                {{--            <p><strong>Album: </strong>{{$album->year}}</p>--}}
                <p><strong>Year: </strong>{{$album->year}}</p>

                <h4>Songs</h4>
                <p><strong>Song(s): </strong>@foreach($album->songs as $song) <a class="dynpage" href="/play/{{$song->url}}">{{$song->title}}</a>
                    <br> @endforeach</p>

            </div>
            <div class="col-md-6">
                {{--            <img src="{{ url('storage/images/'.$song->album_art)  }}" alt="{{$song->title}}_album_art" class="img-fluid" width="250px">--}}
            </div>
        </div>
    </div>
@stop
@section('scripts')

@stop
