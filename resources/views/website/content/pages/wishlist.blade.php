<div>
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
                            <p>Stock Status</p>
                        </div>
                        <div class="col-md-2 col-sm-2">
                            <p>Add to Cart</p>
                        </div>
                        <div class="col-md-2 col-sm-2">
                            <p>Remove</p>
                        </div>
                    </div>
                    @forelse($wishlist as $item)
                        <div class="wishlist-entry clearfix"  id="{{ $item->id }}">
                            <div class="col-md-4 col-sm-4">
                                <div class="cart-entry">
                                    <a class="image" href="{{route('product-details',$item->product->slug)}}">
                                        <img src="{{ $item->product->image_url }}"  alt="">
                                    </a>
                                    <div class="cart-content">
                                        <h4 class="title">
                                            <a href="{{route('product-details',$item->product->slug)}}">
                                                {{ $item->product->name }}
                                            </a>
                                        </h4>
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
                            <div class="col-md-2 col-sm-2 entry">
                                @if($item->product->quantity > 0)
                                    <a class="instock" href="#">In stock</a>
                                @else
                                    <a class="stock" href="#">Out stock</a>
                                @endif
                            </div>
                            <div class="col-md-2 col-sm-2 entry">
{{--                                <a class="btn btn-common add-to-cart" data-id="{{$item->product_id}}" data-quantity="1" href="#">--}}
{{--                                    <i class="icon-basket"></i> add to Cart--}}
{{--                                </a>--}}
                                <button class="btn btn-common position-relative"
                                        x-data="{ loading: false }"
                                        @click="loading = true; $wire.emit('addToCart', {{ $item->product_id }})"
                                        x-on:added-cart.window="loading = false"
                                        :disabled="loading"
                                        style="margin-top: 15px"
                                >
                                <span x-show="!loading">
                                    <i class="icon-basket"></i> Add to Cart
                                </span>
                                    <span x-cloak x-show="loading">
                                     <i class="icon-basket-loaded fa-spin" ></i> Adding...
                                </span>
                                </button>
                            </div>
                            <div class="col-md-2 col-sm-2 entry">
                                <a
                                        class="btn-close"
                                        wire:click="delete('{{ $item->id }}')"
                                        wire:loading.attr="disabled"
                                >
                                    <i class="icon-close" wire:loading.remove wire:target="delete('{{ $item->id }}')" style="cursor: pointer"></i>
                                    <i class="glyphicon glyphicon-refresh fa-spin" wire:loading  wire:target="delete('{{ $item->id }}')"></i>
                                </a>
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
</div>