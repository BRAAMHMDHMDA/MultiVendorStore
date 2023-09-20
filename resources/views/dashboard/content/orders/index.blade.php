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
                            <td>
                                @if($order->status === 'pending')
                                    <span class="badge bg-label-warning bg-glow rounded-pill">{{ ($order->status) }}</span>
                                @elseif($order->status === 'processing')
                                    <span class="badge bg-label-dark rounded-pill">{{ ($order->status) }}</span>
                                @elseif($order->status === 'delivering')
                                    <span class="badge bg-label-info rounded-pill">{{ ($order->status) }}</span>
                                @elseif($order->status === 'completed')
                                    <span class="badge bg-label-success rounded-pill">{{ ($order->status) }}</span>
                                @elseif($order->status === 'cancelled')
                                    <span class="badge bg-label-danger rounded-pill">{{ ($order->status) }}</span>
                                @endif
                            </td>
                            <td>{{ $order->payment_method }}</td>
                            <td>
                                @if($order->payment_status === 'paid')
                                    <span class="badge bg-success bg-glow rounded-pill">{{ strtoupper($order->payment_status) }}</span>
                                @elseif($order->payment_status === 'pending')
                                    <span class="badge bg-label-warning rounded-pill">{{ strtoupper($order->payment_status) }}</span>
                                @elseif($order->payment_status === 'failed')
                                    <span class="badge bg-label-danger rounded-pill">{{ strtoupper($order->payment_status) }}</span>
                                @endif
                            </td>
                            <td>{{ Currency::format($order->total) }}</td>
                            <td>{{ $order->created_at->DiffForHumans() }}</td>
                            <td>
                                <div class="dropdown">
                                    <a href="{{ route('dashboard.orders.show', $order->id) }}">
                                        <i class="ti ti-eye me-1"></i>
                                    </a>
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="ti ti-dots-vertical"></i></button>
                                    <div class="dropdown-menu">
                                        @if($order->status !== 'completed')
                                            <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit{{$order->id}}">
                                                <i class="ti ti-pencil me-1"></i>
                                                Edit Order Status
                                            </button>
                                        @endif
                                        @if($order->payment_status !== 'paid')
                                            <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit-pay{{$order->id}}">
                                                <i class="ti ti-pencil me-1"></i>
                                                Edit Payment Status
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <form action="{{ route('dashboard.orders.update', $order->id) }}" method="post">
                            @csrf
                            @method('patch')
                            <div class="modal fade" id="edit{{$order->id}}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="">Edit Order Status</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        @php
                                            $options = ['pending','processing','delivering','completed','cancelled'];
                                        @endphp
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col mb-3">
                                                    <label for="nameBasic" class="form-label">Status</label>
                                                    <select id="nameBasic"
                                                            name="status"
                                                            data-allow-clear="false"
                                                            class="select2 form-select"
                                                    >
                                                        <option value="pending" selected>Pending</option>
                                                        <option value="processing">Processing</option>
                                                        <option value="delivering">Delivering</option>
                                                        <option value="completed">Completed</option>
                                                        <option value="cancelled">Cancelled</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary"><i class="fa-regular fa-floppy-disk me-1"></i> Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <form action="{{ route('dashboard.orders.update', $order->id) }}" method="post">
                            @csrf
                            @method('patch')
                            <div class="modal fade" id="edit-pay{{$order->id}}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="">Edit Payment Status</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col mb-3">
                                                    <label for="payment_status" class="form-label">Payment Status</label>
                                                    <select id="payment_status"
                                                            name="payment_status"
                                                            data-allow-clear="false"
                                                            class="select2 form-select"
                                                    >
                                                        <option value="pending" selected>Pending</option>
                                                        <option value="paid">Paid</option>
                                                        <option value="failed">Failed</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col mb-3">
                                                    <label for="payment_method" class="form-label">Payment Method</label>
                                                    <select id="payment_method"
                                                            name="payment_method"
                                                            data-allow-clear="false"
                                                            class="select2 form-select"
                                                    >
                                                        <option value="COD" selected>COD</option>
                                                        <option value="stripe">Stripe</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary"><i class="fa-regular fa-floppy-disk me-1"></i> Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    @endforeach
                </tbody>
            </table>
            <div class="card-footer pb-2 ms-5">
                {{ $orders->withQueryString()->links() }}
            </div>

        </div>
    </div>



@endsection