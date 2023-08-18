@extends('dashboard/layouts/layoutMaster')

@section('title', 'Vendors')

@section('breadcrumb_left')
    <span class="text-muted fw-light ">Vendors/</span> Add New Vendor
@endsection


@section('content')
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('dashboard.vendors.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                @include('dashboard.content.vendors._form')
            </form>
        </div>
    </div>
@endsection
