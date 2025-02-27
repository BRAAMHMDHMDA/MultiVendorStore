@extends('dashboard/layouts/layoutMaster')

@section('title', 'Testimonials')

@section('breadcrumb_left')
    <span class="text-muted fw-light ">Testimonials/</span> Edit Testimonial
@endsection

@section('content')
    <div class="card-body">
        <form action="{{ route('dashboard.testimonials.update') }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            @include('dashboard.content.testimonials._form')
        </form>
    </div>
@endsection
