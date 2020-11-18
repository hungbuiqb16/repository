@extends('admin.layout')
@section('content')

<div class="card card-primary">
  <div class="card-header">
    <h3 class="card-title">Add product</h3>
  </div>
  <!-- /.card-header -->
  <!-- form start -->
  <form role="form" method="post" action="{{ route('product.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="card-body">
      <div class="form-group">
        <label for="exampleInputEmail1">Name</label>
        <input type="text" class="form-control" name="name" value="{{old('name')}}" placeholder="Enter product name">
        @error('name')
            <div class="error" style="color: red">{{$message}}</div>
        @enderror
      </div>
{{--       <div class="form-group">
       <label class="col-form-label" for="inputType">Type</label>
        <div class="form-check">
          <input class="form-check-input" id="radio1" type="radio" name="type" value="1" {{ old('type')== "1" ? 'checked' : '' }}>
          <label class="form-check-label">Type 1</label>
        </div>
        <input type="text" class="form-control" name="type1" id="type1" style="display: none" placeholder="Enter product type">
        <div class="form-check">
          <input class="form-check-input" id="radio2" type="radio" name="type" value="2" {{ old('type')== "2" ? 'checked' : '' }}>
          <label class="form-check-label">Type 2</label>
        </div>
        <input type="text" class="form-control" name="type2" id="type2" style="display: none" placeholder="Enter product type">
        @error('type')
            <div class="error" style="color: red">{{$message}}</div>
        @enderror
      </div> --}}

        <div class="form-group">
            <label>Type</label>
            <select class="form-control" name="type" id="type-select">
                <option value="">-- Select type --</option>
                <option value="1" {{old('type') == '1' ? 'selected' : ''}} id="option1">Type 1</option>
                <option value="2" {{old('type') == '2' ? 'selected' : ''}} id="option2">Type 2</option>
            </select>
            <input type="text" class="form-control mt-2" name="type1" id="type1" style="display: none" placeholder="Enter product type">              
            <input type="text" class="form-control mt-2" name="type2" id="type2" style="display: none" placeholder="Enter product type">                
        @error('type')
            <div class="error" style="color: red">{{$message}}</div>
        @enderror
        </div>

      <div class="form-group">
        <label for="exampleInputPassword1">Price</label>
        <input type="text" class="form-control" name="price" value="{{old('price')}}" placeholder="Enter product price">
        @error('price')
          <div class="error" style="color: red">{{$message}}</div>
        @enderror
      </div>
        <div class="form-group">
          <label>Select category</label>
          <select class="select2" multiple="multiple" name="category_id[]" data-placeholder="Select a State" style="width: 100%;">
          @foreach($categories as $category)
                <option value="{{ $category['id']}}"> {{ $category['name']}}</option>      

          @endforeach           
          </select>
        @error('category_id')
          <div class="error" style="color: red">{{$message}}</div>
        @enderror
        </div>
        <div class="form-group">
            <label>Description</label>
            <textarea class="form-control" rows="3" name="desc"  placeholder="Enter description">{{old('desc')}}</textarea>
        @error('desc')
          <div class="error" style="color: red">{{$message}}</div>
        @enderror
        </div>
        {{-- Main image upload --}}
        <div class="form-group">
            <label for="exampleInputFile">Image</label>
            <div class="input-group">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="main-img">
                    <label class="custom-file-label">Choose image</label>
                </div>  
            </div>
            <div class="input-group mt-3">
                <div id="main-img-preview"></div>
            </div>
        </div>
        {{-- /end main image upload --}}
        {{-- Multi image upload     --}}
        <div class="form-group">
            <label for="exampleInputFile">Other images</label>
            <div class="input-group">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" multiple id="multi-img">
                    <label class="custom-file-label">Choose image</label>
                </div>
{{--                <div class="input-group-append">
                    <button class="btn btn-danger" type="button"><i class="fas fa-times"></i> Remove</button>
                </div> --}}
            </div>
            <div class="input-group mt-3">
                <div id="multi-img-preview"></div>
            </div>
        </div>
    </div>
    <!-- /.card-body -->

    <div class="card-footer">
      <button type="submit" class="btn btn-primary">Create</button>
    </div>
  </form>
</div>
@push('handle-product')
   <script src="dist/js/handle-product.js"></script>
@endpush()
@endsection