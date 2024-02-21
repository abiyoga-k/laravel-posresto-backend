@extends('dashboard.layouts.main')

@section('container')


<div class="card shadow-lg mx-4">
    <div class="card-body p-3">
      <div class="row gx-4">
        <div class="col-auto">
          <div class="avatar avatar-xl position-relative">
            @if ($user->image === null)
            <img src="/img/user.png" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
            @endif
            <img src="{{ asset('storage/' .$user->image) }}" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
          </div>
        </div>
        <div class="col-auto my-auto">
          <div class="h-100">
            <h5 class="mb-1 text-uppercase">
                {{ $user->name }}
            </h5>
            <p class="mb-0 font-weight-bold text-sm">
                {{ $user->email }}
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header pb-0">
            <div class="d-flex align-items-center">
              <p class="mb-0">Edit Profile</p>
              <button class="btn btn-primary btn-sm ms-auto">Settings</button>
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
                    
                    <input type="hidden" name="role" value="{{ $user->role }}">

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
                    <button class="btn btn-primary w-100">Update User</button>
                </div>
            </div>
        </form>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card card-profile">
          <img src="/img/forest.jpg" alt="Image placeholder" class="card-img-top">
          <div class="row justify-content-center">
            <div class="col-4 col-lg-4 order-lg-2">
              <div class="mt-n4 mt-lg-n6 mb-4 mb-lg-0">
                <a href="">
                    @if ($user->image === null)
                    <img src="/img/user.png" class="rounded-circle img-fluid border border-2 border-white" id="img-preview">   
                    @endif
                    @if ($user->image)
                        <img src="{{ asset('storage/' .$user->image) }}" class="rounded-circle img-fluid border border-2 border-white" id="img-preview">
                    @else                
                        <img class="rounded-circle img-fluid border border-2 border-white" id="img-preview">
                    @endif
                </a>
              </div>
            </div>
          </div>
          <div class="card-body pt-0">
            <div class="text-center mt-4">
              <h5 class="text-capitalize">
                {{ $user->name }}
              </h5>
              <div class="h6 font-weight-300">
                {{ $user->email }}
              </div>
              <div class="h6 mt-0">
                <span class="badge badge-sm {{ $user->role == 'admin' ? 'bg-gradient-primary' : ($user->role == 'user' ? 'bg-gradient-success' : 'bg-gradient-secondary')}}">{{ $user->role }}</span>
              </div>
            </div>
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