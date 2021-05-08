@extends('layouts.appuser')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card p-4">
                <p class="font-weight-bold">Name: <span class="user-name font-weight-normal">{{Auth::user()->name}}</span></p>
                <p class="font-weight-bold">Email: <span class="user-email font-weight-normal">{{Auth::user()->email}}</span></p>
            </div>
        </div>
    </div>

</div>
@stop
