<x-website.website-layout title="Cart Page">
    <x-website.breadcrumb current="Shopping Cart" title="Shopping Cart Products"/>


    <!-- Start Content -->
    <div id="content">
        <div class="container">
            <div class="row">
                <div class="header text-center">
                    <h3 class="small-title">Shopping cart</h3>
                    <p>Shopping cart-Checkout-Order complete</p>
                </div>
                <div class="col-md-12">
                    <div class="wishlist">
                        <div class="col-md-4 col-sm-4 text-center">
                            <p>Product</p>
                        </div>
                        <div class="col-md-2 col-sm-2">
                            <p>Price</p>
                        </div>
                        <div class="col-md-2 col-sm-2">
                            <p>Quantity</p>
                        </div>
                        <div class="col-md-2 col-sm-2">
                            <p>Total</p>
                        </div>
                        <div class="col-md-2 col-sm-2">
                            <p>Close</p>
                        </div>
                    </div>
                </div>
                @empty($cart->get()->count())
                    <div class="wishlist-entry clearfix" style="text-align: center">
                        No Items Available, <a href="{{ route('all-products') }}">Go To Shopping</a> (^_^) ...
                    </div>
                @endempty
                @foreach ($cart->get() as $item)
                    <div class="wishlist-entry clearfix" id="{{$item->id}}">
                        <div class="col-md-4 col-sm-4">
                            <div class="cart-entry">
                                <a class="image" href="#"><img src="{{ $item->product->image_url }}"  alt=""></a>
                                <div class="cart-content">
                                    <h4 class="title">{{ $item->product->name }}</h4>
                                    <p>{{ $item->product->description }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-2 entry">
                            <div class="price">
                                {{ Currency::format($item->product->price) }}
                                @if($item->product->compare_price)
                                    <del>{{ Currency::format($item->product->compare_price) }}</del>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-2">
                            <ul class="quantity-selector">
{{--                                <li class="entry number-minus">1</li>--}}
{{--                                <li class="entry number">{{ $item->quantity }}</li>--}}
{{--                                <li class="entry number-plus">1</li>--}}
                                <input class="item-quantity form-control" data-id="{{$item->id}}" value="{{$item->quantity}}" type="number" style="width: 50%; margin: auto">
                            </ul>
                        </div>
                        <div class="col-md-2 col-sm-2 entry">
                            <div class="price">
                                {{ Currency::format($item->quantity * $item->product->price) }}
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-2 entry">
                            <a class="btn-close remove-item" data-id="{{ $item->id }}" href="#"><i class="icon-close"></i></a>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
    <!-- End Content -->
</x-website.website-layout>