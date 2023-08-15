@extends('dashboard/layouts/layoutMaster')

@section('title', 'Admins')

@section('breadcrumb_left')
    <span class="text-muted fw-light ">Admins/</span> Admins List
@endsection
@section('breadcrumb_right')
    <a class="" href="{{ route('dashboard.admins.create') }}">
        <button type="button" class="btn btn-primary p-2"><i class="fab fa-plus me-2"> </i> Add New Admin</button>
    </a>
@endsection

@section('content')


    <div class="card">
        <div class="table-responsive text-nowrap">
            <table class="table table-hover ">
                <thead class="table-light">
                    <tr>
                        <th>#ID</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                @foreach($admins as $admin)
                    <tr>
                        <td>{{ $admin->id }}</td>
                        <td>
                            <div class="d-flex justify-content-start align-items-center gap-3">
                                <img src="{{ $admin->image_url }} " height="40px" width="40px" alt=""/>
                                <strong> {{ $admin->name }}</strong>
                            </div>
                        </td>
                        <td>{{ $admin->username }}</td>
                        <td>{{ $admin->phone_number }}</td>
                        <td>{{ $admin->email }}</td>
                        <td>
                            @if ($admin->status == 'active')
                                <span class="badge bg-label-success me-1">{{ $admin->status }}</span>
                            @else
                                <span class="badge bg-label-warning me-1">{{ $admin->status }}</span>
                            @endif
                        </td>
                        <td>
                            {{ $admin->created_at->diffForHumans() }}
                        </td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="ti ti-dots-vertical"></i></button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('dashboard.admins.edit', $admin->id) }}">
                                        <i class="ti ti-pencil me-1"></i> Edit
                                    </a>
                                    <a class="dropdown-item" onclick="confirmDelete({{$admin->id}})"><i class="ti ti-trash me-1"></i> Delete</a>
                                    <form action="{{ route('dashboard.admins.destroy', $admin->id) }}" method="post" id={{$admin->id}}>
                                        @csrf
                                        @method('delete')
                                    </form>
                                    <a class="dropdown-item" onclick="confirmStatus(s{{$admin->id}})">
                                        <i class="ti ti-ban me-1"></i>
                                        {{ $admin->status === 'active' ? 'Ban Account' : 'Active Account' }}
                                    </a>
                                    <form action="{{ route('dashboard.admin.status', $admin->id) }}" method="post" id=s{{$admin->id}} data-status={{$admin->status}}>
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
                {{ $admins->withQueryString()->links() }}
            </div>
        </div>
    </div>


@endsection

