<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <h3>{{$artist->name}}</h3>
            {{--            <p><strong>Artist(s): </strong>@foreach($album->songs as $song)@foreach($song->artists as $artist){{$artist->name}}@if($loop->last)@else,@endif @endforeach @endforeach</p>--}}
            <p><strong>About: </strong>{{$artist->about}}</p>
            {{--            <p><strong>Year: </strong>{{$album->year}}</p>--}}

            <h4>Songs</h4>
            <p><strong>Song(s): </strong>@foreach($artist->songs as $song) <a class="dynpage" href="/play/{{$song->url}}">{{$song->title}}</a>
                <br> @endforeach</p>

        </div>
        <div class="col-md-6">
            <img src="{{ url('storage/images/artists/'.$artist->thumb_250)  }}" alt="{{$song->title}}_album_art" class="img-fluid artist-pro">
        </div>
    </div>

</div>
