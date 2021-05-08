@extends('layouts.app')
@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h3>Top Hits</h3>
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
                    @foreach($tops as $top)
                        <tr class="row" data-songid="{{$top->song_id}}">
                            <span class="d-none topsongid">{{$top->song_id}}</span>
                            <?php
                            $top->song = \App\Song::find($top->song_id);
                            ?>

                            <td class="col-1 m-auto" >{{$i}}</td>
                            <td class="col-5 m-auto">{{$top->song->title}}</td>
                            <td class="col-4 m-auto">@foreach($top->song->artists as $artist)<a href="/artist/{{$artist->url}}" class="dynpage">{{$artist->name}}</a>@if($loop->last)@else,@endif @endforeach</td>
                            <td class="col-2">
                                <img src="{{ url('/storage/images/player/play.svg')  }}" width="38px" class="topplaybtn" data-songsrc="{{$top->song->path}}" data-songid="{{$top->song->id}}" >
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
