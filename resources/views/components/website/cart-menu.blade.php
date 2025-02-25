<div  id="cart-menu-container">
    <div class="shop-cart">
        <ul>
            <li><a class="cart-icon cart-btn" href="{{ route('wishlist') }}"><span class="icon-heart"></span></a></li>
            <li>
                <a href="#" class="cart-icon cart-btn"><i class="icon-basket"></i><span class="cart-label">{{$items->count()}}</span></a>
                <div class="cart-box">
                    <div class="popup-container">
                        @if($items->count()!==0)
                            @foreach($items as $item)
                                <div class="cart-entry" id="m{{$item->id}}">
                                    <a href="{{route('product-details',$item->product->slug)}}" class="image">
                                        <img src="{{ $item->product->image_url }}"  alt="{{ $item->product->slug }}">
                                    </a>
                                    <div class="content">
                                        <a href="{{route('product-details',$item->product->slug)}}" class="title">{{ $item->product->name }}</a>
                                        <p class="quantity">Quantity: {{ $item->quantity }}</p>
                                        <span class="price">{{ Currency::format($item->product->price) }} x {{ $item->quantity }}</span>
                                    </div>
                                    <button class="button-x" onclick="removeProduct('{{$item->id}}')">
                                        {{--                                <a class="icon-close remove-item" data-id="{{ $item->id }}" id="{{ $item->id }}"></a>--}}
                                        <a class="btn-close"><i class="icon-close"></i></a>
                                    </button>
                                </div>
                            @endforeach
                            <div class="summary">
                                <div class="subtotal">Sub Total</div>
                                <div class="price-s">{{ Currency::format($total) }}</div>
                            </div>
                            <div class="cart-buttons">
                                <a href="{{ route('cart.index') }}" class="btn btn-border-2">View Cart</a>
                                <a href="{{ route('checkout') }}" class="btn btn-common">Checkout</a>
                                <div class="clear"></div>
                            </div>
                        @else
                            <p>There are No Products in the Cart.. </p>
                        @endif
                    </div>
                </div>
            </li>
        </ul>
    </div>
</div>