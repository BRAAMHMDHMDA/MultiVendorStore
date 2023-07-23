@extends('dashboard/layouts/layoutMaster')

@section('title', 'Categories')

@section('breadcrumb_left')
    <span class="text-muted fw-light ">Categories/</span> Categories List
@endsection
@section('breadcrumb_right')
    <a class="" href="{{ route('dashboard.categories.create') }}">
        <button type="button" class="btn btn-primary p-2"><i class="fab fa-plus me-2"> </i> Add New Category</button>
    </a>
@endsection
@push('style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css" />
@endpush
{{--@section('content')--}}

{{--    <div class="container">--}}
{{--        <div class="card p-5">--}}
{{--            {!! $dataTable->table(['class' => 'table table-striped data-table' ])!!}--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    @push('script')--}}
{{--        <!-- Include Scripts -->--}}
{{--        <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>--}}
{{--        <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>--}}
{{--        {!! $dataTable->scripts() !!}--}}
{{--    @endpush--}}
{{--@endsection--}}
@section('content')

    <div class="container">
        <div class="card table-responsive p-5 ">
            <table class="datatables-basic table" id="table_id">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Category</th>
                        <th>Slug</th>
                        <th>Parent</th>
                        <th>#Products</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>

    @push('script')
        <script type="text/javascript">
            $(function() {
                var table = $('#table_id').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ Route('dashboard.category.dt') }}",
                    columns: [
                        {
                            data: 'id',
                            name: 'id'
                        },{
                            data: 'name',
                            name: 'name',
                        }, {
                            data: 'slug',
                            name: 'slug',
                        }, {
                            data: 'parent',
                            name: 'parent',
                        }, {
                            data: 'products_count',
                            name: 'products_count',
                            orderable:false,
                            searchable:false

                        }, {
                            data: 'status',
                            name: 'status',
                        }, {
                            data: 'created_at',
                            name: 'created_at',
                        }, {
                            data: 'action',
                            name: 'action',
                            orderable:false,
                            searchable:false
                        }
                    ]
                });

            });


        </script>
        <!-- Include Scripts -->
        <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>
    @endpush
@endsection
