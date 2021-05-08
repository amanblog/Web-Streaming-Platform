<div class="container-fluid">
    <div class="col-md-12">
        <div class="card">
            <p class="card-header">Search Result for <b>"{{$arg}}"</b></p>

            <table class="table song-table">
                <thead>
                <tr>
                    <th scope="row"></th>
                    <th scope="row"></th>
                </tr>
                </thead>
                <tbody>
                <h4 class="py-1 ml-2 mt-2">Songs</h4>
                @if($songs->count() > 0)
                    @foreach($songs as $song)
                        <tr>
                            <td><a class="dynpage" href="/play/{{$song->url}}"><img src="{{ url('storage/images/'.$song->album_art)  }}" height="50px" alt=""></a></td>
                            <td class="song-title"><a class="dynpage" href="/play/{{$song->url}}">{{$song->title}}</a></td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td>No matching songs</td>
                    </tr>
                @endif
                </tbody>
            </table>

            <table class="table artist-table">
                <thead>
                <tr>
                    <th scope="row"></th>
                    <th scope="row"></th>
                </tr>
                </thead>
                <tbody>
                <h4 class="py-1 ml-2 mt-2">Artists</h4>
                @if($artists->count() > 0)
                    @foreach($artists as $artist)
                        <tr>
                            <td><a class="dynpage" href="/artist/{{$artist->url}}"><img src="{{ url('storage/images/artists/'.$artist->profile_pic)  }}" height="50px" alt=""></a></td>

                            <td class="artist-title"><a class="dynpage" href="/artist/{{$artist->url}}">{{$artist->name}}</a></td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td>No matching artist</td>
                    </tr>
                @endif
                </tbody>
            </table>
            <table class="table albums-table">
                <tbody>
                <h4 class="py-1 ml-2 mt-2">Albums</h4>
                @if($albums->count() > 0)
                    @foreach($albums as $album)
                        <tr>
                            <td class="album-title"><a class="dynpage" href="/album/{{$album->path}}">{{$album->title}}</a></td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td>No matching Albums</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

