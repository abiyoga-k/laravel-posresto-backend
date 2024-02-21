
@extends('dashboard.pages.auth.main')

@section('container')

  <main class="main-content  mt-0">
    <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg" style="background-image: url(''); background-position: top;">
      <span class="mask bg-gradient-dark opacity-6"></span>
      <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 text-center mx-auto">
                <h1 class="text-white mb-2 mt-1">Welcome!</h1>
            </div>
        </div>
       </div>
    </div>
    <div class="container">
      <div class="row mt-lg-n10 mt-md-n11 mt-n10 justify-content-center">
        <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
          <div class="card z-index-0">
            <div class="card-body text-center pt-4">
            </div>
            <div class="card-body ">
                <h5 class="text-center">Login</h5>
                <p class="text-lead text-center">Enter your email and password to sign in</p>
              <form role="form" method="POST" action="{{ route('register') }}">
                @csrf                
                <div class="mb-3">
                  <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Name" name="name" value="{{ old('name') }}">
                  @error('name')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
                <div class="mb-3">
                  <input type="text" class="form-control @error('username') is-invalid @enderror" placeholder="Username" name="username" value="{{ old('username') }}">
                    @error('username')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                </div>
                <div class="mb-3">
                  <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" name="email" value="{{ old('email') }}">
                  @error('email')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
                <div class="mb-3">
                  <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password">
                  @error('password')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
                <div class="mb-3">
                  <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Password2" name="password_confirmation">
                  @error('password_confirmation')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="rememberMe">
                    <label class="form-check-label" for="rememberMe">Remember me</label>
                  </div>
                <div class="text-center">
                  <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">Register Account</button>
                </div>
                <p class="text-sm mt-3 mb-0">Already have an account?  <a href="javascript:;" class="text-dark font-weight-bolder">Sign In</a></p>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

@endsection