@extends('dashboard.layouts.main')

@section('container')


<div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-5">
            <div class="row">
                <div class="col-6 d-flex align-items-center">
                    <h6 class="mb-0">Product List</h6>
                </div>
                <div class="col-6 text-end">
                    <a class="btn bg-gradient-dark mb-0" href="/dashboard/products/create"><i class="fas fa-plus"></i>&nbsp;&nbsp;Add New Product</a>
                </div>
            </div>
            @if (session()->has('success'))
              <div class="alert alert-success alert-dismissible fade show col-lg-12 mt-3 text-white " role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                  <i data-feather="x" class="mb-5"></i>
                </button>
              </div>
            @endif
          </div>
          <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
              <table class="table align-items-center mb-0">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-5">Name</th>
                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">Price</th>
                    <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Stock</th>
                    <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Status</th>
                    <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Action</th>
                    {{-- <th class="text-secondary opacity-7"></th> --}}
                  </tr>
                </thead>
                <tbody>
                  @if ($products->isEmpty())
                  <tr class="mt-5">
                    <td colspan="5" class="mt-5">
                      <h5 class="text-center mb-3 opacity-7">404 Data Is Empty</h5>
                    </td>
                  </tr>
                  @endif
                  @foreach ($products as $product)                         
                  <tr>
                    <td>
                      <div class="d-flex px-2 py-1">
                        <div>
                          @if ($product->image === null)
                          <img src="/img/menu.png" class="avatar avatar-sm me-3" alt="{{ $product->name }}">
                          @else
                          <img src="{{ asset('storage/' .$product->image) }}" class="avatar avatar-sm me-3" alt="{{ $product->name }}">                              
                          @endif
                        </div>
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="mb-0 text-sm text-capitalize">{{ $product->name }}</h6>
                        </div>
                      </div>
                    </td>
                    <td>
                      <p class="text-sm text-secondary mb-0">{{ $product->formatRupiah('price') }}</p>
                    </td>
                    <td class="align-middle text-center">
                        <span class="text-secondary text-sm font-weight-bold">{{ $product->stock }}</span>
                      </td>
                    <td class="align-middle text-center text-sm">
                      <span class="badge badge-sm {{ $product->status == 'active' ? 'bg-gradient-success' : 'bg-gradient-danger' }}">{{ $product->status }}</span>
                    </td>                    
                    <td class="align-middle text-center">
                      <a class="btn btn-link text-dark px-3 mb-0" href="/dashboard/products/{{ $product->slug }}/edit"><i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Edit</a>
                      <form action="/dashboard/products/{{ $product->id }}" method="post" class="d-inline">
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