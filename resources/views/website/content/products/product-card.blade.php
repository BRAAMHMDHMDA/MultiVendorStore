<div class="{{ $class ?? 'col-md-4 col-sm-6 col-xs-12' }}">

    <div class="shop-product">
        <div class="product-box">
            <a href="#"><img src="{{ $product->image_url }}"  alt="{{ $product->slug }}" height="250px"></a>
            <div class="cart-overlay"></div>
            @if($product->new)
                <span class="sticker new"><strong>NEW</strong></span>
            @endif
            @if($product->sale_percentage && $product->sale_percentage>=20)
                <span class="sticker discount"><strong>{{$product->sale_percentage}}%</strong></span>
            @endif
            <div class="actions">
                <div class="add-to-links">
                    <a
                            class="btn-cart"
                            x-data="{ loading: false }"
                            @click="loading = true; $wire.emit('addToCart', {{ $product->id }})"
                            @added-cart.window="loading = false"
                            :disabled="loading"
                    >
                        <i class="icon-basket" x-show="!loading"></i>
                        <i class="icon-check" x-show="loading"></i>
                    </a>
                    <a class="btn-wish" wire:click="toggleFav({{ $product->id }})" wire:loading.attr="disabled">
                        @if($isFav)
                            <i class="glyphicon glyphicon-heart" style="color: red; font-size: 16px"></i>
                        @else
                            <i class="icon-heart"></i>
                        @endif
                    </a>
                    <a  class="btn-quickview md-trigger" data-modal="{{ $product->slug }}"><i class="icon-eye"></i></a>
                </div>
            </div>
        </div>
        <div class="product-info">
            <h4 class="product-title"><a href="{{ route('product-details', $product->slug) }}">{{$product->name}}</a></h4>
            <div class="meta">
            <span class="meta-part" style="font-size: smaller">
                <i class="icon-tag"></i>
                {{$product->category->name}}
                <br>

            </span>

            </div>
            <div class="align-items">
                <div class="pull-left">
                <span class="price">{{$product->format_price}}
                    @if ($product->compare_price)
                        <del>{{$product->format_compare_price}}</del>
                    @endif
                </span>
                </div>
                <div class="pull-right">
                            <span class="meta-part" style="font-size: smaller">

                <i class="icon-home"></i>
                {{$product->store->name}}
                            </span>
                    {{--                <div class="reviews-icon">--}}
                    {{--                    <i class="i-color fa fa-star"></i>--}}
                    {{--                    <i class="i-color fa fa-star"></i>--}}
                    {{--                    <i class="i-color fa fa-star"></i>--}}
                    {{--                    <i class="fa fa-star-o"></i>--}}
                    {{--                    <i class="fa fa-~star-o"></i>--}}
                    {{--                </div>--}}

                </div>
            </div>
        </div>
    </div>
    <!-- All modals added here for the demo -->
    <div class="md-modal md-effect-3" id="{{$product->slug}}">
        <div class="md-content">
            <!-- Product Info Start -->
            <div class="product-info row">
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="product-details-image">
                        <div class="slider-for slider">
                            <div>
                                <img src="{{  $product->image_url }}" alt="">
                            </div>
                            <div>
                                <img src="{{  $product->image_url }}" alt="">
                            </div>
                        </div>
                        <ul id="productthumbnail" class="slider slider-nav">
                            <li>
                                <img src="{{  $product->image_url }}" alt="">
                            </li>
                            <li>
                                <img src="{{  $product->image_url }}" alt="">
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-8 col-sm-6 col-xs-12">
                    <div class="info-panel">
                        <div style="display: flex; justify-content: space-between;">
                            <h1 class="product-title">{{ $product->name }}</h1>
                            <p style="font-size: small; margin-right: 45px;padding-top: 10px">
                                <i class="icon-home"></i>
                                {{$product->store->name}}
                            </p>
                        </div>
                        <!-- Rattion Price -->
                        <div class="price-ratting">
                            <div class="price float-left">
                                {{ $product->price }}$
                            </div>
                        </div>
                        <!-- Short Description -->
                        <div class="short-desc">
                            <h5 class="sub-title"> Description</h5>
                            <p>{{ $product->description }}</p>
                        </div>
                        <div class="short-desc">
                            <h5 class="sub-title">tags</h5>
                            @foreach($product->tags as $tag)
                                <span>{{ $tag->name }}</span>
                            @endforeach
                            <br>

                        </div>
                        {{--                    <div class="short-desc">--}}
                        {{--                        <h6 class="sub-title">Store Name</h6>--}}

                        {{--                        --}}
                        {{--                    </div>--}}
                        <!-- Product Size -->
                        {{--                    <div class="product-size">--}}
                        {{--                        <h5 class="sub-title">Select Size</h5>--}}
                        {{--                        <span>S</span>--}}
                        {{--                        <span class="active">M</span>--}}
                        {{--                        <span>L</span>--}}
                        {{--                        <span>XL</span>--}}
                        {{--                    </div>--}}
                        <!-- Quantity Cart -->
                        <div class="quantity-cart" style="margin-top: 30px">
                            @if($product->quantity != 0)
                                <div>
                                    <span style="color: #00b300;font-size: large;">In Stock </span>
                                    <span style="font-size: small">{{ $product->quantity }}</span>
                                </div>
                                <button class="btn btn-common position-relative"
                                        x-data="{ loading: false }"
                                        @click="loading = true; $wire.emit('addToCart', {{ $product->id }})"
                                        x-on:added-cart.window="loading = false"
                                        :disabled="loading"
                                        style="margin-top: 15px"
                                >
                                    <span x-show="!loading">
                                        <i class="icon-basket"></i> Add to Cart
                                    </span>
                                        <span x-show="loading">
                                         <i class="icon-basket-loaded fa-spin" ></i> Adding...
                                    </span>
                                </button>

                            @else
                                <span style="color: #5b0101;font-size: large">Out Stock </span>
                                <button class="add-to-cart btn btn-common disabled" style="margin-top: 15px" data-id="{{ $product->id }}" data-quantity="1"><i class="icon-basket"></i> add to cart</button>
                            @endif
                        </div>

                        <!-- Share -->
                        <div class="share-icons pull-right">
                            <span>share :</span>
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                            <a href="#"><i class="fa fa-pinterest"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Product Info End -->
            <button class="md-close"><i class="icon-close"></i></button>
        </div>
    </div>
    <div class="md-overlay"></div>
    <!-- the overlay element -->

</div>
