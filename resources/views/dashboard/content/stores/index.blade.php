@extends('dashboard/layouts/layoutMaster')

@section('title', 'Stores')

@section('breadcrumb_left')
    <span class="text-muted fw-light ">Stores/</span> Stores List
@endsection
{{--@section('breadcrumb_right')--}}
{{--    @admin--}}
{{--    <a class="" href="{{ route('dashboard.categories.create') }}">--}}
{{--        <button type="button" class="btn btn-primary p-2"><i class="fab fa-plus me-2"> </i> Add New Category</button>--}}
{{--    </a>--}}
{{--    @endadmin--}}
{{--@endsection--}}

@section('content')


    <div class="card">
        <div class="table-responsive text-nowrap">
            <table class="table table-hover ">
                <thead class="table-light">
                    <tr>
                        <th>#ID</th>
                        <th>Name</th>
{{--                        <th>Store Name</th>--}}
{{--                        <th>Username</th>--}}
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Email Verify</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                @foreach($stores as $store)
                    <tr>
                        <td>{{ $store->id }}</td>
                        <td>
                            <div class="d-flex justify-content-start align-items-center gap-3">
                                <img src="{{ $store->image_url }} " height="40px" width="40px" alt=""/>
                                <strong> {{ $store->name }}</strong>
                            </div>
                        </td>
{{--                        <td>{{ $store->username }}</td>--}}
                        <td>{{ $store->phone_number }}</td>
                        <td>{{ $store->email }}</td>
                        <td>
                            @if($store->email_verified_at)
                                {{ $store->email_verified_at->diffForHumans() }}
                            @else
                                <span class="badge bg-label-info">Not Verify</span>
                            @endif
                        </td>
                        <td>
                            @if ($store->status == 'active')
                                <span class="badge bg-label-success me-1">{{ $store->status }}</span>
                            @else
                                <span class="badge bg-label-warning me-1">{{ $store->status }}</span>
                            @endif
                        </td>
                        <td>
                            {{ $store->created_at->diffForHumans() }}
                        </td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="ti ti-dots-vertical"></i></button>
                                <div class="dropdown-menu">
{{--                                    <a class="dropdown-item" href="{{ route('dashboard.categories.edit', $store->id) }}">--}}
{{--                                        <i class="ti ti-pencil me-1"></i> Edit--}}
{{--                                    </a>--}}
{{--                                    <a class="dropdown-item" onclick="confirmDelete({{$store->id}})"><i class="ti ti-trash me-1"></i> Delete</a>--}}
{{--                                    <form action="{{ route('dashboard.categories.destroy', $store->id) }}" method="post" id={{$store->id}}>--}}
{{--                                        @csrf--}}
{{--                                        @method('delete')--}}
{{--                                    </form>--}}
                                    <a class="dropdown-item" onclick="confirmStatus(s{{$store->id}})">
                                        <i class="ti ti-ban me-1"></i>
                                        {{ $store->status === 'active' ? 'Ban Account' : 'Active Account' }}
                                    </a>
                                    <form action="{{ route('dashboard.vendor.status', $store->id) }}" method="post" id=s{{$store->id}} data-status={{$store->status}}>
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
                {{ $stores->withQueryString()->links() }}
            </div>
        </div>
    </div>


@endsection

