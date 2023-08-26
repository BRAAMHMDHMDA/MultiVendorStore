@extends('dashboard/layouts/layoutMaster')

@section('title', 'Orders')

@section('breadcrumb_left')
    <span class="text-muted fw-light ">Orders/</span> Orders List
@endsection


@section('content')

    <div class="card">
        <div class="table-responsive text-nowrap">
            <table class="table table-hover ">
                <thead class="table-light">
                <tr>
                    <th>#NUM</th>
                    <th>Customer</th>
                    @admin
                    <th>Store</th>
                    @endadmin
                    <th>Status</th>
                    <th>Pay Method</th>
                    <th>Pay Status</th>
                    <th>Total</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach($orders as $order)
                        <tr>
                            <td><a href="{{ route('dashboard.orders.show', $order->id) }}">{{ $order->number }}</a></td>
                            <td>{{ $order->user->name }}</td>
                            @admin
                            <td>{{ $order->store->name }}</td>
                            @endadmin
                            <td>{{ $order->status }}</td>
                            <td>{{ $order->payment_method }}</td>
                            <td>{{ $order->payment_status }}</td>
                            <td>{{ Currency::format($order->total) }}</td>
                            <td>{{ $order->created_at->DiffForHumans() }}</td>
                            <td>
                                <div class="dropdown">
                                    <a href="{{ route('dashboard.orders.show', $order->id) }}">
                                        <i class="ti ti-eye me-1"></i>
                                    </a>
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="ti ti-dots-vertical"></i></button>
                                    <div class="dropdown-menu">
{{--                                        <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit{{$brand->id}}">--}}
{{--                                            <i class="ti ti-pencil me-1"></i>--}}
{{--                                            Edit--}}
{{--                                        </button>--}}
{{--                                        <form action="{{ route('dashboard.brands.destroy', $brand->id) }}" method="post">--}}
{{--                                            @csrf--}}
{{--                                            <!-- Form Method Spoofing -->--}}
{{--                                            <input type="hidden" name="_method" value="delete">--}}
{{--                                            @method('delete')--}}
{{--                                            <button type="submit" class="dropdown-item"><i class="ti ti-trash me-1"></i> Delete</button>--}}
{{--                                        </form>--}}
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="card-footer pb-2 ms-5">
            </div>
        </div>
    </div>



@endsection