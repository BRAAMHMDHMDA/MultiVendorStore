@extends('dashboard/layouts/layoutMaster')

@section('title', 'Products')

@section('breadcrumb_left')
    <span class="text-muted fw-light ">Products/</span> Edit Product
@endsection


@section('content')
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('dashboard.products.update', $product->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')

                @include('dashboard.content.products._form')
            </form>
        </div>
    </div>
@endsection
