@extends('dashboard/layouts/layoutMaster')

@section('title', 'Products')

@section('breadcrumb_left')
    <span class="text-muted fw-light ">Products/</span> Products List
@endsection
@section('breadcrumb_right')
    <a class="" href="{{ route('dashboard.products.create') }}">
        <button type="button" class="btn btn-primary p-2"><i class="fab fa-plus me-2"> </i> Add New Product</button>
    </a>
@endsection
@push('style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css" />
@endpush

@section('content')
    <div class="container">
        <div class="card p-4">
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
                    ajax: "{{ Route('dashboard.product.data') }}",
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'name', name: 'name'},
                        {data: 'category.name', name: 'category.name'},
                        {data: 'price', name: 'price'},
                        {data: 'quantity', name: 'quantity'},
                        {data: 'rating', name: 'rating'},
                        {data: 'status', name: 'status'},
                        {data: 'created_at', name: 'created_at'},
                        {data: 'action', name: 'action', orderable:false, searchable:false}
                    ]
                });

            });


        </script>
        <!-- Include Scripts -->
        <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>
    @endpush
@endsection
