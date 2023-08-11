@extends('dashboard/layouts/layoutMaster')

@section('title', 'Brands')

@section('breadcrumb_left')
  <span class="text-muted fw-light ">Brands/</span> Brands List
@endsection
@section('breadcrumb_right')
{{--<a class="" href="{{ route('dashboard.brands.create') }}">--}}
{{--  <button type="button" class="btn btn-primary p-2"><i class="fab fa-plus me-2"> </i> Add New Brand</button>--}}
{{--</a>--}}
<!-- Button trigger modal -->
@admin
  <button type="button" class="btn btn-primary p-2" data-bs-toggle="modal" data-bs-target="#addBrand">
    <i class="fab fa-plus me-2"> </i> Add New Brand
  </button>
@endadmin

@endsection
<form action="{{ route('dashboard.brands.store') }}" method="post" class="">
  @csrf
  <x-dashboard.form.modalBrand id="addBrand"/>
</form>
@section('content')

  <div class="card">
    <div class="table-responsive text-nowrap">
      <table class="table table-hover ">
        <thead class="table-light">
        <tr>
          <th>#ID</th>
          <th>Name</th>
          <th>Slug</th>
          <th>Created At</th>
          @admin
          <th>Actions</th>
          @endadmin
        </tr>
        </thead>
        <tbody class="table-border-bottom-0">
          @foreach($brands as $brand)
            <tr>
              <td>{{ $brand->id }}</td>
              <td>
                <div class="d-flex justify-content-start align-items-center gap-3">
                  <strong> {{ $brand->name }}</strong>
                </div>
              </td>
              <td>{{ $brand->slug }}</td>
              <td>
                {{ $brand->created_at->diffForHumans() }}
              </td>
              @admin
              <td>
                <div class="dropdown">
                  <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="ti ti-dots-vertical"></i></button>
                  <div class="dropdown-menu">
                    <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit{{$brand->id}}">
                      <i class="ti ti-pencil me-1"></i>
                      Edit
                    </button>
                    <form action="{{ route('dashboard.brands.destroy', $brand->id) }}" method="post">
                      @csrf
                      <!-- Form Method Spoofing -->
                      <input type="hidden" name="_method" value="delete">
                      @method('delete')
                      <button type="submit" class="dropdown-item"><i class="ti ti-trash me-1"></i> Delete</button>
                    </form>
                  </div>
                </div>
              </td>
              @endadmin
            </tr>
            <!-- Modal -->


            <form action="{{ route('dashboard.brands.update', $brand->id) }}" method="post">
              @csrf
              @method('put')

              <x-dashboard.form.modalBrand id="edit{{$brand->id}}" value="{{$brand->name}}"/>
            </form>
            <!-- End Modal -->

          @endforeach
        </tbody>
      </table>
      <div class="card-footer pb-2 ms-5">
          {{ $brands->withQueryString()->links() }}
      </div>
    </div>
  </div>



@endsection