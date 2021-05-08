@extends('layouts.appdash')
@section('content')
    <div class="card maincard">
{{--        <div class="success"></div>--}}
        <div class="card-header">All Songs</div>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Artist</th>
                <th scope="col">Album</th>
                <th scope="col"></th>

            </tr>
            </thead>
            <tbody>
            <?php $i=1; ?>
            @foreach($songs as $song)
                <tr>
                    <th scope="row">{{$i}}</th>
                    <td class="id d-none">{{$song->id}}</td>
                    <td class="song-title"><a href="show/{{$song->id}}">{{$song->title}}</a></td>
                    <td>@foreach($song->artists as $artist){{$artist->name}}@if($loop->last)@else,@endif @endforeach
                    </td>
                    <td>{{$song->album}}</td>
                    <td>
                        <a class="btn btn-primary w-100" href="/edit/{{$song->id}}">Edit</a>
                        <button class="btn btn-danger w-100 mt-1" data-toggle="modal" data-target="#delete">Delete</button>
                    </td>
                </tr>
                <?php $i++; ?>
            @endforeach
            </tbody>
        </table>
        <div class="center-text">
            {!! $songs->links(); !!}
        </div>
    </div>


    <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Delete Song</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p></p>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success" data-dismiss="modal">No, Cancel</button>
                            <button class="delete-btn btn btn-danger" data-id="" data-token="{{csrf_token()}}">Yes, Delete</button>
                        </div>
                </div>
            </div>
        </div>
    </div> <!--Modal Closes-->
@stop

@section('scripts')
    <script>
        $(document).ready(function () {
            $('.btn-danger').click(function() {
                var song = $(this).parent().prevAll('.song-title').html();
                $('.modal-body p').html("Are you sure you want to delete <b>"+song+"</b>?");
                $('.delete-btn').data('id',$(this).parent().prevAll('.id').html());
                console.log($('.delete-btn').data('id'));
            });

            $('.delete-btn').on('click',function (event) {

                var id = $('.delete-btn').data('id');
                var token = $('.delete-btn').data('token');
                console.log(id);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({

                    url: '/delete/'+id,
                    type: 'delete',
                    data: {'id': id, '_token':token,'_method':'DELETE'},
                    success: function(data){
                        $('.modal-body p').html("<span class='text-success'>The song has been successfully deleted!</span>");
                        setTimeout(location.reload.bind(location),1000);

                    }
                });
                // event.preventDefault();
            });

        });
    </script>
@stop
