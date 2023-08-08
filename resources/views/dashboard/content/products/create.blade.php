@extends('dashboard/layouts/layoutMaster')

@section('title', 'Products')

@section('breadcrumb_left')
  <span class="text-muted fw-light ">Products/</span> Add New Product
@endsection


@section('content')
  <div class="card mb-4">
    <div class="card-body">
      <form action="{{ route('dashboard.products.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        @include('dashboard.content.products._form')
      </form>
    </div>
  </div>
@endsection
