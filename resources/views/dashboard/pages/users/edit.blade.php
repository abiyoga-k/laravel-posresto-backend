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
        <form method="POST" action="/dashboard/users/{{ $user->username }}" enctype="multipart/form-data">
            @method('put')
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="example-text-input" class="form-control-label">Name</label>
                        <input class="form-control @error('name') is-invalid @enderror" type="text" value="{{ old('name', $user->name) }}" name="name">
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>  
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                      <label for="example-text-input" class="form-control-label">Username</label>
                      <input class="form-control @error('username') is-invalid @enderror" type="username" value="{{ old('username', $user->username) }}" name="username">
                      @error('username')
                          <div class="invalid-feedback">
                              {{ $message }}
                          </div>  
                      @enderror
                    </div>   
                    <div class="form-group col-md-6">
                      <label for="example-text-input" class="form-control-label">Email</label>
                      <input class="form-control @error('email') is-invalid @enderror" type="email" value="{{ old('email', $user->email) }}" name="email">
                      @error('email')
                          <div class="invalid-feedback">
                              {{ $message }}
                          </div>  
                      @enderror
                    </div>                    

                    <div class="form-group col-md-6">
                      <label for="example-text-input" class="form-control-label ">Favorite</label><br>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input @error('role') is-invalid @enderror" type="radio" name="role" id="role1" value="admin" {{ $user->role == "admin" ? 'checked' : '' }}/>
                        <label class="form-check-label" for="role1">Admin</label>
                      </div>
                      
                      <div class="form-check form-check-inline">
                        <input class="form-check-input @error('role') is-invalid @enderror" type="radio" name="role" id="role2" value="user" {{ $user->role == "user" ? 'checked' : '' }}/>
                        <label class="form-check-label" for="role2">User</label>
                      </div>

                      <div class="form-check form-check-inline">
                        <input class="form-check-input @error('role') is-invalid @enderror" type="radio" name="role" id="role2" value="staff" {{ $user->role == "staff" ? 'checked' : '' }}/>
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
                      <input type="hidden" value="{{ $user->image }}" name="oldImage">
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
            
            @if ($user->image)
                <img src="{{ asset('storage/' .$user->image) }}" class="container img-fluid mb-3 d-block" id="img-preview">
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