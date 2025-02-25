@extends('dashboard/layouts/layoutMaster')

@section('title', 'ADs')

@section('breadcrumb_left')
  <span class="text-muted fw-light ">ADs/</span> ADs List
@endsection
@section('breadcrumb_right')
  @admin
    <a class="" href="{{ route('dashboard.ADs.create') }}">
      <button type="button" class="btn btn-primary p-2"><i class="fab fa-plus me-2"> </i> Add New AD</button>
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
          <th>Main Title</th>
          <th>Sub Title</th>
          <th>BTN Text</th>
          <th>BTN Link</th>
          <th>Status</th>
          <th>Created At</th>
          @admin
          <th>Actions</th>
          @endadmin
        </tr>
        </thead>
        <tbody class="table-border-bottom-0">
          @foreach($ADs as $AD)
            <tr>
              <td>{{ $AD->id }}</td>
              <td>
                <div class="d-flex justify-content-start align-items-center gap-3">
{{--                  @if($ADs->image)--}}
                    <img src="{{ $AD->image_url }} " height="40px" width="40px" alt=""/>
{{--                  @endif--}}
                  <strong> {{ $AD->main_title }}</strong>
                </div>
              </td>
              <td>{{ $AD->sub_title }}</td>
              <td>{{ $AD->button_text }}</td>
              <td>{{ $AD->button_link}}</td>
              <td>
                @if ($AD->status == 'active')
                  <span class="badge bg-label-success me-1">{{ $AD->status }}</span>
                @else
                  <span class="badge bg-label-warning me-1">{{ $AD->status }}</span>
                @endif
              </td>
              <td>
                {{ $AD->created_at->diffForHumans() }}
              </td>
              @admin
              <td>
                 <div class="dropdown">
                  <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="ti ti-dots-vertical"></i></button>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{ route('dashboard.ADs.edit', $AD->id) }}">
                      <i class="ti ti-pencil me-1"></i> Edit
                    </a>
                    <a class="dropdown-item" onclick="deleteConfirm({{$AD->id}})"><i class="ti ti-trash me-1"></i> Delete</a>
                    <form action="{{ route('dashboard.ADs.destroy', $AD->id) }}" method="post" id={{$AD->id}}>
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
          {{ $ADs->withQueryString()->links() }}
      </div>
    </div>
  </div>


@endsection

