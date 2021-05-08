@extends('layouts.appdash')
@section('content')
<div class="card maincard">
    <div class="card-header">Edit Artist Information</div>

    <div class="card-body">

        <div class="success" role="alert">

        </div>


        <form action="/update-artist/{{$artist->id}}" method="post" id="uploadd" enctype="multipart/form-data">
            <div class="input-group row mb-3">
                <label for="title" class="col-form-label col-2">Artist Name: </label>
                <input type="text" value="{{ $artist->name }}" name="name" class="form-control col-10">

            </div>
            <div class="input-group row mb-3">
                <label for="profile_pic" class="col-form-label col-2">Profile Pic: </label>
                <div class="col-10">
                    <img src="{{ url('storage/images/artists/'.$artist->profile_pic)  }}" width="100px" alt="">
                    <input type="file" id="profile_pic" name="profile_pic">
                    <input type="hidden" id="img_hidden" name="art" value="{{ $artist->profile_pic }}">
                    <img src="" id="preview" alt="" width="100px">
                    <p class="btn btn-dark" id="clear">Clear File</p>
                </div>
            </div>
            <div class="input-group row mb-3">
                <div class="col-2">
                    <label for="artist" class="col-form-label">About Artist: </label>
                </div>
                <input type="text" name="about" value="{{$artist->about}}" class="form-control col-10">
            </div>

            <input type="hidden" class="id" value="{{$artist->id}}">
            @csrf
            <input type="submit" id="submit" class="btn btn-primary">
            <a data-toggle="modal" data-target="#delete" class="btn btn-danger text-white">Cancel</a>
        </form>

        <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Cancel Update</h5>
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
                            <a type="submit" class="btn btn-danger" href="/show-artist/{{$artist->id}}">Yes, Cancel</a>
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
            $('#profile_pic').change(function () {
                readURL(this);
            });

            $('#clear').click(function () {
                $('#profile_pic').val('');
                $('#preview').attr('src','');
            });

        }); //document.ready

    </script>


@stop
