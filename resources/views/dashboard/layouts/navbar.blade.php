<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
    <div class="container-fluid py-1 px-3">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
          <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="/dashboard">Dashboard</a></li>
          @if (Request::is('dashboard/products*') || Request::is('dashboard/categories*'))
            <li class="breadcrumb-item text-sm  {{ Request::is('dashboard/products') || Request::is('dashboard/categories') ? 'text-white' : 'text-white opacity-5' }}" aria-current="page">
              <a href="{{ $route }}" class="text-white">{{ $title }}</a>
            </li>      
            @if (Request::is('dashboard/products/*') || Request::is('dashboard/categories/*'))
            <li class="breadcrumb-item text-sm text-white">
              {{ Request::is('dashboard/products/create') || Request::is('dashboard/categories/create') ? 'Create' : 'Edit' }}
            </li>       
             @else
                             
            @endif
          @endif
        </ol>
        <h6 class="font-weight-bolder text-white mb-0">{{ $title }}</h6>
      </nav>
      <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
        <div class="ms-md-auto pe-md-3 d-flex align-items-center">
          <div class="input-group">
            <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
            <input type="text" class="form-control" placeholder="Type here...">
          </div>
        </div>
        <ul class="navbar-nav  justify-content-end">
          <li class="nav-item d-flex align-items-center px-3">
            <a href="/dashboard/users/{{ auth()->user()->username }}">
              <i data-feather="user" class="text-white text-sm opacity-10"></i>
              <span class="d-sm-inline d-none text-white font-weight-bold text-capitalize mx-1">
                {{ auth()->user()->name }}
              </span>
            </a>
          </li>
          <li class="nav-item d-flex align-items-center px-0">
            <a href="#" class="nav-link text-white font-weight-bold px-0" 
               onclick="event.preventDefault(); document.getElementById('logout-form').submit()">
              <i data-feather="log-out" class="text-white text-sm opacity-10"></i>
              {{-- <span class="d-sm-inline d-none ">Log Out</span> --}}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          </li>
          <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
            <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
              <div class="sidenav-toggler-inner">
                <i class="sidenav-toggler-line bg-white"></i>
                <i class="sidenav-toggler-line bg-white"></i>
                <i class="sidenav-toggler-line bg-white"></i>
              </div>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>