@extends('dashboard/layouts/layoutMaster')

@section('title', 'My Store')

@section('breadcrumb_left')
    <span class="text-muted fw-light ">Account/</span> Manage My Store
@endsection


@section('content')
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('dashboard.my-store.update', $store->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')

                @include('dashboard.content.stores._form', [
                    'update' => true
                ])
            </form>
        </div>
    </div>
@endsection
