@extends('dashboard.layouts.main')

@section('container')

<div class="container-fluid py-4">
    <div class="row">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header pb-0">
            <div class="d-flex align-items-center">
              <p class="mb-0">Add Category</p>
            </div>
        </div>
        <form method="POST" action="/dashboard/products/{{ $product->slug }}" enctype="multipart/form-data">
            @method('put')
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="example-text-input" class="form-control-label">Name</label>
                        <input class="form-control @error('name') is-invalid @enderror" type="text" value="{{ old('name', $product->name) }}" name="name">
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>  
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="example-text-input" class="form-control-label">Description</label>
                        <input class="form-control @error('description') is-invalid @enderror" type="text" value="{{ old('description',$product->description) }}" name="description">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="example-text-input" class="form-control-label">price</label>
                      <input class="form-control @error('price') is-invalid @enderror" type="number" value="{{ old('price', $product->price) }}" name="price">
                      @error('price')
                          <div class="invalid-feedback">
                              {{ $message }}
                          </div>  
                      @enderror
                    </div>
                    <div class="form-group col-md-6">
                      <label for="example-text-input" class="form-control-label ">Stock</label>
                      <input class="form-control @error('stock') is-invalid @enderror" type="number" value="{{ old('stock', $product->stock) }}" name="stock">
                      @error('stock')
                          <div class="invalid-feedback">
                              {{ $message }}
                          </div>  
                      @enderror
                    </div>

                    <div class="form-group col-md-6">
                      <label for="example-text-input" class="form-control-label ">Status</label><br>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input @error('status') is-invalid @enderror" type="radio" name="status" id="inlineRadio1" value="active" {{ $product->status == "active" ? 'checked' : '' }}/>
                        <label class="form-check-label" for="inlineRadio1">Active</label>
                      </div>
                      
                      <div class="form-check form-check-inline">
                        <input class="form-check-input @error('status') is-invalid @enderror" type="radio" name="status" id="inlineRadio2" value="inactive" {{ $product->status == "inactive" ? 'checked' : '' }}/>
                        <label class="form-check-label" for="inlineRadio2">Inactive</label>
                      </div>
                    </div>

                    <div class="form-group col-md-6">
                      <label for="example-text-input" class="form-control-label ">Favorite</label><br>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input @error('is_favorite') is-invalid @enderror" type="radio" name="is_favorite" id="is_favorite1" value="yes" {{ $product->is_favorite == 'yes' ? 'checked' : '' }}/>
                        <label class="form-check-label" for="is_favorite1">Yes</label>
                      </div>
                      
                      <div class="form-check form-check-inline">
                        <input class="form-check-input @error('is_favorite') is-invalid @enderror" type="radio" name="is_favorite" id="is_favorite2" value="no" {{ $product->is_favorite == 'no' ? 'checked' : '' }}/>
                        <label class="form-check-label" for="is_favorite2">No</label>
                      </div>
                    </div>

                    <div class="mb-3 form-group">
                        <label for="category" class="form-label">Category</label>
                        <select class="form-select" name="category_id">
                            @foreach ($categories as $category)
                                @if (old('category_id', $product->category_id) == $category->id)
                                    <option value="{{ $category->id }}" selected>{{ $category->name }}</option>                   
                                @else
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endif
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>  
                        @enderror
                    </div>
                    
                  
                    <div class="mb-3">
                        <label class="form-label" for="image">Post Image</label>
                        <input type="hidden" value="{{ $product->image }}" name="oldImage">
                        <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" onchange="previewImage(event)">
                        @error('image')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>  
                        @enderror
                    </div>
                    <button class="btn btn-primary w-100">Edit Category</button>
                </div>
            </div>
        </form>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <h6>Image Preview</h6>
            @if ($product->image)
                <img src="{{ asset('storage/' .$product->image) }}" class="container img-fluid mb-3 d-block" id="img-preview">
            @else                
                <img class="img-fluid mb-3" id="img-preview">
             @endif
          </div>  
        </div>
      </div>

    </div>
</div>

<script>
    function previewImage(event){
        if(event.target.files.length > 0){
            var src = URL.createObjectURL(event.target.files[0]);
            var preview = document.getElementById("img-preview");
            preview.src = src;
            preview.style.display = "block";
        }
    }
</script>

  @endsection