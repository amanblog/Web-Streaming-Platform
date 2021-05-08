@extends('layouts.appdash')
@section('content')
    <div class="card maincard">
        <div class="card-header">All Artists</div>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col"></th>
                <th scope="col">Name</th>
                <th scope="col"></th>

            </tr>
            </thead>
            <tbody>
            <?php $i=1; ?>
            @foreach($artists as $artist)
                <tr>
                    <th scope="row">{{$i}}</th>
                    <td class="id d-none">{{$artist->id}}</td>
                    <td class="dp"><img src="{{ url('storage/images/artists/'.$artist->profile_pic)  }}" height="80px" alt=""></td>
                    <td class="song-title"><a href="/show-artist/{{$artist->id}}">{{$artist->name}}</a></td>
                    <td>
                        <a class="btn btn-primary w-100" href="/edit-artist/{{$artist->id}}">Edit</a>
                    </td>
                </tr>
                <?php $i++; ?>
            @endforeach
            </tbody>
        </table>
        <div class="center-text">
            {!! $artists->links(); !!}
        </div>
    </div>


@stop
