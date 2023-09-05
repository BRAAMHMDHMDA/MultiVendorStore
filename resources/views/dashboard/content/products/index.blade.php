@extends('dashboard/layouts/layoutMaster')

@section('title', 'Products')

@section('breadcrumb_left')
    <span class="text-muted fw-light ">Products/</span> Products List
@endsection
@section('breadcrumb_right')
    <div class="d-flex justify-content-end gap-2">
        <a class="" href="{{ route('dashboard.products.trash') }}">
            <button type="button" class="btn btn-outline-danger p-2"><i class="fa fa-trash me-2"> </i> Trashed Products</button>
        </a>
        @if(\Illuminate\Support\Facades\Auth::guard('vendors')->check())
            <a class="" href="{{ route('dashboard.products.create') }}">
                <button type="button" class="btn btn-primary p-2"><i class="fab fa-plus me-2"> </i> Add New Product</button>
            </a>
        @endif
    </div>
@endsection
@push('style')
    {{--    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css" />--}}
        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
@endpush

@section('content')
    <div class="container">
        <div class="card p-4">
            @if (isset($notify))
                <div class="alert alert-danger d-flex align-items-center" role="alert">
                        <span class="alert-icon text-danger me-2">
                          <i class="ti ti-ban ti-xs"></i>
                        </span>
                    {{$notify}}
                </div>
            @endif
                <div id="asd" style="display: none">
                    <div class="row justify-content-end">
                        <div style="width: fit-content">
                            <input type="text" class="form-control dt-input" placeholder="Balky">
                        </div>
                        <div style="width: fit-content">
                            <x-dashboard.form.select class="select2" id="category" name="category_id" :options="$categories" :old_option="0" />
                        </div>
                    </div>
                </div>

                <table class="table table-hover table-responsive" id="table_id">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Rating</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody class=""></tbody>
            </table>
        </div>
    </div>

    @push('script')
        <script type="text/javascript">
            $(function() {
                var table = $('#table_id').DataTable({
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    ajax: "{{ Route('dashboard.products.datatable') }}",
                    columns: [
                        {data: 'id', name: 'id'},
                        // {data: 'image', name: 'image', orderable:false},
                        {data: 'name', name: 'name'},
                        {data: 'category.name', name: 'category.name', orderable:false},
                        {data: 'price', name: 'price'},
                        {data: 'quantity', name: 'quantity'},
                        {data: 'rating', name: 'rating'},
                        {data: 'status', name: 'status'},
                        {data: 'created_at', name: 'created_at'},
                        {data: 'action', name: 'action', orderable:false, searchable:false, width:20 }
                    ],
                    order: [[7, 'desc']],
                });

            // $('#table_id_filter').html($('#asd').html())
            });


        </script>
        <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    @endpush
@endsection
