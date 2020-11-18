@extends('admin.layout')
@section('list-content')
  <div class="card">
    <div class="card-body">

        <nav class="navbar  justify-content-between">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addCategoryModal">
          <i class="fas fa-plus"></i> Add Category
        </button>
            <form class="form-inline">
                <input class="form-control mr-sm-2" id="search" placeholder="Search...">
                <!-- <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button> -->
            </form>
        </nav>   
    </div>

    <div class="card-header">
      <h3 class="card-title">List category</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead >
        <tr>
          <th>Name</th>
          <th>Description</th>
          <th>Action</th>
        </tr>
        </thead>
        <tbody id="category-table">
        @foreach($categories as $value)
        <tr>       
          <td>{{$value->name}}</td>
          <td>{{$value->description}}</td>
          <td>
             <button class="btn btn-info" type="button" onclick="editClub('<%- club._id%>')" data-toggle="modal"  data-target="#modal-edit"><i class="fas fa-edit"></i></button>            
            <button class="btn btn-danger" type="button" onclick="deleteClub('<%- club._id%>')" data-toggle="modal"  data-target="#modal-del"><i class="fas fa-trash-alt"></i></button>
        </td>
        </tr>
        @endforeach
        </tbody>
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
			          @foreach($categories as $category)
			                <option value="{{ $category->id}}">{{ $category->name}}</option>
			               
			                    @foreach($category->childrenRecursive as $first_child)
			                        <option value="{{ $first_child->id}}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $first_child->name}}</option>    
			                    @endforeach()
			    
			          @endforeach
			        </select>
			        @error('parent_id')
			        <div  class="error" style="color: red">{{$message}}</div>
			        @enderror
			      </div>  
                  <div class="form-group">
			        <label>Description</label>
			        <textarea class="form-control" rows="3" name="description" placeholder="{{old('description')}}"></textarea>
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
              <select class="form-control" name="parent_id" value={{old('parent_id')}}>
                <option value="">--- Select a category ---</option>
                @foreach($categories as $category)
                      <option value="{{ $category->id}}">{{ $category->name}}</option>
                     
                          @foreach($category->childrenRecursive as $first_child)
                              <option value="{{ $first_child->id}}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $first_child->name}}</option>    
                          @endforeach()
          
                @endforeach
              </select>
              @error('parent_id')
              <div  class="error" style="color: red">{{$message}}</div>
              @enderror
            </div>  
                  <div class="form-group">
              <label>Description</label>
              <textarea class="form-control" rows="3" name="description" placeholder="{{old('description')}}"></textarea>
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
@endsection