@extends('dashboard/layouts/layoutMaster')

@section('title', 'ADs')

@section('breadcrumb_left')
  <span class="text-muted fw-light ">ADs/</span> Add New AD
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
      <form action="{{ route('dashboard.ADs.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        @include('dashboard.content.ADs._form')

      </form>
    </div>
  </div>
@endsection
