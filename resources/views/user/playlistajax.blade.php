

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <h3>{{$playlist->name}}</h3>
            </div>
            <div class="col-md-4">
                <?php

                if ($playlist->owner === \Illuminate\Support\Facades\Auth::user()->id){
                ?>
                <div class="row">
                    <div class="col-md-6">
                        <a href="/playlistedit/{{$playlist->url}}" class="float-right"><button class="btn btn-primary p-0 p-2 rounded-circle border-0" style="background-color: #907bde">
                                <img src="{{ url('/storage/images/assets/edit.svg') }}" width="25px" alt="">
                            </button></a>
                    </div>
                    <div class="col-md-6">
                        <a href="/playlistdelete/{{$playlist->url}}"><button class="btn btn-danger p-0 p-2 rounded-circle border-0" >
                                <img src="{{ url('/storage/images/assets/delete.svg') }}" width="25px" alt="">
                            </button></a>
                    </div>
                </div>
                <?php
                }

                ?>
            </div>

            <div class="col-md-12">
                @php($i = 1)


                @if($playlist->songs->count())
                    <table class="table table-borderless playlist" id="top-song-list">
                        <thead>
                        <tr class="row">
                            <th scope="col" class="col-1">#</th>
                            <th scope="col" class="col-5">Title</th>
                            <th scope="col" class="col-4">Artist</th>
                            <th scope="col" class="col-2"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($playlist->songs as $song)
                            <tr class="row" data-songid="{{$song->id}}">
                                <td scope="col" class="col-1">{{$i}}</td>
                                <td scope="col" class="col-5">{{$song->title}}</td>
                                <td scope="col" class="col-4" style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">@foreach($song->artists as $artist)
                                        <a href="artist/{{$artist->url}}">{{$artist->name}}</a>
                                        @if(!$loop->last),@endif
                                    @endforeach
                                </td>
                                <td scope="col" class="col-2">
                                    <img src="{{ url('/storage/images/player/play.svg')  }}" width="38px" class="topplaybtn" data-songsrc="{{$song->path}}" data-songid="{{$song->id}}" >

                                </td>
                            </tr>
                            <?php $i++ ?>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <p>No Songs Available</p>
                @endif

            </div> {{--col-md-12--}}
        </div> {{--row--}}
    </div> {{--container-fluid--}}

