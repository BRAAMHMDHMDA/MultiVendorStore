
<div class="{{ $class ?? 'col-md-12' }}">
    <div class="shop-product clearfix">
        <div class="product-box">
            <a href="#"><img src="{{ $store->cover_image }}"  alt="{{ $store->slug }}" height="250px"></a>
            <div class="actions">
                <div class="add-to-links">
                    <a href="#" class="btn-wish"><i class="icon-heart"></i></a>
                    <a  class="btn-quickview md-trigger" data-modal="modal-3"><i class="icon-eye"></i></a>
                </div>
            </div>
        </div>
        <div class="product-info">
            <div class="fix">
                <h4 class="product-title pull-left"><a href="{{ route('store-details', $store->slug) }}">{{ $store->name }}</a></h4>
                <div class="star-rating pull-right">
                    <div class="reviews-icon">
                        <i class="i-color fa fa-star"></i>
                        <i class="i-color fa fa-star"></i>
                        <i class="i-color fa fa-star"></i>
                        <i class="fa fa-star-o"></i>
                        <i class="fa fa-star-o"></i>
                    </div>
                </div>
            </div>
            <div class="fix mb-10" style="margin-top: 10px; margin-bottom: 20px">
                <div class="meta">
                    <span class="meta-part"><a href="#"><i class="icon-user"></i> Store Owner</a></span>
                    <span class="meta-part"><a href="#"><i class="icon-speech"></i> 245 Product</a></span>
                    <span class="meta-part"><a href="#"><i class="icon-calendar"></i> {{ $store->created_at->diffForHumans() }}</a></span>
                </div>
            </div>
            <div class="product-description mb-20">
                <p>{{ $store->description }}</p>
            </div>
{{--            <button class="btn btn-common"><i class="fa fa-heart-o" aria-hidden="true"></i> Add to wishlist</button>--}}
        </div>
    </div>
</div>
