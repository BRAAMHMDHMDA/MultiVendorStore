@extends('dashboard/layouts/layoutMaster')

@section('title', 'Vendors')

@section('breadcrumb_left')
    <span class="text-muted fw-light ">Vendors/</span> Edit Vendor
@endsection


@section('content')
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('dashboard.vendors.update', $vendor->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')

                @include('dashboard.content.vendors._form')
            </form>
        </div>
    </div>
@endsection
