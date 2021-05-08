@extends('layouts.appdash')

@section('content')

    <div class="card maincard">
        <div class="card-header">Dashboard</div>

        <div class="card-body">
            <div class="success" role="alert">

            </div>

            <form action="upload" method="post" id="songform" enctype="multipart/form-data">
                <label for="audFile" class="col-form-label">Select Audio: </label>
                <div class="custom-file mb-3">
                    <input type="file" class="custom-file-input" id="audFile" name="audFile" accept="audio/*">
                    <label class="custom-file-label" for="audFile">Choose file</label>
                    <div class="error"></div>
                </div>

                <!-- <input type="file" class="form-control-file" id="audFile" name="audFile[]" multiple> -->
                @csrf
                <input type="submit" class="btn btn-dark">
            </form>

        </div>
    </div>

@endsection
@section('scripts')
    <script>
        $(".custom-file-input").on("change", function() {
            $('.error').html('<span class="invalid-feedback" role="alert" style="display: none"><strong>Please select a file!</strong></span>');
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
        $('#songform').submit(function (event) {

            if($('.custom-file-input').val()){

                $('#songform').submit();
            }
            else{
                event.preventDefault();
                $('.error').html('<span class="invalid-feedback" role="alert" style="display: block"><strong>Please select a file!</strong></span>');
            }

        });

    </script>

@stop
