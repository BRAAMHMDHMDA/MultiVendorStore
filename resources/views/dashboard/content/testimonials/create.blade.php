@extends('dashboard/layouts/layoutMaster')

@section('title', 'Testimonials')

@section('breadcrumb_left')
    <span class="text-muted fw-light ">Testimonials/</span> Add New Testimonial
@endsection


@section('content')
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('dashboard.testimonials.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                @include('dashboard.content.testimonials._form')
            </form>
        </div>
    </div>
@endsection
