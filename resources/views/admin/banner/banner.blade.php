
@extends('admin.layouts.app')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Banner View') }}
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

            <a href="javascript:void(0)" class="btn btn-success mb-2" id="create-new-banner" style="margin-left: 1250px;">Add Banner</a>


                        <table class="table table-bordered" id="laravel_crud" style="margin-top:50px;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>BannerTitle</th>
                                    <th>BannerDescription</th>
                                    <th>BannerImage</th>
                                    <th colspan="2"><center>Action</center></th>

                                </tr>
                            </thead>

<tbody  id="posts-crud">




                            @foreach($data as $item)
                            <tr>
                                <td>{{ $item['id'] }}</td>
                                <td>{{$item['banner_title']}}</td>
                                <td>{{ $item['banner_description'] }}</td>
                                <td><img src="{{ asset('user/images/bannerimage/'.$item['banner_image'])}}" width="150" height="150"></div></td>
                                <td style="text-align: center;"><a href="javascript:void(0)" id="edit-banner" data-id="{{$item['id']}}" class="btn btn-info">Edit</a></td>
                                <td style="text-align: center;">
                                 <a href="javascript:void(0)" id="delete-banner" data-id="{{$item['id']}}" class="btn btn-danger delete-banner">Delete</a></td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

            </div>


            <div class="modal fade" id="ajax-banner-modal" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="bannerCrudModal"></h4>
                    </div>

                    <div class="modal-body">
                        <form id="bannerForm" name="bannerForm" class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            <div class="alert alert-danger print-error-msg" style="display:none">
                                <ul></ul>
                            </div>
                           <input type="hidden" name="banner_id" id="banner_id">
                            <div class="form-group">
                                <label for="title" class="col-sm-2 control-label">Title</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="title" name="title" value="" required="">
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
      $('#create-new-banner').click(function () {
        $('#btn-save').val("create-banner");
        $('#postForm').trigger("reset");
        $('#bannerCrudModal').html("Add New Banner");
        $('#ajax-banner-modal').modal('show');
    });


      $('body').on('click', '#edit-banner', function () {
        var banner_id = $(this).data('id');
        $.get('banneredit/' + banner_id, function (data) {
           $('#bannerCrudModal').html("Edit banner");
            $('#btn-save').val("edit-banner");
            $('#ajax-banner-modal').modal('show');
            $('#banner_id').val(data.id);
            $('#title').val(data.banner_title);
            $('#description').val(data.banner_description);
           $('#image').val(data.banner_image);
           // $('#password').val(data.password);
           // $('#confirmpassword').val(data.confirmpassword);
        })
     });
     $('body').on('click', '.delete-banner', function () {
        var banner_id = $(this).data('id');
        var confirmation = confirm("Are you sure you want to delete?");
        if (confirmation) {
        $.ajax({
            type: "GET",
            url: "{{ route('admin.bannerdelete', ':id') }}".replace(':id', banner_id),
            success: function (data) {
                alert(data.success);
                location.reload();
                $("#banner_id_" + banner_id).remove();

            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    }
    });
});


if ($("#bannerForm").length > 0) {
    $("#bannerForm").submit(function (e) {
      e.preventDefault(); // Prevent the form from submitting normally

      var actionType = $('#btn-save').val();
      $('#btn-save').html('Sending..');

      $.ajax({
        url: "{{ route('admin.banneradd') }}",
        type: "POST",
        data: new FormData(this), // Use FormData to handle file uploads
        dataType: 'json',
        contentType: false,
        cache: false,
        processData: false,
        success: function (data) {
          alert(data.success);
          location.reload();

          var post = '<tr id="banner_id_' + data.id + '"><td>' + data.id + '</td><td>' + data.banner_title + '</td><td>' + data.banner_description + '</td>';
          post += '<td><a href="javascript:void(0)" id="edit-banner" data-id="' + data.id + '" class="btn btn-info">Edit</a></td>';
          post += '<td><a href="javascript:void(0)" id="delete-banner" data-id="' + data.id + '" class="btn btn-danger delete-banner">Delete</a></td></tr>';

          if (actionType == "create-banner") {
            $('#laravel_crud tbody').prepend(post); // Update the table body ID
          } else {
            $("#banner_id_" + data.id).replaceWith(post);
          }

          $('#bannerForm').trigger("reset");
          $('#ajax-banner-modal').modal('hide');
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


