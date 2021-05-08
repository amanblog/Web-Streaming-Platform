@extends('layouts.appuser')
@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h3>All Playlist</h3>
            </div>

            <div class="col-md-12">
                @if($playlists->count())
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Last</th>
                            <th scope="col">Handle</th>
                        </tr>
                        </thead>
                        <tbody>


                    @foreach($playlists as $playlist)
                        <tr>
                            <td><a href="playlist/{{$playlist->url}}">{{$playlist->name}}</a></td>
                            <td><button class="btn btn-danger">Delete</button></td>
                            <td></td>
                        </tr>
                    @endforeach
                        </tbody>
                    </table>
                @else
                    <p>No Playlists Available!
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#playlistmodal">
                            Create
                        </button></p>
                @endif
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#playlistmodal">
                        Create New Playlist
                    </button>
            </div>

        </div> {{--row--}}
    </div> {{--container-fluid--}}

    <div class="modal" tabindex="-1" role="dialog" id="playlistmodal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create Playlist</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form action="/playlist" method="post" enctype="multipart/form-data">
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="play_name">Playlist name</label>
                                <input type="text" name="play_name" class="form-control" id="play_name" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="play_img">Image (Optional)</label>
                                <input type="file" name="play_img" class="form-control" id="play_img" accept="image/*">
                            </div>
                            <div class="col-md-6 offset-md-6">
                                <img src="" alt="" id="preview" width="100px">
                            </div>
                            @csrf
                        </div>
                        <button class="btn btn-primary" type="submit">Create</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

@stop

@section('scripts')
    <script>
        function readURL(input) {
            if(input.files && input.files[0]){
                reader = new FileReader();

                reader.onload = function(e) {
                    $('#preview').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $('document').ready(function () {
            $('#play_img').change(function () {
                readURL(this);
            });

            $('button.btn-danger').click(function (e) {
                console.log($(this).closest("tr").find('[href]').attr('href').split('/')[1]);
            })


        }); //document.ready
    </script>

@stop
