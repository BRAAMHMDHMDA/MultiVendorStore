@extends('dashboard/layouts/layoutMaster')

@section('title', 'Categories')

@section('breadcrumb_left')
    <span class="text-muted fw-light ">ADs/</span> Edit AD
@endsection


@section('content')
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('dashboard.ADs.update', $ad->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')

                @include('dashboard.content.ADs._form')
            </form>
        </div>
    </div>
@endsection
