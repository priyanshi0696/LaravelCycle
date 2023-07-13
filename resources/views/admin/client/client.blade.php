
@extends('admin.layouts.app')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Client View') }}
            </h2>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <!-- /.content-header -->



<div class="container-fluid">
    <div class="row">

            <a href="javascript:void(0)" class="btn btn-success mb-2" id="create-new-client" style="margin-left: 1250px;">Add Client</a>


                        <table class="table table-bordered" id="laravel_crud" style="margin-top:50px;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Client Name</th>
                                    <th>ClientDescription</th>
                                    <th>ClientImage</th>
                                    <th colspan="2"><center>Action</center></th>


                                </tr>
                            </thead>

<tbody  id="posts-crud">




                            @foreach($data as $item)
                            <tr>
                                <td>{{ $item['id'] }}</td>
                                <td>{{$item['client_name']}}</td>
                                <td>{{ $item['client_description'] }}</td>
                                <td><img src="{{ asset('user/images/clientimage/'.$item['client_image'])}}" width="150" height="150"></div></td>
                                <td style="text-align: center;"><a href="javascript:void(0)" id="edit-client" data-id="{{$item['id']}}" class="btn btn-info">Edit</a></td>
                                <td style="text-align: center;">
                                 <a href="javascript:void(0)" id="delete-client" data-id="{{$item['id']}}" class="btn btn-danger delete-client">Delete</a></td>

                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>





            <div class="modal fade" id="ajax-client-modal" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="clientCrudModal"></h4>
                    </div>

                    <div class="modal-body">
                        <form id="clientForm" name="clientForm" class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            <div class="alert alert-danger print-error-msg" style="display:none">
                                <ul></ul>
                            </div>
                           <input type="hidden" name="client_id" id="client_id">
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Client Name</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="name" name="name" value="" required="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Description</label>
                                <div class="col-sm-12">
                                    <textarea name="description" class="form-control" id="description"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Image</label>
                                <div class="col-sm-12">
                                    <input  type="file" class="form-control" id="image" name="image">
                                </div>
                            </div>


                            <div class="col-sm-offset-2 col-sm-10">
                             <button type="submit" class="btn btn-primary" id="btn-save" style="background-color: blue;" value="create">Save
                             </button>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">

                    </div>
                </div>
                </div>
                </div>

    <!-- Main content -->
</div>



 <script>
    $(document).ready(function () {
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      $('#create-new-client').click(function () {
        $('#btn-save').val("create-client");
        $('#postForm').trigger("reset");
        $('#clientCrudModal').html("Add New client");
        $('#ajax-client-modal').modal('show');
    });


      $('body').on('click', '#edit-client', function () {
        var client_id = $(this).data('id');
        $.get('clientedit/' + client_id, function (data) {
           $('#clientCrudModal').html("Edit client");
            $('#btn-save').val("edit-client");
            $('#ajax-client-modal').modal('show');
            $('#client_id').val(data.id);
            $('#name').val(data.client_name);
            $('#description').val(data.client_description);
            $('#image').val(data.client_image);



           // $('#password').val(data.password);
           // $('#confirmpassword').val(data.confirmpassword);
        })
     });
     $('body').on('click', '.delete-client', function () {
        var client_id = $(this).data('id');
        var confirmation = confirm("Are you sure you want to delete?");
        if (confirmation) {

        $.ajax({
            type: "GET",
            url: "{{ route('admin.clientdelete', ':id') }}".replace(':id', client_id),
            success: function (data) {
                alert(data.success);
                location.reload();
                $("#client_id_" + client_id).remove();

            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    }
    });
});


if ($("#clientForm").length > 0) {
    $("#clientForm").submit(function (e) {
      e.preventDefault(); // Prevent the form from submitting normally

      var actionType = $('#btn-save').val();
      $('#btn-save').html('Sending..');

      $.ajax({
        url: "{{ route('admin.clientadd') }}",
        type: "POST",
        data: new FormData(this), // Use FormData to handle file uploads
        dataType: 'json',
        contentType: false,
        cache: false,
        processData: false,
        success: function (data) {
          alert(data.success);
          location.reload();

          var post = '<tr id="client_id_' + data.id + '"><td>' + data.id + '</td><td>' + data.client_name + '</td><td>' + data.client_description +  '</td>' ;
            post += '<td><img src="{{ asset('user/images/clientimage/') }}/' + data.client_image + '" width="150" height="150"></td>';
          post += '<td><a href="javascript:void(0)" id="edit-client" data-id="' + data.id + '" class="btn btn-info">Edit</a></td>';
          post += '<td><a href="javascript:void(0)" id="delete-client" data-id="' + data.id + '" class="btn btn-danger delete-client">Delete</a></td></tr>';

          if (actionType == "create-client") {
            $('#laravel_crud tbody').prepend(post); // Update the table body ID
          } else {
            $("#client_id_" + data.id).replaceWith(post);
          }

          $('#clientForm').trigger("reset");
          $('#ajax-client-modal').modal('hide');
          $('#btn-save').html('Save Changes');
        },
        error: function (data) {
          printErrorMsg(data.error);
          console.log('Error:', data);
          $('#btn-save').html('Save Changes');
        }
      });
    });
  }
  function printErrorMsg (msg) {
    $(".print-error-msg").find("ul").html('');
    $(".print-error-msg").css('display','block');
    $.each( msg, function( key, value ) {
        $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
    });
}


  </script>











  @endsection


