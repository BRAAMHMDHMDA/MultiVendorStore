@extends('dashboard/layouts/layoutMaster')

@section('title', 'Stores')

@section('breadcrumb_left')
    <span class="text-muted fw-light ">Stores/</span> Add New Store
@endsection


@section('content')
{{--    <div class="row">--}}
        <div class="col">
            <div class="card mb-4 px-4 pb-5">
                <form action="{{ route('dashboard.stores.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @include('dashboard.content.stores._form')
                </form>
            </div>
        </div>
{{--    </div>--}}
@endsection
