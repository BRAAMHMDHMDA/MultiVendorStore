@extends('dashboard/layouts/layoutMaster')

@section('title', 'Orders')

@section('breadcrumb_left')
    <span class="text-muted fw-light ">Orders/</span> Order Details
@endsection


@section('content')
    <div class="row">
        <div class="col-12 col-lg-8">
            {{-- Order details--}}
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title m-0">Order details</h5>
                </div>
                <div class="card-datatable table-responsive">
                    <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                        <table class="datatables-order-details table border-top dataTable no-footer dtr-column" style="width: 822px;">
                            <thead>
                            <tr>
                                <th>#ID</th>
                                <th class="w-50">product</th>
                                <th class="w-25">price</th>
                                <th class="w-25">qty</th>
                                <th>total</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($order->products as $key => $product)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>
                                        <div class="d-flex justify-content-start align-items-center text-nowrap">
                                            <div class="avatar-wrapper">
                                                <div class="avatar me-2"><img class="rounded-2" src="{{ $product->image_url }}" /></div>
                                            </div>
                                            <div class="d-flex flex-column">
                                                <h6 class="text-body mb-0">{{ $product->name }}</h6>
                                                <small class="text-muted">{{ substr($product->description, 0, 50) }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td><span>{{ Currency::format($product->price) }}</span></td>
                                    <td><span class="text-body">{{$product->quantity}}</span></td>
                                    <td><h6 class="mb-0">{{ Currency::format($product->price * $product->quantity) }}</h6></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end align-items-center m-3 mb-2 p-1">
                        <div class="order-calculations">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="w-px-100 text-heading">Subtotal:</span>
                                <h6 class="mb-0">{{ Currency::format($order->total) }}</h6>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="w-px-100 text-heading">Discount:</span>
                                <h6 class="mb-0">{{ Currency::format($order->discount) }}</h6>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="w-px-100 text-heading">Tax:</span>
                                <h6 class="mb-0">{{ Currency::format($order->tax) }}</h6>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h6 class="w-px-100 mb-0">Total:</h6>
                                <h6 class="mb-0">{{ Currency::format($order->total) }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- End Order details --}}

            {{-- Shipping activity --}}
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title m-0">Shipping activity</h5>
                </div>
                <div class="card-body">
                    <ul class="timeline pb-0 mb-0">
                        <li class="timeline-item timeline-item-transparent border-primary">
                            <span class="timeline-point timeline-point-primary"></span>
                            <div class="timeline-event">
                                <div class="timeline-header">
                                    <h6 class="mb-0">Order was placed (Order ID: #32543)</h6>
                                    <span class="text-muted">Tuesday 11:29 AM</span>
                                </div>
                                <p class="mt-2">Your order has been placed successfully</p>
                            </div>
                        </li>
                        <li class="timeline-item timeline-item-transparent border-primary">
                            <span class="timeline-point timeline-point-primary"></span>
                            <div class="timeline-event">
                                <div class="timeline-header">
                                    <h6 class="mb-0">Pick-up</h6>
                                    <span class="text-muted">Wednesday 11:29 AM</span>
                                </div>
                                <p class="mt-2">Pick-up scheduled with courier</p>
                            </div>
                        </li>
                        <li class="timeline-item timeline-item-transparent border-primary">
                            <span class="timeline-point timeline-point-primary"></span>
                            <div class="timeline-event">
                                <div class="timeline-header">
                                    <h6 class="mb-0">Dispatched</h6>
                                    <span class="text-muted">Thursday 11:29 AM</span>
                                </div>
                                <p class="mt-2">Item has been picked up by courier</p>
                            </div>
                        </li>
                        <li class="timeline-item timeline-item-transparent border-primary">
                            <span class="timeline-point timeline-point-primary"></span>
                            <div class="timeline-event">
                                <div class="timeline-header">
                                    <h6 class="mb-0">Package arrived</h6>
                                    <span class="text-muted">Saturday 15:20 AM</span>
                                </div>
                                <p class="mt-2">Package arrived at an Amazon facility, NY</p>
                            </div>
                        </li>
                        <li class="timeline-item timeline-item-transparent border-left-dashed">
                            <span class="timeline-point timeline-point-primary"></span>
                            <div class="timeline-event">
                                <div class="timeline-header">
                                    <h6 class="mb-0">Dispatched for delivery</h6>
                                    <span class="text-muted">Today 14:12 PM</span>
                                </div>
                                <p class="mt-2">Package has left an Amazon facility, NY</p>
                            </div>
                        </li>
                        <li class="timeline-item timeline-item-transparent border-transparent pb-0">
                            <span class="timeline-point timeline-point-secondary"></span>
                            <div class="timeline-event pb-0">
                                <div class="timeline-header">
                                    <h6 class="mb-0">Delivery</h6>
                                </div>
                                <p class="mt-2 mb-0">Package will be delivered by tomorrow</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            {{-- End Shipping activity --}}
        </div>
        <div class="col-12 col-lg-4">
            {{-- Customer details --}}
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="card-title m-0">Customer details</h6>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-start align-items-center mb-4">
                        <div class="avatar me-2">
                            <img src="{{ $order->user->image_url }}" alt="Avatar" class="rounded-circle">
                        </div>
                        <div class="d-flex flex-column">
                            <a href="app-user-view-account.html" class="text-body text-nowrap">
                                <h6 class="mb-0">{{ $order->user->name }}</h6>
                            </a>
                            <small class="text-muted">Customer ID: #{{ $order->user->id }}</small></div>
                    </div>
                    <div class="d-flex justify-content-start align-items-center mb-4">
                        <span class="avatar rounded-circle bg-label-success me-2 d-flex align-items-center justify-content-center"><i
                                    class="ti ti-shopping-cart ti-sm"></i></span>
                        <h6 class="text-body text-nowrap mb-0">{{$order->user->orders->count()}} Orders</h6>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h6>Contact info</h6>
                    </div>
                    <p class=" mb-1">Email: {{ $order->user->email }}</p>
                    <p class=" mb-0">Mobile: {{ $order->user->phone_number }}</p>
                </div>
            </div>
            {{-- End Customer details --}}

            <div class="card mb-4">

                <div class="card-header d-flex justify-content-between">
                    <h6 class="card-title m-0">Shipping address</h6>
                </div>
                <div class="card-body">
                    <p class="mb-0">{{ $order->shippingAddress->street_address ?? '' }} <br>{{ $order->shippingAddress?->city }} <br>{{ $order->shippingAddress?->state }} <br>{{ $order->shippingAddress?->country }}</p>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between">
                    <h6 class="card-title m-0">Billing address</h6>
                </div>
                <div class="card-body">
                    <p class="mb-4">45 Roker Terrace <br>Latheronwheel <br>KW5 8NW,London <br>{{ $order->billingAddress->country }}</p>
                    <h6 class="card-title mb-3">Payment Info</h6>

                    <p class="mb-0 pb-2">Method: {{ $order->payment_method }}</p>
                    <p class="mb-2">Status: {{$order->payment_status}}</p>
                    <p class="mb-0">Card Number: ******4291</p>
                </div>

            </div>
        </div>
    </div>
@endsection