@extends('dashboard.layouts.main')

@section('container')

<div class="container-fluid py-4">
    <div class="row">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header pb-0">
            <div class="d-flex align-items-center">
              <p class="mb-0">Add User</p>
            </div>
        </div>
        <form method="POST" action="/dashboard/users" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="example-text-input" class="form-control-label">Name</label>
                        <input class="form-control @error('name') is-invalid @enderror" type="text" value="{{ old('name') }}" name="name">
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>  
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                      <label for="example-text-input" class="form-control-label">Username</label>
                      <input class="form-control @error('username') is-invalid @enderror" type="username" value="{{ old('username') }}" name="username">
                      @error('username')
                          <div class="invalid-feedback">
                              {{ $message }}
                          </div>  
                      @enderror
                    </div>   
                    <div class="form-group col-md-6">
                      <label for="example-text-input" class="form-control-label">Email</label>
                      <input class="form-control @error('email') is-invalid @enderror" type="email" value="{{ old('email') }}" name="email">
                      @error('email')
                          <div class="invalid-feedback">
                              {{ $message }}
                          </div>  
                      @enderror
                    </div>                    

                    <div class="form-group col-md-6">
                      <label for="example-text-input" class="form-control-label ">Favorite</label><br>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input @error('role') is-invalid @enderror" type="radio" name="role" id="role1" value="admin" />
                        <label class="form-check-label" for="role1">Admin</label>
                      </div>
                      
                      <div class="form-check form-check-inline">
                        <input class="form-check-input @error('role') is-invalid @enderror" type="radio" name="role" id="role2" value="user" />
                        <label class="form-check-label" for="role2">User</label>
                      </div>

                      <div class="form-check form-check-inline">
                        <input class="form-check-input @error('role') is-invalid @enderror" type="radio" name="role" id="role2" value="staff" />
                        <label class="form-check-label" for="role2">Staff</label>
                      </div>
                    </div>

                    <div class="form-group col-md-6">
                      <label for="example-text-input" class="form-control-label ">Password</label>
                      <input class="form-control @error('password') is-invalid @enderror" type="password" value="{{ old('password') }}" name="password">
                      @error('password')
                          <div class="invalid-feedback">
                              {{ $message }}
                          </div>  
                      @enderror
                    </div>

                    <div class="form-group">
                      <label class="form-label" for="image">User Image</label>
                      {{-- <img class="img-fluid mb-3 col-sm-6 container" id="img-preview"> --}}
                      <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" onchange="previewImage(event)">
                      @error('image')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>  
                      @enderror
                    </div>
                    <button class="btn btn-primary w-100">Add User</button>
                </div>
            </div>
        </form>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <h6>Image Preview</h6>
            <img class="img-fluid mb-3 container" id="img-preview">
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