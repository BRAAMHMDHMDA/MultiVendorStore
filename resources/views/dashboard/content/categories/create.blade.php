@extends('dashboard/layouts/layoutMaster')

@section('title', 'Categories')

@section('breadcrumb_left')
  <span class="text-muted fw-light ">Categories/</span> Add New Category
@endsection


@section('content')
{{--  @if ($errors->any())--}}
{{--    <div class="alert alert-danger">--}}
{{--      <ul>--}}
{{--        @foreach ($errors->all() as $error)--}}
{{--          <li>{{ $error }}</li>--}}
{{--        @endforeach--}}
{{--      </ul>--}}
{{--    </div>--}}
{{--  @endif--}}



  <div class="card mb-4">
    <div class="card-body">
      <form action="{{ route('dashboard.categories.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        @include('dashboard.content.categories._form')

      </form>
    </div>
  </div>
@endsection
