@extends('layouts.app')
@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h3>Trending Hits</h3>
            </div>

            <div class="col-md-12">
                @php($i = 1)


                <table class="table table-borderless" id="top-song-list">
                    <thead>
                    <tr class="row">
                        <th scope="col" class="col-1">#</th>
                        <th scope="col" class="col-5">Title</th>
                        <th scope="col" class="col-4">Artist</th>
                        <th scope="col" class="col-2"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($trends as $trend)
                        <tr class="row" data-songid="{{$trend->song_id}}">
                            <span class="d-none topsongid">{{$trend->song_id}}</span>
                            <?php
                            $trend->song = \App\Song::find($trend->song_id);
                            ?>
                            <td class="col-1 m-auto" >{{$i}}</td>
                            <td class="col-5 m-auto">{{$trend->song->title}}</td>
                            <td class="col-4 m-auto">@foreach($trend->song->artists as $artist)<a href="/artist/{{$artist->url}}" class="dynpage">{{$artist->name}}</a>@if($loop->last)@else,@endif @endforeach</td>
                            <td class="col-2">
                                <img src="{{ url('/storage/images/player/play.svg')  }}" width="38px" class="topplaybtn" data-songsrc="{{$trend->song->path}}" data-songid="{{$trend->song->id}}" >
                            </td>
                        </tr>
                        @php($i++)
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>

@stop

@section('scripts')



@stop
