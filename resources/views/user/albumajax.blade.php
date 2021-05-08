<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <h3>{{$album->title}}</h3>
            <p><strong>Artist(s): </strong><?php $artarr = array(); ?>@foreach($album->songs as $song)@foreach($song->artists as $artist)  @if(!in_array($artist->id,$artarr))<a class="dynpage" href="/artist/{{$artist->url}}">{{$artist->name}}</a><?php array_push($artarr,$artist->id); ?> @endif @if($loop->last)@else,@endif @endforeach @endforeach</p>
            {{--            <p><strong>Album: </strong>{{$album->year}}</p>--}}
            <p><strong>Year: </strong>{{$album->year}}</p>

            <h4>Songs</h4>
            <p><strong>Song(s): </strong>@foreach($album->songs as $song) <a class="dynpage" href="/play/{{$song->url}}">{{$song->title}}</a>
                <br> @endforeach</p>

{{--                        <p><strong>Explicit: </strong>@if($song->explicit==1)Yes @else No @endif</p>--}}
            {{--            <p><button class="btn btn-primary playbtn" data-songsrc="{{$song->path}}">Play</button></p>--}}
        </div>
        <div class="col-md-6">
                        <img src="{{ url('storage/images/'.$song->album_art)  }}" alt="{{$song->title}}_album_art" class="img-fluid" width="250px">
        </div>
    </div>

</div>
