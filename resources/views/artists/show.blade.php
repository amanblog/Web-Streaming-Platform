@extends('layouts.appdash')
@section('content')
    <div class="row">
        <div class="col-md-6">
            <h3>{{$artist->name}}</h3>
            <p><strong>About: </strong>@if($artist->about == "") No info available about artist @else {{$artist->about}} @endif</p>

            <a class="btn btn-primary" href="/edit-artist/{{$artist->id}}">Edit</a>
        </div>
        <div class="col-md-6">
            <img src="{{ url('storage/images/artists/'.$artist->profile_pic)  }}" alt="{{$artist->name}}_profile_pic" class="img-fluid" width="250px">
        </div>
    </div>



@stop
