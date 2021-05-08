@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <h3>{{$song->title}}</h3>
            <p><strong>Artist(s): </strong>@foreach($song->artists as $artist)<a href="/artist/{{$artist->url}}" class="dynpage">{{$artist->name}}</a>@if($loop->last)@else,@endif @endforeach</p>
            <p><strong>Album: </strong><a class="dynpage" href="/album/@foreach($song->albums as $album){{$album->path}}@if($loop->last)@else,@endif @endforeach">{{$song->album}}</a>
            <p><strong>Year: </strong>{{$song->year}}</p>
            <p><strong>Explicit: </strong>@if($song->explicit==1)Yes @else No @endif</p>
            <p><strong>Genre(s): </strong>@foreach($song->genres as $genre){{$genre->name}}@if($loop->last)@else,@endif @endforeach</p>

            <p><button class="btn btn-primary playbtn" data-songsrc="{{$song->path}}" data-songid="{{$song->id}}">Play</button></p>
        </div>
        <div class="col-md-6">
            <img src="{{ url('storage/images/'.$song->thumb_250)  }}" alt="{{$song->title}}_album_art" class="img-fluid artist-pro" >
        </div>
    </div>
</div>
@stop
@section('scripts')

@stop
