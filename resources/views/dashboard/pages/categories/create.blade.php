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
        <form method="POST" action="/dashboard/categories" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="form-group">
                        <label for="example-text-input" class="form-control-label @error('name') is-invalid @enderror">Name</label>
                        <input class="form-control" type="text" value="{{ old('name') }}" name="name">
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>  
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="example-text-input" class="form-control-label @error('description') is-invalid @enderror">Description</label>
                        <input class="form-control" type="text" value="{{ old('description') }}" name="description">
                    </div>
                    <div class="form-group">
                      <label class="form-label" for="image">Category Image</label>
                      <img class="img-fluid mb-3 col-sm-6" id="img-preview">
                      <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" onchange="previewImage(event)">
                      @error('image')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>  
                      @enderror
                    </div>
                    <button class="btn btn-primary w-100">Add Category</button>
                </div>
            </div>
        </form>
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