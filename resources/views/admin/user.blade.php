
@extends('admin.layouts.app')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('User View') }}
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

            <a href="javascript:void(0)" class="btn btn-success mb-2" id="create-new-user" style="margin-left: 1050px;">Add User</a>


                        <table class="table table-bordered" id="laravel_crud" style="margin-top:50px;">
                            <thead>
                                <tr>
                                    <th><center>No</center></th>
                                    <th><center>Name</center></th>
                                    <th><center>Email</center></th>

                                    <th colspan="2"><center>Action</center></th>
                                </tr>
                            </thead>

<tbody  id="posts-crud">




                            @foreach($data as $item)
                            <tr id="item{{$item['id']}}">
                                <td style="text-align: center;">{{$item['id']}}</td>
                                <td style="text-align: center;">{{$item['name']}}</td>
                                <td style="text-align: center;">{{$item['email']}}</td>
                                <td style="text-align: center;"><a href="javascript:void(0)" id="edit-user" data-id="{{$item['id']}}" class="btn btn-info">Edit</a></td>
                                <td style="text-align: center;">
                                 <a href="javascript:void(0)" id="delete-user" data-id="{{$item['id']}}" class="btn btn-danger delete-user">Delete</a></td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>

                </div>
            </div>

            <div class="modal fade" id="ajax-user-modal" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="userCrudModal"></h4>
                    </div>

                    <div class="modal-body">
                        <form id="userForm" name="userForm" class="form-horizontal">
                            <div class="alert alert-danger print-error-msg" style="display:none">
                                <ul></ul>
                            </div>
                           <input type="hidden" name="user_id" id="user_id">
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Name</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="name" name="name" value="" required="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Email</label>
                                <div class="col-sm-12">
                                    <input  type="text" class="form-control" id="email" name="email" value="" required="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Password</label>
                                <div class="col-sm-12">
                                    <input  type="password" class="form-control" id="password" name="password" value="" required="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">ConfirmPassword</label>
                                <div class="col-sm-12">
                                    <input  type="password" class="form-control" id="confirmpassword" name="confirmpassword" value="" required="">
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
      $('#create-new-user').click(function () {
        $('#btn-save').val("create-user");
        $('#postForm').trigger("reset");
        $('#userCrudModal').html("Add New User");
        $('#ajax-user-modal').modal('show');
    });


      $('body').on('click', '#edit-user', function () {
        var user_id = $(this).data('id');
        $.get('edit/' + user_id, function (data) {
           $('#userCrudModal').html("Edit user");
            $('#btn-save').val("edit-user");
            $('#ajax-user-modal').modal('show');
            $('#user_id').val(data.id);
            $('#name').val(data.name);
            $('#email').val(data.email);
           // $('#password').val(data.password);
           // $('#confirmpassword').val(data.confirmpassword);
        })
     });
     $('body').on('click', '.delete-user', function () {
        var user_id = $(this).data('id');
        confirm("Are you sure you want to delete?");

        $.ajax({
            type: "GET",
            url: "{{ route('admin.destroy', ':id') }}".replace(':id', user_id),
            success: function (data) {
                alert(data.success);
                location.reload();
                $("#user_id_" + user_id).remove();

            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
});


   if ($("#userForm").length > 0) {
        $("#userForm").validate({

       submitHandler: function(form) {
        var actionType = $('#btn-save').val();
        $('#btn-save').html('Sending..');

        $.ajax({
            data: $('#userForm').serialize(),
            url: "{{ route('admin.store') }}",
            type: "POST",
            dataType: 'json',
            success: function (data) {

                    alert(data.success);
                    location.reload();
                var post = '<tr id="user_id_' + data.id + '"><td>' + data.id + '</td><td>' + data.name + '</td><td>' + data.email + '</td>';
                post += '<td><a href="javascript:void(0)" id="edit-user" data-id="' + data.id + '" class="btn btn-info">Edit</a></td>';
                post += '<td><a href="javascript:void(0)" id="delete-user" data-id="' + data.id + '" class="btn btn-danger delete-post">Delete</a></td></tr>';


                if (actionType == "create-user") {
                    $('#user-crud').prepend(post);
                } else {
                    $("#user_id_" + data.id).replaceWith(post);
                }

                $('#userForm').trigger("reset");
                $('#ajax-user-modal').modal('hide');
                $('#btn-save').html('Save Changes');



            },
            error: function (data) {
                printErrorMsg(data.error);
                console.log('Error:', data);
                $('#btn-save').html('Save Changes');
            }
        });
      }
    })
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


