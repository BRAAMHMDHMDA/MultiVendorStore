@extends('dashboard/layouts/layoutMaster')

@section('title', 'Stores')

@section('breadcrumb_left')
    <span class="text-muted fw-light ">Stores/</span> Edit Store
@endsection


@section('content')
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('dashboard.stores.update', $store->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')

                @include('dashboard.content.stores._form', [
                    'update' => true
                ])
            </form>
        </div>
    </div>
@endsection
