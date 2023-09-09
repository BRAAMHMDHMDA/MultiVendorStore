<x-website.website-layout title="Wishlist">
    <x-website.breadcrumb title="wishlist" current="wishlist" />
    <!-- Start Content -->
    <div id="content">
        <div class="container">
            <div class="row">
                <div class="header text-center">
                    <h3 class="small-title">Wishlist</h3>
                </div>
                <div id="alert"></div>
                <div class="col-md-12">
                    <div class="wishlist">
                        <div class="col-md-4 col-sm-4 text-center">
                            <p>Product</p>
                        </div>
                        <div class="col-md-2 col-sm-2">
                            <p>Price</p>
                        </div>
                        <div class="col-md-2 col-sm-2">
                            <p>Stock status</p>
                        </div>
                        <div class="col-md-2 col-sm-2">
                            <p>Add to cart</p>
                        </div>
                        <div class="col-md-2 col-sm-2">
                            <p>Close</p>
                        </div>
                    </div>
                    @forelse($wishlist as $row)
                        <div class="wishlist-entry clearfix"  id="{{ $row->id }}">
                            <div class="col-md-4 col-sm-4">
                                <div class="cart-entry">
                                    <a class="image" href="#"><img src="{{ $row->product->image_url }}"  alt=""></a>
                                    <div class="cart-content">
                                        <h4 class="title">{{ $row->product->name }}</h4>
                                        <p>{{ $row->product->description }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-2 entry">
                                <div class="price">
                                    {{ Currency::format($row->product->price) }}
                                    @if($row->product->compare_price)
                                        <del>{{ Currency::format($row->product->compare_price) }}</del>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-2 entry">
                                @if($row->product->quantity > 0)
                                    <a class="instock" href="#">In stock</a>
                                @else
                                    <a class="stock" href="#">Out stock</a>
                                @endif
                            </div>
                            <div class="col-md-2 col-sm-2 entry">
                                <a class="btn btn-common add-to-cart" data-id="{{$row->product_id}}" data-quantity="1" href="#">
                                    <i class="icon-basket"></i> add to Cart
                                </a>
                            </div>
                            <div class="col-md-2 col-sm-2 entry">
                                <a class="btn-close remove-wishlist" data-id="{{ $row->id }}" href="#"><i class="icon-close"></i></a>
                            </div>
                        </div>
                        @empty
                        <div class="wishlist-entry clearfix">
                            <p style="text-align: center">No Product in the Wishlist.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    <!-- End Content -->
</x-website.website-layout>