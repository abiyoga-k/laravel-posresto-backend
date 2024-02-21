@extends('dashboard.layouts.main')

@section('container')

<div class="container-fluid py-4">
    <div class="row">
      <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
          <div class="card-body p-3">
            <div class="row">
              <div class="col-8">
                <div class="numbers">
                  <p class="text-sm mb-0 text-uppercase font-weight-bold">Product</p>                  
                  <h5 class="font-weight-bolder">
                    {{ $product_count }}
                  </h5>
                </div>
              </div>
              <div class="col-4 text-end">
                <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                  <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
          <div class="card-body p-3">
            <div class="row">
              <div class="col-8">
                <div class="numbers">
                  <p class="text-sm mb-0 text-uppercase font-weight-bold">Category</p>
                  <h5 class="font-weight-bolder">
                    {{ $category_count }}
                  </h5>
                </div>
              </div>
              <div class="col-4 text-end">
                <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                  <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row mt-4">
      <div class="col-lg-7 mb-lg-0 mb-4">
        <div class="card ">
          <div class="card-header pb-0 p-3">
            <div class="row mb-3">
              <div class="col-6 d-flex align-items-center">
                  <h6 class="mb-0">Product List</h6>
              </div>
              <div class="col-6 text-end">
                  <a class="btn btn-sm bg-gradient-dark mb-0" href="/dashboard/products/create"><i class="fas fa-plus"></i>&nbsp;&nbsp;Add New Product</a>
              </div>
           </div>
          </div>

          <div class="row">
            @if ($products->isEmpty())
                <h5 class="text-center mb-3 opacity-7">404 Data Is Empty</h5>
            @endif
            @foreach ($products as $product)
            <div class="col-md-3">
              <div class="card-header mx-4 p-3 text-center">
                @if ($product->image === null)
                <img src="/img/menu.png" class=" img-fluid rounded mx-auto d-block" alt="{{ $product->name }}" style="width: 80px; height: 80px">
                @else                    
                <img src="{{ asset('storage/' .$product->image) }}" class=" img-fluid rounded mx-auto d-block" alt="{{ $product->name }}" style="width: 80px; height: 80px">
                @endif
              </div>
              <div class="card-body pt-0 p-3 text-center">
                <h6 class="text-center mb-0 text-capitalize">{{ $product->name }}</h6>
                <span class="text-md text-bold">{{ $product->stock }} </span><span class="text-xs">in stock</span><br>
                <hr class="horizontal dark my-0">
                <h7 class="text-center mb-0 text-capitalize text-xs">{{ $product->formatRupiah('price') }}</h7>
              </div>
            </div>
            @endforeach
          </div>
        </div>
      </div>
      <div class="col-lg-5">
        <div class="card">
          <div class="card-header pb-0 p-3">
            <div class="row mb-3">
              <div class="col-6 d-flex align-items-center">
                  <h6 class="mb-0">Category List</h6>
              </div>
              <div class="col-6 text-end">
                  <a class="btn btn-sm bg-gradient-dark mb-0" href="/dashboard/categories/create"><i class="fas fa-plus"></i>&nbsp;&nbsp;Add New Category</a>
              </div>
           </div>
          </div>
          <div class="card-body p-3">
            <ul class="list-group">
              @if ($categories->isEmpty())
                <h5 class="text-center opacity-7">404 Data Is Empty</h5>
              @endif
              @foreach ($categories as $category)
              <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                <div class="d-flex align-items-center">
                  <div>
                    @if ($category->image === null)
                    <img src="/img/category.png" class="avatar avatar-sm me-3" alt="{{ $category->name }}">
                    @else
                    <img src="{{ asset('storage/' .$category->image) }}" class="avatar avatar-sm me-3" alt="{{ $category->name }}">                        
                    @endif
                  </div>
                  <div class="d-flex flex-column">
                    <h6 class="mb-1 text-dark text-sm text-capitalize">{{ $category->name }}</h6>
                    <span class="text-xs">250 in stock, <span class="font-weight-bold">346+ sold</span></span>
                  </div>
                </div>
                <div class="d-flex">
                  <button class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto"><i class="ni ni-bold-right" aria-hidden="true"></i></button>
                </div>
              </li>
              @endforeach
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>

  @endsection