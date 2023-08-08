<x-website.website-layout title="store">
    <x-website.breadcrumb current="store" title="store"/>
    <!-- Product Categories Section Start -->
    <div id="content" class="product-area">
        <div class="container">
            <div class="row">
                <div class="col-md-9 col-sm-8 col-xs-12">
                    <div class="shop-content">
                        <div class="col-md-12">
                            <div class="product-option mb-30 clearfix">
                                <ul class="shop-tab">
                                    <li class="active"><a aria-expanded="true" href="#grid-view" data-toggle="tab"><i class="icon-grid"></i></a></li>
                                    <li><a aria-expanded="false" href="#list-view" data-toggle="tab"><i class="icon-list"></i></a></li>
                                </ul>
                                <!-- Size end -->
                                <div class="showing text-right">
                                    <p class="hidden-xs">Showing 01-09 of 17 Results</p>
                                </div>
                            </div>
                        </div>

                        <div class="tab-content">
                            <div id="grid-view" class="tab-pane active">
                                @foreach($store->products as $product)
                                    <x-website.product-card :product="$product" class="col-md-4 col-sm-6 col-xs-12"/>
                                @endforeach
                            </div>
                            <div id="list-view" class="tab-pane">
                                <div class="shop-list">
                                    <div class="col-md-12">
                                        <div class="shop-product clearfix">
                                            <div class="product-box">
                                                <a href="#"><img src="assets/img/products/img-01.jpg"  alt=""></a>
                                                <div class="cart-overlay">
                                                </div>
                                                <div class="actions">
                                                    <div class="add-to-links">
                                                        <a href="#" class="btn-cart"><i class="icon-basket"></i></a>
                                                        <a href="#" class="btn-wish"><i class="icon-heart"></i></a>
                                                        <a  class="btn-quickview md-trigger" data-modal="modal-3"><i class="icon-eye"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-info">
                                                <div class="fix">
                                                    <h4 class="product-title pull-left"><a href="product-details.html">Qui Ratione Volup</a></h4>
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
                                                <div class="fix mb-10">
                                                    <span class="price">$ 56.20</span>
                                                    <span class="old-price font-16px ml-10"><del>$ 96.20</del></span>
                                                </div>
                                                <div class="product-description mb-20">
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptate pariatur tenetur fugiat quasi corrupti rerum officiis doloribus, cumque, culpa optio officia voluptatum fugit quis.</p>
                                                </div>
                                                <button class="btn btn-common"><i class="fa fa-heart-o" aria-hidden="true"></i> Add to wishlist</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="shop-product clearfix">
                                            <div class="product-box">
                                                <a href="#"><img src="assets/img/products/img-02.jpg"  alt=""></a>
                                                <div class="cart-overlay">
                                                </div>
                                                <div class="actions">
                                                    <div class="add-to-links">
                                                        <a href="#" class="btn-cart"><i class="icon-basket"></i></a>
                                                        <a href="#" class="btn-wish"><i class="icon-heart"></i></a>
                                                        <a  class="btn-quickview md-trigger" data-modal="modal-3"><i class="icon-eye"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-info">
                                                <div class="fix">
                                                    <h4 class="product-title pull-left"><a href="product-details.html">Eius Modi Tempo</a></h4>
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
                                                <div class="fix mb-10">
                                                    <span class="price">$ 56.20</span>
                                                </div>
                                                <div class="product-description mb-20">
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptate pariatur tenetur fugiat quasi corrupti rerum officiis doloribus, cumque, culpa optio officia voluptatum fugit quis.</p>
                                                </div>
                                                <button class="btn btn-common"><i class="fa fa-heart-o" aria-hidden="true"></i> Add to wishlist</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="shop-product clearfix">
                                            <div class="product-box">
                                                <a href="#"><img src="assets/img/products/img-03.jpg"  alt=""></a>
                                                <div class="cart-overlay">
                                                </div>
                                                <div class="actions">
                                                    <div class="add-to-links">
                                                        <a href="#" class="btn-cart"><i class="icon-basket"></i></a>
                                                        <a href="#" class="btn-wish"><i class="icon-heart"></i></a>
                                                        <a  class="btn-quickview md-trigger" data-modal="modal-3"><i class="icon-eye"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-info">
                                                <div class="fix">
                                                    <h4 class="product-title pull-left"><a href="product-details.html">Quia Voluptas Sit</a></h4>
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
                                                <div class="fix mb-10">
                                                    <span class="price">$ 56.20</span>
                                                    <span class="old-price font-16px ml-10"><del>$ 96.20</del></span>
                                                </div>
                                                <div class="product-description mb-20">
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptate pariatur tenetur fugiat quasi corrupti rerum officiis doloribus, cumque, culpa optio officia voluptatum fugit quis.</p>
                                                </div>
                                                <button class="btn btn-common"><i class="fa fa-heart-o" aria-hidden="true"></i> Add to wishlist</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="shop-product clearfix">
                                            <div class="product-box">
                                                <a href="#"><img src="assets/img/products/img-04.jpg"  alt=""></a>
                                                <div class="cart-overlay">
                                                </div>
                                                <div class="actions">
                                                    <div class="add-to-links">
                                                        <a href="#" class="btn-cart"><i class="icon-basket"></i></a>
                                                        <a href="#" class="btn-wish"><i class="icon-heart"></i></a>
                                                        <a  class="btn-quickview md-trigger" data-modal="modal-3"><i class="icon-eye"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-info">
                                                <div class="fix">
                                                    <h4 class="product-title pull-left"><a href="product-details.html">An Tium Lores Eos</a></h4>
                                                    <div class="star-rating pull-right">
                                                        <div class="reviews-icon">
                                                            <i class="i-color fa fa-star"></i>
                                                            <i class="i-color fa fa-star"></i>
                                                            <i class="i-color fa fa-star"></i>
                                                            <i class="i-color fa fa-star"></i>
                                                            <i class="fa fa-star-o"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="fix mb-10">
                                                    <span class="price">$ 56.20</span>
                                                </div>
                                                <div class="product-description mb-20">
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptate pariatur tenetur fugiat quasi corrupti rerum officiis doloribus, cumque, culpa optio officia voluptatum fugit quis.</p>
                                                </div>
                                                <button class="btn btn-common"><i class="fa fa-heart-o" aria-hidden="true"></i> Add to wishlist</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Start Pagination -->
                    <div class="pagination">
                        <div class="results-navigation pull-left">
                            Showing: 1 - 6 Of 17
                        </div>
                        <nav class="navigation pull-right">
                            <a class="next-page" href="#"><i class="fa fa-angle-left"></i></a>
                            <span class="current page-num">1</span>
                            <a class="page-num" href="#">2</a>
                            <a class="page-num" href="#">3</a>
                            <div class="divider">...</div>
                            <a class="next-page" href="#"><i class="fa fa-angle-right"></i></a>
                        </nav>
                    </div>
                    <!-- End Pagination -->
                </div>

                <div class="col-md-3 col-sm-4 col-xs-12">
                    <div class="widget-ct widget-profile mb-30">
                        <div class="widget-s-title">
                            <h4>Shop Details</h4>
                        </div>
                        <div class="info">
                            <a href="#"><img src="{{$store->cover_image}}" alt=""></a>
                            <h4 class="name">{{$store->name}}</h4>
                            <ul class="contacts-list">
                                <li><i class="icon-screen-smartphone"></i> 0800 123 4567</li>
                                <li><i class="icon-phone"></i> +1 800 123 4567</li>
                                <li><i class="icon-envelope"></i> email@xyz.com</li>
                            </ul>
                            <p>
                                {{$store->description}}
                                <br>
                                <a class="btn btn-common" href="#">Contact</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Product Categories Section End -->
</x-website.website-layout>