@extends('dashboard/layouts/layoutMaster')

@section('title', 'Tags')

@section('breadcrumb_left')
  <span class="text-muted fw-light ">Tags/</span> Tags List
@endsection
@section('breadcrumb_right')
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary p-2" data-bs-toggle="modal" data-bs-target="#addTag">
  <i class="fab fa-plus me-2"> </i> Add New Tag
</button>
@endsection
<form action="{{ route('dashboard.tags.store') }}" method="post" class="">
  @csrf
  <x-dashboard.form.modalTag id="addTag"/>
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
          <th>Actions</th>
        </tr>
        </thead>
        <tbody class="table-border-bottom-0">
          @foreach($tags as $tag)
            <tr>
              <td>{{ $tag->id }}</td>
              <td>
                <div class="d-flex justify-content-start align-items-center gap-3">
                  <strong> {{ $tag->name }}</strong>
                </div>
              </td>
              <td>{{ $tag->slug }}</td>
              <td>
                {{ $tag->created_at->diffForHumans() }}
              </td>
              <td>
                <div class="dropdown">
                  <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="ti ti-dots-vertical"></i></button>
                  <div class="dropdown-menu">
                    <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit{{$tag->id}}">
                      <i class="ti ti-pencil me-1"></i>
                      Edit
                    </button>
                    <form action="{{ route('dashboard.tags.destroy', $tag->id) }}" method="post">
                      @csrf
                      <!-- Form Method Spoofing -->
                      <input type="hidden" name="_method" value="delete">
                      @method('delete')
                      <button type="submit" class="dropdown-item"><i class="ti ti-trash me-1"></i> Delete</button>
                    </form>
                  </div>
                </div>
              </td>
            </tr>
            <!-- Modal -->


            <form action="{{ route('dashboard.tags.update', $tag->id) }}" method="post">
              @csrf
              @method('put')

              <x-dashboard.form.modalTag id="edit{{$tag->id}}" value="{{$tag->name}}"/>
            </form>
            <!-- End Modal -->

          @endforeach
        </tbody>
      </table>
      <div class="card-footer pb-2 ms-5">
          {{ $tags->withQueryString()->links() }}
      </div>
    </div>
  </div>



@endsection