@extends('layouts.app')
@section('content')

    <div class="container-fluid">
        <div class="row">
            <form method="post" action="/playlistupdate/{{$playlist->url}}" class="w-100">
                @csrf
                <div class="row">
                    <div class="col-md-10">
                        <h3 class="mb-0"><input type="text" name="playname" required class="w-100 rounded form-control" style="font-size: inherit" value="{{$playlist->name}}"></h3>
                    </div>
                    <div class="col-md-2 m-auto">
                        <button class="btn p-3 btn-primary rounded-pill border-0" style="background-color: #907bde">
                            <h4 class="mb-0 font-weight-normal">Save</h4>
                        </button>
                    </div>
                </div>
            </form>

            <div class="col-md-12">
                @php($i = 1)


                @if($playlist->songs->count())
                    <table class="table table-borderless playlist" id="top-song-list">
                        <thead>
                        <tr class="row" >
                            {{--                            <th scope="col" class="col-1">#</th>--}}
                            <th scope="col" class="col-5">Title</th>
                            <th scope="col" class="col-4">Artist</th>
                            <th scope="col" class="col-2"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($playlist->songs as $song)
                            <tr class="row" data-songid="{{$song->id}}">
                                {{--                                <td scope="col" class="col-1">{{$i}}</td>--}}
                                <td scope="col" class="col-5">{{$song->title}}</td>
                                <td scope="col" class="col-4" style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">@foreach($song->artists as $artist)
                                        <a href="artist/{{$artist->url}}">{{$artist->name}}</a>
                                        @if(!$loop->last),@endif
                                    @endforeach
                                </td>
                                <td scope="col" class="col-2">
                                    <button class="remove_from_playlist btn btn-danger" data-songid="{{$song->id}}" > <span class="font-weight-bold h5">&times;</span></button>

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <p>No Songs Available</p>
                @endif

            </div> {{--col-md-12--}}
        </div> {{--row--}}
    </div> {{--container-fluid--}}

@stop
@section('scripts')
    <script>
        $('body').on('click','.remove_from_playlist',function () {
            $.ajax({
                type: 'GET',
                url: "/removefromplay/"+$(this).data('songid')+"/"+{{$playlist->id}},
                success: function(data){
                    $('.toast').toast('hide');
                    $('.toast strong.text-white').html(data.success);
                    $('.toast').toast('show');
                }
            });
            $(this).closest('tr.row').hide();
        });
    </script>
@stop
