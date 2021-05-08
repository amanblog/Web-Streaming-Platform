@extends('layouts.appdash')
@section('content')

    <div class="card maincard">
        <div class="card-header">Edit Upload Information</div>

        <div class="card-body">

            <div class="success" role="alert">

            </div>


            <form action="/update/{{$song->id}}" method="post" id="uploadd" enctype="multipart/form-data">
                <div class="input-group row mb-3">
                    <label for="title" class="col-form-label col-2">Song Name: </label>
                    <input type="text" value="{{ $song->title }}" name="title" class="form-control col-10">

                </div>
                <div class="input-group row mb-3">
                    <label for="album_art" class="col-form-label col-2">Picture: </label>
                    <div class="col-10">
                        <img src="{{ url('storage/images/'.$song->album_art)  }}" width="100px" alt="">
                        <input type="file" id="album_art" name="album_art">
                        <input type="hidden" id="img_hidden" name="art" value="{{ $song->album_art }}">
                        <img src="" id="preview" alt="" width="100px">
                        <p class="btn btn-dark" id="clear">Clear File</p>
                    </div>
                </div>
                <div class="input-group row mb-3">
                    <div class="col-2">
                        <label for="artist" class="col-form-label">Artist Name: </label>
                        <p class="small">(Separate Artists by comma ',')</p>
                    </div>
                    <input type="text" name="artist" value="@foreach($song->artists as $artist){{$artist->name}}@if(!$loop->last),@endif @endforeach" class="form-control col-10">
                </div>

                <div class="input-group row mb-3">
                    <label for="album" class="col-form-label col-2">Album Name: </label>
                    <input type="text" name="album" value="{{ $song->album }}" class="form-control col-10">
                </div>
                <div class="input-group row mb-3">
                    <label for="year" class="col-form-label col-2">Year: </label>
                    <input type="number" value="{{ $song->year }}" name="year" maxlength="4" class="form-control col-10">
                </div>
                <div class="input-group row mb-3">
                    <label for="explicit" class="col-form-label col-2">Explicit: </label>
                    <select name="explicit" class="custom-select col-10">
                        <option value="0" @if($song->explicit==0) selected @endif>No</option>
                        <option value="1" @if($song->explicit==1) selected @endif>Yes</option>
                    </select>
                </div>
                <div class="input-group row mb-3">
                    <label for="genre" class="col-form-label col-2">Genres: </label>
                    <select class="genre-list custom-select col-10" name="genres[]" multiple="multiple" >
                        {{--                    <option value="AL">Alabama</option>--}}
                        {{--                    <option value="WY">Wyoming</option>--}}
                        @foreach($genres as $genre)
                            <option value="{{$genre->id}}" @foreach($song->genres as $genre_s) @if($genre->id==$genre_s->id) selected @endif @endforeach>{{$genre->name}}</option>
                        @endforeach
                    </select>
                </div>
                <input type="hidden" class="id" value="{{$song->id}}">
                @csrf
                <input type="submit" id="submit" class="btn btn-primary">
                <a data-toggle="modal" data-target="#delete" class="btn btn-danger text-white">Cancel</a>
            </form>

            <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Delete Comment</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="modal-body">
                                <p class="text-center">
                                    Are you sure you want to cancel?
                                </p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-success" data-dismiss="modal">No, Cancel</button>
                                <a type="submit" class="btn btn-danger" href="/songs">Yes, Delete</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div> <!--Modal Closes-->

        </div>
    </div>

@stop
@section('scripts')
    <script>

        $(document).ready(function() {
            $('.genre-list').select2();
        });

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
            $('#album_art').change(function () {
                readURL(this);
            });

            $('#clear').click(function () {
                $('#album_art').val('');
                $('#preview').attr('src','');
            });

        }); //document.ready
    </script>

@stop
