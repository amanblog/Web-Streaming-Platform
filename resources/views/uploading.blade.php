@extends('layouts.appdash')

@section('content')

<div class="card maincard">

    <div class="card-header">Edit Upload Information</div>

    <div class="card-body">

        <div class="success" role="alert">

        </div>


        <form id="uploadd" method="POST" action="/uploading" enctype="multipart/form-data">
            <div class="input-group row mb-3">
                <label for="title"  class="col-form-label col-2">Song Name: </label>
                <input type="text" id="title" value="{{ $mp3->getTitle() }}" name="title" class="form-control col-10">
                {{--                    <input type="hidden" value="{{$mp3}}" name="mp3">--}}
            </div>
            <div class="input-group row mb-3">
                <label for="album_art" class="col-form-label col-2">Picture: </label>
                <div class="col-10">
                    <img src="{{ $art }}" width="100px" alt="">
                    <input type="file" id="album_art" name="album_art">
                    <input type="hidden" id="img_hidden" name="art" value="{{ $art }}">
                    <img src="" id="preview" alt="" width="100px">
                    <p class="btn btn-dark" id="clear">Clear File</p>
                </div>
            </div>
            <div class="input-group row mb-3">
                <div class="col-2">
                    <label for="artist" class="col-form-label">Artist Name: </label>
                    <p class="small">(Separate Artists by comma ',')</p>
                </div>
                <input type="text"  name="artist" value="{{ $mp3->getArtist() }}" class="form-control col-10">
            </div>

            <div class="input-group row mb-3">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" name="is-single" id="is-single">
                    <label class="custom-control-label" for="is-single">This is a single.</label>
                </div>
                <label for="album" class="col-form-label col-2">Album Name: </label>
                <input type="text" id="album" name="album" value="{{ $mp3->getAlbum() }}" class="form-control col-10">
            </div>
            <div class="input-group row mb-3">
                <label for="year" class="col-form-label col-2">Year: </label>
                <input type="number" value="{{ $mp3->getYear() }}" name="year" maxlength="4" class="form-control col-10">
            </div>
            <div class="input-group row mb-3">
                <label for="explicit" class="col-form-label col-2">Explicit: </label>
                <select name="explicit" class="custom-select col-10">
                    <option value="0">No</option>
                    <option value="1">Yes</option>
                </select>
            </div>
            <div class="input-group row mb-3">
                <label for="genre" class="col-form-label col-2">Genres: </label>
                <select class="genre-list custom-select col-10" name="genres[]" multiple="multiple" >
{{--                    <option value="AL">Alabama</option>--}}
{{--                    <option value="WY">Wyoming</option>--}}
                    @foreach($genres as $genre)
                        <option value="{{$genre->id}}">{{$genre->name}}</option>
                    @endforeach
                </select>
            </div>
            <input type="hidden" value="{{$path}}" name="songFile">
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
                        <form action="/cancel-upload" method="post">
                            {{method_field('delete')}}
                            {{csrf_field()}}
                            <div class="modal-body">
                                <p class="text-center">
                                    Are you sure you want to cancel?
                                </p>
                                <input type="hidden" name="path" value="{{$path}}">

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-success" data-dismiss="modal">No, Cancel</button>
                                <button type="submit" class="btn btn-danger">Yes, Delete</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div> <!--Modal Closes-->

    </div>
</div>

@endsection

@section('scripts')

    <script>
        $(document).ready(function() {
            $('.genre-list').select2();
        });
        $(document).ready(function() {

        $('#is-single').on('change', function () {
            if($(this).is(":checked") == true){
                console.log("check");
                $('#album').val($('#title').val());
                $('#album').attr('readonly', 'readonly')
            }
            else{
                $('#album').val("");
                $('#album').removeAttr('readonly');
            }
        });

        });
    </script>
@endsection
