@php
$configData = Helper::appClasses();
@endphp

@extends('dashboard/layouts/layoutMaster')

@section('title', 'Home')

@section('breadcrumb_left')
    <span class="text-muted fw-light ">Dashboard/</span> Home Page
@endsection

@section('content')

    <!-- Statistics -->
    <div class="col-xl-12 mb-4 col-lg-7 col-12">
        <div class="card h-100">
            <div class="card-header">
                <div class="d-flex justify-content-between mb-3">
                    <h5 class="card-title mb-0">Statistics</h5>
                    <small class="text-muted">Updated Now</small>
                </div>
            </div>
            <div class="card-body">
                <div class="row gy-3">
                    <div class="col-md-3 col-6">
                        <div class="d-flex align-items-center">
                            <div class="badge rounded-pill bg-label-primary me-3 p-2">
                                <i class="ti ti-chart-pie-2 ti-sm"></i>
                            </div>
                            <div class="card-info">
                                <h5 class="mb-0">{{$count_orders}}</h5>
                                <small>Orders</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="d-flex align-items-center">
                            <div class="badge rounded-pill bg-label-info me-3 p-2">
                                <i class="ti ti-users ti-sm"></i>
                            </div>
                            <div class="card-info">
                                <h5 class="mb-0">{{$count_customers}}</h5>
                                <small>Customers</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="d-flex align-items-center">
                            <div class="badge rounded-pill bg-label-danger me-3 p-2">
                                <i class="ti ti-shopping-cart ti-sm"></i>
                            </div>
                            <div class="card-info">
                                <h5 class="mb-0">{{$count_products}}</h5>
                                <small>Products</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="d-flex align-items-center">
                            <div class="badge rounded-pill bg-label-success me-3 p-2">
                                <i class="ti ti-currency-dollar ti-sm"></i>
                            </div>
                            <div class="card-info">
                                <h5 class="mb-0">{{$count_orders_completed}}</h5>
                                <small>Sales</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ Statistics -->

    <div class="row">
        <!-- Top Stores -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between">
                    <div class="card-title mb-0">
                        <h5 class="m-0 me-2">Top Stores</h5>
                        <small class="text-muted">The stores that receive the highest number of orders.</small>
                    </div>
                </div>
                <div class="card-body pb-0">
                    <ul class="p-0 m-0">
                        @forelse($top_stores as $store)
                            <li class="d-flex mb-4 pb-1">
                                <div class="me-3">
                                    <img src="{{$store->logo_image_url}}" alt="User" class="rounded" width="46" />
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0">{{$store->name}}</h6>
                                        <small class="text-muted d-block">{{$store->owner->name}}</small>
                                    </div>
                                    <div class="user-progress d-flex align-items-center gap-1">
                                        <p class="mb-0 fw-medium">{{ $store->orders_count }} Order</p>
                                    </div>
                                </div>
                            </li>
                        @empty
                            no
                        @endforelse
                    </ul>
                    <div id="reportBarChart"></div>
                </div>
            </div>
        </div>
        <!--/ Top Stores -->

        <!-- Featured Product -->
        <div class="col-md-6 col-xl-4 mb-4">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between">
                    <div class="card-title m-0 me-2">
                        <h5 class="m-0 me-2">Featured Products</h5>
{{--                        <small class="text-muted">Total 10.4k Visitors</small>--}}
                    </div>
                </div>
                <div class="card-body">
                    <ul class="p-0 m-0">
                        @forelse($featured_products as $product)
                            <li class="d-flex mb-4 pb-1">
                                <div class="me-3">
                                    <img src="{{$product->image_url}}" alt="User" class="rounded" width="46" />
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0">{{$product->name}}</h6>
                                        <small class="text-muted d-block">{{$product->store->name}}</small>
                                    </div>
                                    <div class="user-progress d-flex align-items-center gap-1">
                                        <p class="mb-0 fw-medium">{{ Currency::format($product->price) }}</p>
                                    </div>
                                </div>
                            </li>
                        @empty
                            no
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
        <!--/ Featured Product -->

        <!-- Special Customers-->
        <div class="col-md-6 col-xl-4 col-xl-4 mb-4">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between pb-2 mb-1">
                    <div class="card-title mb-1">
                        <h5 class="m-0 me-2">Special Customers</h5>
                        <small class="text-muted">The Customers that make the highest number of orders.</small>
                    </div>
                </div>
                <div class="card-body pb-0">
                    <ul class="p-0 m-0">
                        @forelse($special_customers as $customer)
                            <li class="d-flex mb-4 pb-1">
                                <div class="me-3">
                                    <img src="{{$customer->image_url}}" alt="User" class="rounded" width="46" />
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0">{{$customer->name}}</h6>
                                        {{--                                            <small class="text-muted d-block">{{$store->owner->name}}</small>--}}
                                    </div>
                                    <div class="user-progress d-flex align-items-center gap-1">
                                        <p class="mb-0 fw-medium">{{ $customer->orders_count }} Order</p>
                                    </div>
                                </div>
                            </li>
                        @empty
                            no
                        @endforelse
                    </ul>
                    <div id="reportBarChart"></div>
                </div>

            </div>
        </div>
        <!--/ Special Customers -->
    </div>

@endsection
