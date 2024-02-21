@extends('dashboard.layouts.main')

@section('container')


<div class="container-fluid py-4">
    <div class="row">
      <div class="col-lg-8">
        <div class="card mb-4">
          <div class="card-header pb-5">
            <div class="row">
                <div class="col-6 d-flex align-items-center">
                    <h6 class="mb-0">user</h6>
                  </div>
                <div class="col-6 text-end">
                    <a class="btn btn-xs bg-gradient-dark mb-0" href="/dashboard/users/create"><i class="fas fa-plus"></i>&nbsp;&nbsp;Add New user</a>
                  </div>
            </div>
          </div>
          <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
              <table class="table align-items-center mb-0">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xs font-weight-bolder text-center ps-3">Name</th>
                    <th class="text-uppercase text-secondary text-xs font-weight-bolder text-center">username</th>
                    <th class="text-uppercase text-secondary text-xs font-weight-bolder text-center">Role</th>
                    <th class="text-uppercase text-secondary text-xs font-weight-bolder text-center">Action</th>
                    {{-- <th class="text-secondary opacity-7"></th> --}}
                  </tr>
                </thead>
                <tbody>
                  @if ($users->isEmpty())
                  <tr class="mt-5">
                    <td colspan="3" class="mt-5">
                      <h5 class="text-center mb-3 opacity-7">404 Data Is Empty</h5>
                    </td>
                  </tr>
                  @endif
                  @foreach ($users as $user)                        
                  <tr>
                    <td>
                      <div class="d-flex px-2 py-1">
                        <div>
                          @if ($user->image === null)
                          <img src="/img/user.png" class="avatar avatar-sm me-3" alt="{{ $user->name }}">
                          @else
                          <img src="{{ asset('storage/' .$user->image) }}" class="avatar avatar-sm me-3" alt="{{ $user->name }}">
                          @endif
                        </div>
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="mb-0 text-sm text-capitalize">{{ $user->name }}</h6>
                          <p class="text-xs text-secondary mb-0">{{ $user->email }}</p>
                        </div>
                      </div>
                    </td>
                    <td class="text-center">
                      <h6 class="mb-0 text-sm text-capitalize">{{ $user->username }}</h6>
                    </td> 
                    <td class="text-center">
                      <span class="badge badge-sm {{ $user->role == 'admin' ? 'bg-gradient-primary' : ($user->role == 'user' ? 'bg-gradient-success' : 'bg-gradient-secondary')}}">{{ $user->role }}</span>
                    </td>                   
                    <td class="align-middle text-center">
                      <a class="btn btn-link text-dark px-3 mb-0" href="/dashboard/users/{{ $user->username }}/edit"><i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Edit</a>
                      <form action="/dashboard/users/{{ $user->id }}" method="post" class="d-inline">
                        @method('delete')
                        @csrf
                        <button class="btn btn-link text-danger text-gradient px-3 mb-0" onclick="return confirm('Are You Sure Delete Data?')"><i class="far fa-trash-alt me-2"></i>Delete</button>
                      </form>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  @endsection