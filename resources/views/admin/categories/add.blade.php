@extends('admin.layout')
@section('content')
<div class="card card-primary">
  <div class="card-header">
    <h3 class="card-title">Add category</h3>
  </div>
  <form role="form" action="{{route('category.store')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="card-body">
      <div class="form-group">
        <label>Name</label>
        <input type="text" class="form-control" name="name" value="{{old('name')}}" placeholder="Enter category name">
        @error('name')
        <div class="error" style="color: red">{{$message}}</div>
        @enderror
      </div>
      <div class="form-group">
        <label>Parrent ID</label>
        <select class="form-control" name="parent_id" value={{old('parent_id')}}>
          <option value="">--- Select a category ---</option>
          @foreach($categories as $category)
                <option value="{{ $category->id}}">{{ $category->name}}</option>
               
                    @foreach($category->childrenRecursive as $first_child)
                        <option value="{{ $first_child->id}}">--{{ $first_child->name}}</option>    
                    @endforeach()
    
          @endforeach
        </select>
        @error('parent_id')
        <div  class="error" style="color: red">{{$message}}</div>
        @enderror
      </div>     
      <div class="form-group">
        <label>Description</label>
        <textarea class="form-control" rows="3" name="description" placeholder="Enter the description">{{old('description')}}</textarea>
        @error('description')
        <div  class="error" style="color: red">{{$message}}</div>
        @enderror
      </div>
    </div>
    <div class="card-footer">
      <button type="submit" class="btn btn-primary">Create</button>
    </div>
  </form>
</div>
@endsection