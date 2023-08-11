{{--@php--}}
{{--  $configData = Helper::appClasses();--}}
{{--@endphp--}}

@extends('dashboard/layouts/layoutMaster')

@section('title', 'Categories')

@section('breadcrumb_left')
  <span class="text-muted fw-light ">Categories/</span> Categories List
@endsection
@section('breadcrumb_right')
  @admin
    <a class="" href="{{ route('dashboard.categories.create') }}">
      <button type="button" class="btn btn-primary p-2"><i class="fab fa-plus me-2"> </i> Add New Category</button>
    </a>
  @endadmin
@endsection

@section('content')


  <div class="card">
    <div class="table-responsive text-nowrap">
      <table class="table table-hover ">
        <thead class="table-light">
        <tr>
          <th>#ID</th>
          <th>Name</th>
          <th>Slug</th>
          <th>Parent</th>
          <th>Products Num#</th>
          <th>Status</th>
          <th>Created At</th>
          @admin
          <th>Actions</th>
          @endadmin
        </tr>
        </thead>
        <tbody class="table-border-bottom-0">
          @foreach($categories as $category)
            <tr>
              <td>{{ $category->id }}</td>
              <td>
                <div class="d-flex justify-content-start align-items-center gap-3">
{{--                  @if($categories->image)--}}
                    <img src="{{ $category->image_url }} " height="40px" width="40px" alt=""/>
{{--                  @endif--}}
                  <strong> {{ $category->name }}</strong>
                </div>
              </td>
              <td>{{ $category->slug }}</td>
              <td>{{ $category->parent->name }}</td>
              <td>{{ $category->products_count}}</td>
              <td>
                @if ($category->status == 'active')
                  <span class="badge bg-label-success me-1">{{ $category->status }}</span>
                @else
                  <span class="badge bg-label-warning me-1">{{ $category->status }}</span>
                @endif
              </td>
              <td>
                {{ $category->created_at->diffForHumans() }}
              </td>
              @admin
              <td>
                 <div class="dropdown">
                  <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="ti ti-dots-vertical"></i></button>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{ route('dashboard.categories.edit', $category->id) }}">
                      <i class="ti ti-pencil me-1"></i> Edit
                    </a>
                    <a class="dropdown-item" onclick="confirmDelete({{$category->id}})"><i class="ti ti-trash me-1"></i> Delete</a>
                    <form action="{{ route('dashboard.categories.destroy', $category->id) }}" method="post" id={{$category->id}}>
                      @csrf
                      @method('delete')
                    </form>
                  </div>
                </div>
              </td>
              @endadmin
            </tr>
          @endforeach
        </tbody>
      </table>
      <div class="card-footer pb-2 ms-5">
          {{ $categories->withQueryString()->links() }}
      </div>
    </div>
  </div>


@endsection

