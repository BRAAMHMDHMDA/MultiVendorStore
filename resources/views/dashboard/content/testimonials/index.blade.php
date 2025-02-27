@extends('dashboard/layouts/layoutMaster')

@section('title', 'Testimonials')

@section('breadcrumb_left')
    <span class="text-muted fw-light ">Testimonials/</span> Testimonials List
@endsection
@section('breadcrumb_right')
    @admin
    <a class="" href="{{ route('dashboard.testimonials.create') }}">
        <button type="button" class="btn btn-primary p-2"><i class="fab fa-plus me-2"> </i> Add New Testimonial</button>
    </a>
    @endadmin
@endsection

@section('content')

    <div class="card">
        @empty(count($testimonials))
            <h5 class="text-center pt-4 pb-2 text-danger">No Testimonials Found.</h5>
        @else
            <div class="table text-nowrap">
                <table class="table table-hover">
                    <thead class="table-light">
                    <tr>
                        <th>#ID</th>
                        <th>Name</th>
                        <th>Job Title</th>
                        <th>Content</th>
                        <th>Show at Home</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    @foreach($testimonials as $testimonial)
                        <tr>
                            <td>{{ $testimonial->id }}</td>
                            <td>
                                <div class="d-flex justify-content-start align-items-center gap-3">
                                    <img src="{{ $testimonial->image_url }} " height="40px" width="40px" alt=""/>
                                    <strong> {{ $testimonial->name }}</strong>
                                </div>
                            </td>
                            <td>{{ $testimonial->job_title }}</td>
                            <td class="text-wrap">{{ $testimonial->content }}</td>
                            <td>
                                @if ($testimonial->show_at_home)
                                    <span class="badge bg-label-success me-1">Yes</span>
                                @else
                                    <span class="badge bg-label-warning me-1">NO</span>
                                @endif
                            </td>
                            <td>
                                @if ($testimonial->status == 'active')
                                    <span class="badge bg-label-success me-1">{{ $testimonial->status }}</span>
                                @else
                                    <span class="badge bg-label-warning me-1">{{ $testimonial->status }}</span>
                                @endif
                            </td>
                            <td>
                                {{ $testimonial->created_at->diffForHumans() }}
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="ti ti-dots-vertical"></i></button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('dashboard.testimonials.edit', $testimonial->id) }}">
                                            <i class="ti ti-pencil me-1"></i> Edit
                                        </a>
                                        <a class="dropdown-item" onclick="deleteConfirm({{$testimonial->id}})"><i class="ti ti-trash me-1"></i> Delete</a>
                                        <form action="{{ route('dashboard.testimonials.destroy', $testimonial->id) }}" method="post" id={{$testimonial->id}}>
                                            @csrf
                                            @method('delete')
                                        </form>
                                        <form action="{{ route('dashboard.testimonials.update', $testimonial->id) }}" method="post" id=s{{$testimonial->id}} data-status={{$testimonial->status}}>
                                            @csrf
                                            @method('patch')
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="card-footer pb-2 ms-5">
                    {{ $testimonials->withQueryString()->links() }}
                </div>
            </div>
        @endempty
    </div>


@endsection

