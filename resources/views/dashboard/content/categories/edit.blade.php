@extends('dashboard/layouts/layoutMaster')

@section('title', 'Categories')

@section('breadcrumb_left')
    <span class="text-muted fw-light ">Categories/</span> Edit Category
@endsection


@section('content')
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('dashboard.categories.update', $category->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')

                @include('dashboard.content.categories._form')
            </form>
        </div>
    </div>
@endsection
