<div class="{{ $class ?? 'col-md-4 col-sm-6 col-xs-12' }}">

<div class="shop-product">
    <div class="product-box">
        <a href="#"><img src="{{ $product->image_url }}"  alt="{{ $product->slug }}" height="250px"></a>
        <div class="cart-overlay"></div>
        @if($product->new)
            <span class="sticker new"><strong>NEW</strong></span>
        @endif
        @if($product->sale_percentage && $product->sale_percentage>=20)
            <span class="sticker discount"><strong>-{{$product->sale_percentage}}%</strong></span>
        @endif
        <div class="actions">
            <div class="add-to-links">
                <a href="#" class="btn-cart"><i class="icon-basket"></i></a>
                <a href="#" class="btn-wish"><i class="icon-heart"></i></a>
                <a  class="btn-quickview md-trigger" data-modal="{{ $product->slug }}"><i class="icon-eye"></i></a>
            </div>
        </div>
    </div>
    <div class="product-info">
        <h4 class="product-title"><a href="{{ route('product-details', $product->slug) }}">{{$product->name}}</a></h4>
        <div class="align-items">
            <div class="pull-left">
                <span class="price">${{$product->format_price}}
                    @if ($product->compare_price)
                        <del>{{$product->format_compare_price}}</del>
                    @endif
                </span>
            </div>
            <div class="pull-right">
                <div class="reviews-icon">
                    <i class="i-color fa fa-star"></i>
                    <i class="i-color fa fa-star"></i>
                    <i class="i-color fa fa-star"></i>
                    <i class="fa fa-star-o"></i>
                    <i class="fa fa-~star-o"></i>
                </div>
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
                    <h1 class="product-title">{{ $product->name }}</h1>
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
                    </div>
                    <!-- Product Size -->
{{--                    <div class="product-size">--}}
{{--                        <h5 class="sub-title">Select Size</h5>--}}
{{--                        <span>S</span>--}}
{{--                        <span class="active">M</span>--}}
{{--                        <span>L</span>--}}
{{--                        <span>XL</span>--}}
{{--                    </div>--}}
                    <!-- Quantity Cart -->
                    <div class="quantity-cart" style="margin-top: 50px">
                        <button class="btn btn-common"><i class="icon-basket"></i> add to cart</button>
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