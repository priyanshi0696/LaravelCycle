
@extends('admin.layouts.app')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Product View') }}
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
        <div class="col-12">
            <a href="javascript:void(0)" class="btn btn-success mb-2" id="create-new-product" style="margin-left: 1250px;">Add Product</a>


                        <table class="table table-bordered" id="laravel_crud" style="margin-top:50px;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>ProductTitle</th>
                                    <th>ProductDescription</th>
                                    <th>ProductImage</th>
                                    <th>ProductPrice</th>
                                    <th colspan="2"><center>Action</center></th>

                                </tr>
                            </thead>

<tbody  id="posts-crud">




                            @foreach($data as $item)
                            <tr>
                                <td>{{ $item['id'] }}</td>
                                <td>{{$item['product_title']}}</td>
                                <td>{{ $item['product_description'] }}</td>
                                <td><img src="{{ asset('user/images/productimage/'.$item['image'])}}" width="150" height="150"></div></td>
                                <td>${{$item['price']}}</td>
                                <td style="text-align: center;"><a href="javascript:void(0)" id="edit-product" data-id="{{$item['id']}}" class="btn btn-info">Edit</a></td>
                                <td style="text-align: center;">
                                 <a href="javascript:void(0)" id="delete-product" data-id="{{$item['id']}}" class="btn btn-danger delete-product">Delete</a></td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>




            <div class="modal fade" id="ajax-product-modal" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="productCrudModal"></h4>
                    </div>

                    <div class="modal-body">
                        <form id="productForm" name="productForm" class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            <div class="alert alert-danger print-error-msg" style="display:none">
                                <ul></ul>
                            </div>
                           <input type="hidden" name="product_id" id="product_id">
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
                            <div class="form-group">
                                <label for="price" class="col-sm-2 control-label">Price</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="price" name="price">
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
      $('#create-new-product').click(function () {
        $('#btn-save').val("create-product");
        $('#postForm').trigger("reset");
        $('#productCrudModal').html("Add New product");
        $('#ajax-product-modal').modal('show');
    });


      $('body').on('click', '#edit-product', function () {
        var product_id = $(this).data('id');
        $.get('productedit/' + product_id, function (data) {
           $('#productCrudModal').html("Edit product");
            $('#btn-save').val("edit-product");
            $('#ajax-product-modal').modal('show');
            $('#product_id').val(data.id);
            $('#title').val(data.product_title);
            $('#description').val(data.product_description);
            $('#price').val(data.price);


           // $('#password').val(data.password);
           // $('#confirmpassword').val(data.confirmpassword);
        })
     });
     $('body').on('click', '.delete-product', function () {
        var product_id = $(this).data('id');
        var confirmation = confirm("Are you sure you want to delete?");
        if (confirmation) {
        $.ajax({
            type: "GET",
            url: "{{ route('admin.productdelete', ':id') }}".replace(':id', product_id),
            success: function (data) {
                alert(data.success);
                location.reload();
                $("#product_id_" + product_id).remove();

            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    }
    });
});


if ($("#productForm").length > 0) {
    $("#productForm").submit(function (e) {
      e.preventDefault(); // Prevent the form from submitting normally

      var actionType = $('#btn-save').val();
      $('#btn-save').html('Sending..');

      $.ajax({
        url: "{{ route('admin.productadd') }}",
        type: "POST",
        data: new FormData(this), // Use FormData to handle file uploads
        dataType: 'json',
        contentType: false,
        cache: false,
        processData: false,
        success: function (data) {
          alert(data.success);
          location.reload();

          var post = '<tr id="product_id_' + data.id + '"><td>' + data.id + '</td><td>' + data.product_title + '</td><td>' + data.product_description + '</td><td>' + data.price + '</td>';
          post += '<td><a href="javascript:void(0)" id="edit-product" data-id="' + data.id + '" class="btn btn-info">Edit</a></td>';
          post += '<td><a href="javascript:void(0)" id="delete-product" data-id="' + data.id + '" class="btn btn-danger delete-product">Delete</a></td></tr>';

          if (actionType == "create-product") {
            $('#laravel_crud tbody').prepend(post); // Update the table body ID
          } else {
            $("#product_id_" + data.id).replaceWith(post);
          }

          $('#productForm').trigger("reset");
          $('#ajax-product-modal').modal('hide');
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


