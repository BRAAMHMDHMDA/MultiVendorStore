<!-- Footer Start -->
<footer class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-6">
                <div class="contact-us">
                    <h3 class="widget-title">Contact Us</h3>
                    <ul class="contact-list">
                        <li style="margin-bottom: 25px"><i class="icon-home"></i> <span>{{ config('contact.locationAddress') }}</span></li>
                        <li style="margin-bottom: 25px"><i class="icon-call-out"></i> {{ config('contact.telephone') }}</li>
                        <li style="margin-bottom: 25px"><i class="icon-envelope"></i> {{ config('contact.email') }}</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <h3 class="widget-title">Useful Links</h3>
                <ul>
                    <li><a href="{{route('account')}}">My Account</a></li>
                    <li><a href="{{route('contact-us')}}">Contact</a></li>
                    <li><a href="{{route('cart.index')}}">My Cart</a></li>
                    <li><a href="{{route('wishlist')}}">Wishlist</a></li>
                    <li><a href="{{route('checkout')}}">Checkout</a></li>
                    <li><a href="{{route('all-products')}}">Products</a></li>
                    <li><a href="{{route('all-stores')}}">Stores</a></li>
                </ul>
            </div>
            @php
                $tags = \App\Models\Tag::latest()->limit(10)->get();
            @endphp
            <div class="col-md-3 col-sm-6">
                <h3 class="widget-title">Product Tags</h3>
                <div class="tagcloud">
                    @foreach($tags as $tag)
                        <a href="{{route('all-products')}}?tags_selected[0]={{$tag->slug}}" class="tag-link">{{$tag->name}}</a>
                    @endforeach
{{--                    <a href="#" class="tag-link">Accessories</a>--}}
{{--                    <a href="#" class="tag-link">Bags</a>--}}
{{--                    <a href="#" class="tag-link">Bestseller</a>--}}
{{--                    <a href="#" class="tag-link">Handpicked</a>--}}
{{--                    <a href="#" class="tag-link">Dresses</a>--}}
{{--                    <a href="#" class="tag-link">Men Fashion</a>--}}
{{--                    <a href="#" class="tag-link">Sell Off</a>--}}
{{--                    <a href="#" class="tag-link">Shoes</a>--}}
{{--                    <a href="#" class="tag-link">Specials</a>--}}
{{--                    <a href="#" class="tag-link">Tops</a>--}}
{{--                    <a href="#" class="tag-link">Women Fashion</a>--}}
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="block-subscribe">
                    <h3 class="widget-title">Newsletter</h3>
                    <p>Quisque a nunc interdum tellus placerat cursus. Quisque facilisis dapibus facilisis! Vivamus dictum lectus ut porta volutpat.</p>
                    <form class="subscribe" >
                        <input type="text" class="form-control" name="email" placeholder="Enter Email">
                        <button type="submit" class="btn btn-common">Subscribe</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer End -->