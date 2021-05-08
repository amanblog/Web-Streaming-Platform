@extends('layouts.appdash')
@section('content')

<div class="card maincard">

    <div class="card-header">List of Genres</div>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col"></th>

        </tr>
        </thead>
        <tbody>
        <div class="row p-2">
            <div class="col-12 pl-0">
                <button class=" add-genre btn btn-primary w-100">+ Add a new genre</button>
            </div>
            <div class="col-12">
                <form action="genre-csv" method="post" enctype="multipart/form-data">
                    <div class="custom-file">
                        <span>Or upload genres by uploading CSV</span>
                        @csrf
                        <input type="file" class="custom-file-input" name="genre-csv" accept=".csv">
                        <label class="custom-file-label" for="genre-csv">Or upload genres by uploading CSV</label>
                        <button type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
        <?php $i=1; ?>
        @foreach($genres as $genre)
            <tr>
                <th scope="row">{{$i}}</th>
                <td class="id d-none">{{$genre->id}}</td>
                <td class="genre-name"><a href="#">{{$genre->name}}</a></td>
                <td class="btns">
                    <button class="btn btn-primary edit-button">Edit</button>
                    <button class="btn btn-danger g-delete" data-toggle="modal" data-target="#delete">Delete</button>
                </td>
            </tr>
            <?php $i++; ?>
        @endforeach

        <tr class="new-genre">

        </tr>
        </tbody>
    </table>


    <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Delete Genre</h5>
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
</div>
@stop
@section('scripts')
    <script>
        $('body').on('click', '.add-genre', function (e) {
            $('.new-genre').html('<th scope="row"></th><td class="d-none"></td><td><form id="new-genre" method="POST" action="/genres">{{csrf_field()}}<input type="text" name="name" class="form-control"><button class="btn btn-success form-control" type="submit">Save</button></form></td><td><button class="btn btn-danger cancel ml-1">Cancel</button></td>');
            $('input[name=name]').focus();
        });

        $('body').on('click', '.cancel', function (e) {
            $('.new-genre').html("");
        });

        $('body').on('click', '.edit-button', function (e) {
            var gname = $(this).parent().prevAll('.genre-name').children('a').html();
            var gid = $(this).parent().prevAll('.id').html();
            $(this).parent().addClass('d-none');
            $(this).parent().prevAll('.genre-name').html('<form id="update-genre" method="POST" action="/updateGenre/'+gid+'">{{csrf_field()}}<input type="text" name="name" value="'+gname+'"><button class="btn btn-success" type="submit">Save</button></form><button class="btn btn-danger cancelu" data-gen="'+gname+'">Cancel</button>')
        });

        $('body').on('click', '.cancelu', function (e) {
            $(this).parent().nextAll('.btns').addClass('table-cell').removeClass('d-none');
            $(this).parent().html("<a href=\"#\">"+$(this).data('gen')+"</a>");
            // $('.new-genre').html("<a href=\"#\">"+$(this).data('gen')+"</a>");
        });


        $('body').on('click','.g-delete',function() {
            var genre = $(this).parent().prevAll('.genre-name').children('a').html();
            $('.modal-body p').html("Are you sure you want to delete <b>"+genre+"</b>?");
            $('.delete-btn').data('id',$(this).parent().prevAll('.id').html());

        });

        $('.delete-btn').on('click',function (event) {

            var id = $(this).data('id');
            var token = $(this).data('token');
            console.log(id);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({

                url: '/delete-genre/'+id,
                type: 'delete',
                data: {'id': id, '_token':token,'_method':'DELETE'},
                success: function(data){
                    if (data.success == null){
                        $('.modal-body p').html("<span class='text-danger'>" + data.failure + "</span>");
                        console.log(data.failure);
                    }
                    else {
                        $('.modal-body p').html("<span class='text-success'>" + data.success + "</span>");
                        setTimeout(location.reload.bind(location),1000);
                    }
                }
            });
        });

    </script>

@stop
