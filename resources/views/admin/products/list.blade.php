@extends('admin.layout')
@section('list-content')
  <div class="card">
    <div class="card-body">

        <nav class="navbar  justify-content-between">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addCategoryModal">
          <i class="fas fa-plus"></i> Add Product
        </button>
            <form class="form-inline">
                <input class="form-control mr-sm-2" id="search" placeholder="Search...">
                <!-- <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button> -->
            </form>
        </nav>   
    </div>

    <div class="card-header">
      <h3 class="card-title">List product</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table id="products-table" class="table table-bordered table-striped">
        <thead >
        <tr>
          <th>Image</th>
          <th>Name</th>
          <th>Description</th>
          <th>Price</th>
          <th>Created at</th>
          <th>Action</th>
        </tr>
        </thead>
{{--         <tbody id="category-table">
       
        <tr>       
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td>
             <button class="btn btn-info" type="button" onclick="editClub('<%- club._id%>')" data-toggle="modal"  data-target="#modal-edit"><i class="fas fa-edit"></i></button>            
            <button class="btn btn-danger" type="button" onclick="deleteClub('<%- club._id%>')" data-toggle="modal"  data-target="#modal-del"><i class="fas fa-trash-alt"></i></button>
        </td>
        </tr>
       
        </tbody> --}}
      </table>
    </div>
    <!-- /.card-body -->
  </div>
      <!-- Modal Add -->
    <div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Add Category</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <form role="form" id="form-add-club" action="/clubs" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter the category name">
                  </div>
			      <div class="form-group">
			        <label>Parrent ID</label>
			        <select class="form-control" name="parent_id" value={{old('parent_id')}}>
			          <option value="">--- Select a category ---</option>

			        </select>

			      </div>  
                  <div class="form-group">
			        <label>Description</label>
			        <textarea class="form-control" rows="3" name="description" placeholder=""></textarea>
                  </div>      
                </div>       
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" id="add-button" class="btn btn-primary">Save</button>
          </div>
          </form>
        </div>
      </div>
    </div>
    <!-- Modal delete -->
    <div class="modal fade" id="modal-del">
        <div class="modal-dialog modal-sm">
            <form action="" id="deleteForm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">DELETE CONFIRM</h4>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
            <div class="modal-body">
              <p>Are you sure want to delete?</p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="submit" class="btn btn-success" data-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-danger" id="btn-delete">Yes, Delete</button>
            </div>
          </div>
         </form>
        </div>
        <!-- /.modal-dialog -->
    </div>

  <!-- Modal Edit -->
<div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content" id="edit-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Edit category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
              <form role="form" id="form-add-club" action="/clubs" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter the category name">
                  </div>
            <div class="form-group">
              <label>Parrent ID</label>
              <select class="form-control" name="parent_id" >
                <option value="">--- Select a category ---</option>

              </select>
            </div>  
                  <div class="form-group">
              <label>Description</label>
              <textarea class="form-control" rows="3" name="description" placeholder=""></textarea>
                  </div>      
                </div>       
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" id="add-button" class="btn btn-primary">Update</button>
          </div>
          </form>
    </div>
  </div>
</div>
@push('handle-product')
<script>
$(function() {
    $('#products-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('product.getData') !!}',
        columns: [
            { data: 'image', name: 'image', orderable: false, searchable: false},
            { data: 'name', name: 'name' },
            { data: 'desc', name: 'desc' },
            { data: 'price', name: 'price' },
            { data: 'created_at', name: 'created_at' },
            { data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
});

function deleteRecord(id,row_index) {
    $.ajax({
        url: "/products/delete/' + id",
        type: "DELETE",
        data: {
            "id": id,
        },
        success: function() {
            var i = row_index.parentNode.parentNode.rowIndex;
            document.getElementById("products-table").deleteRow(i);
        },
    })
}
</script>
@endpush
@endsection

