@extends('dashboard/layouts/layoutMaster')

@section('title', 'Products')

@section('breadcrumb_left')
    <span class="text-muted fw-light ">Products/</span> Trashed Products List
@endsection
@section('breadcrumb_right')
    <div class="d-flex justify-content-end gap-2">

        <button type="button" class="btn btn-label-danger p-2" onclick="deleteConfirm('form-delete-all')">
            <i class="fa fa-trash me-2"> </i>
            Empty Trash
        </button>
        <button type="button" class="btn btn-label-primary p-2" onclick="confirmRestoreAll('form-restore-all')">
            <i class="fa fa-external-link me-2">
            </i> Restore All
        </button>

        {{--Form Restore All--}}
        <form action="{{ route('dashboard.products.restore') }}" id="form-restore-all" method="post">
            {{ csrf_field() }}
            {{ method_field('put') }}
        </form>
        {{--Form Empty Trash--}}
        <form action="{{ route('dashboard.products.force-delete') }}" id="form-delete-all" method="post">
            {{ csrf_field() }}
            {{ method_field('delete') }}
        </form>

    </div>
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
                    <th></th>
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
                    ajax: "{{ Route('dashboard.products.datatableTrashed') }}",
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'image', name: 'image', orderable:false},
                        {data: 'name', name: 'name'},
                        {data: 'category.name', name: 'category.name', orderable:false},
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
