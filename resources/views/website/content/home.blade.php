<x-website.website-layout title="Home">
    <!-- Main Content Start -->
    <section class="section gray-bg">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-4">
                    <div class="categories-wrapper white-bg">
                        <h3 class="block-title">Top Categories</h3>
                        <ul class="vertical-menu">
                            @foreach($topCategories as $category)
                                @if($category->children->count() > 0)
                                    <li class="dropdown">
                                        <a class="dropdown-toggle" data-toggle="dropdown" href="{{ url('/products?category_selected='.$category->name)  }}" role="button">
                                            {{ $category->name }} <i class="caret-right fa fa-angle-right"></i>
                                        </a>
                                        <ul class="dropdown-menu">
                                            @foreach($category->children as $child)
                                                <li><a href="{{ url('/products?category_selected='.$child->name)}}">{{ $child->name }}</a></li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @else
                                    <li>
                                        <a href="{{ url('/products?category_selected='.$category->name)  }}">{{ $category->name }}</a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-md-9 col-sm-8">
                    <div class="touch-slider owl-carousel" data-slider-pagination="true">
                        <div class="item">
                            <a href="#"><img src="{{ config('home.slider1') }}" alt=""></a>
                        </div>
                        <div class="item">
                            <a href="#"><img src="{{ config('home.slider2') }}" alt=""></a>
                        </div>
                        <div class="item">
                            <a href="#"><img src="{{ config('home.slider3') }}" alt=""></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Main Content End -->

    <!-- Feature ctg Section Start -->
    <section class="feature-categories section">
        <div class="container">
            <div class="row">
                @foreach($ADs as $AD)
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="feature-item-content">
                            <img src="{{ $AD->image_url }}"  alt="" height="500px">
                            <div class="feature-content">
                                <div class="banner-text">
                                    <h4>{{ $AD->main_title }}</h4>
                                    <p>{{ $AD->sub_title }}</p>
                                </div>
                                <a href="{{ $AD->button_link }}" target="_blank" class="btn btn-common">{{ $AD->button_text }}</a>
                            </div>
                        </div>
                    </div>

                @endforeach
{{--                <div class="col-md-4 col-sm-4 col-xs-12">--}}
{{--                    <div class="feature-item-content">--}}
{{--                        <img src="{{ asset('website/assets/img/feature/img1.jpg') }}"  alt="">--}}
{{--                        <div class="feature-content">--}}
{{--                            <div class="banner-text">--}}
{{--                                <h4>Men's Collection</h4>--}}
{{--                                <p>Summer Exclusive</p>--}}
{{--                            </div>--}}
{{--                            <a href="#" class="btn btn-common">Shop Now</a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-md-4 col-sm-4 col-xs-12">--}}
{{--                    <div class="feature-item-content">--}}
{{--                        <img src="{{ asset('website/assets/img/feature/img3.jpg') }}"  alt="">--}}
{{--                        <div class="feature-content">--}}
{{--                            <div class="banner-text">--}}
{{--                                <h4>Women's Clothing</h4>--}}
{{--                                <p>Up to <span>70%</span> OFF</p>--}}
{{--                            </div>--}}
{{--                            <a href="#" class="btn btn-common">Shop Now</a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-md-4 col-sm-4 col-xs-12">--}}
{{--                    <div class="feature-item-content mb-30">--}}
{{--                        <img src="{{ asset('website/assets/img/feature/img2.jpg') }}"  alt="">--}}
{{--                        <div class="feature-content">--}}
{{--                            <div class="banner-text accessories">--}}
{{--                                <h4>Accessories</h4>--}}
{{--                                <p>Handpicked for Men/Women</p>--}}
{{--                            </div>--}}
{{--                            <a href="#" class="btn btn-common">Shop Now</a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="feature-item-content">--}}
{{--                        <img src="{{ asset('website/assets/img/feature/img4.jpg') }}"  alt="">--}}
{{--                        <div class="feature-content">--}}
{{--                            <div class="banner-text accessories">--}}
{{--                                <h4>Kids Essentials</h4>--}}
{{--                                <p>Best Collection for Kids</p>--}}
{{--                            </div>--}}
{{--                            <a href="#" class="btn btn-common">Shop Now</a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
            </div>
        </div>
    </section>
    <!-- Feature ctg Section End -->

    <!-- Shop Collection Section Start -->
    <section id="shop-collection">
        <div class="container">
            <h1 class="section-title">New Arrivals</h1>
            <hr class="lines">
            <div class="row">
               @foreach($newArrivalsProducts as $product)
{{--                    <x-website.product-card :product="$product" wire:key="{{$product->id}}" class="col-md-3 col-sm-6 col-xs-12"/>--}}
                    <livewire:website.products.product-card :product="$product" wire:key="{{$product->id}}" class="col-md-3 col-sm-6 col-xs-12"/>

                @endforeach
            </div>
        </div>
    </section>
    <!-- Shop Collection Section End -->
    <!-- New Products Section Start-->
    <section class="section">
        <div class="container">
            <h1 class="section-title">Featured Products</h1>
            <hr class="lines">
            <div class="row">
                <div class="col-md-12">
                    <div id="new-products" class="owl-carousel">
                        @foreach($featuredProducts as $product)
                            <livewire:website.products.product-card :product="$product" wire:key="{{$product->id}}" class="item"/>
{{--                            <x-website.product-card :product="$product" class="item"/>--}}
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- New Products Section End -->

    <!-- Services Section Starts -->
    <section id="services" class="section">
        <!-- Container Starts -->
        <div class="container">
            <div class="row">
                <!-- Start Service-->
                <div class="col-md-4 col-sm-6">
                    <div class="services-box">
                        <div class="services-icon">
                            <i class="icon-people"></i>
                        </div>
                        <div class="services-content">
                            <h4><a href="#">Multi-vendor eCommerce</a></h4>
                            <p>
                                Lorem ipsum dolor sit amet isse potenti. Vesquam ante aliquet lacusemper elit.
                            </p>
                        </div>
                    </div>
                </div>
                <!-- End Service-->
                <!-- Start Service-->
                <div class="col-md-4 col-sm-6">
                    <div class="services-box">
                        <div class="services-icon">
                            <i class="icon-screen-desktop"></i>
                        </div>
                        <div class="services-content">
                            <h4><a href="#">Clean Design</a></h4>
                            <p>
                                Lorem ipsum dolor sit amet isse potenti. Vesquam ante aliquet lacusemper elit.
                            </p>
                        </div>
                    </div>
                </div>
                <!-- End Service-->
                <!-- Start Service-->
                <div class="col-md-4 col-sm-6">
                    <div class="services-box">
                        <div class="services-icon">
                            <i class="icon-basket-loaded"></i>
                        </div>
                        <div class="services-content">
                            <h4><a href="#">100+ eCommerce Elements</a></h4>
                            <p>
                                Lorem ipsum dolor sit amet isse potenti. Vesquam ante aliquet lacusemper elit.
                            </p>
                        </div>
                    </div>
                </div>
                <!-- End Service-->
                <!-- Start Service-->
                <div class="col-md-4 col-sm-6">
                    <div class="services-box">
                        <div class="services-icon">
                            <i class="icon-layers"></i>
                        </div>
                        <div class="services-content">
                            <h4><a href="#">Included Business Pages</a></h4>
                            <p>
                                Lorem ipsum dolor sit amet isse potenti. Vesquam ante aliquet lacusemper elit.
                            </p>
                        </div>
                    </div>
                </div>
                <!-- End Service-->
                <!-- Start Service-->
                <div class="col-md-4 col-sm-6">
                    <div class="services-box">
                        <div class="services-icon">
                            <i class="icon-screen-tablet"></i>
                        </div>
                        <div class="services-content">
                            <h4><a href="#">Fully Responsive</a></h4>
                            <p>
                                Lorem ipsum dolor sit amet isse potenti. Vesquam ante aliquet lacusemper elit.
                            </p>
                        </div>
                    </div>
                </div>
                <!-- End Service-->
                <!-- Start Service -->
                <div class="col-md-4 col-sm-6">
                    <div class="services-box">
                        <div class="services-icon">
                            <i class="icon-chemistry"></i>
                        </div>
                        <div class="services-content">
                            <h4><a href="#">Cutting-edge Features</a></h4>
                            <p>
                                Lorem ipsum dolor sit amet isse potenti. Vesquam ante aliquet lacusemper elit.
                            </p>
                        </div>
                    </div>
                </div>
                <!-- End Service-->
                <!-- Start Service-->
                <div class="col-md-4 col-sm-6">
                    <div class="services-box">
                        <div class="services-icon">
                            <i class="icon-settings"></i>
                        </div>
                        <div class="services-content">
                            <h4><a href="#">Completely Customizable</a></h4>
                            <p>
                                Lorem ipsum dolor sit amet isse potenti. Vesquam ante aliquet lacusemper elit.
                            </p>
                        </div>
                    </div>
                </div>
                <!-- End Service-->
                <!-- Start Service-->
                <div class="col-md-4 col-sm-6">
                    <div class="services-box">
                        <div class="services-icon">
                            <i class="icon-rocket"></i>
                        </div>
                        <div class="services-content">
                            <h4><a href="#">Fast and Well-optimized</a></h4>
                            <p>
                                Lorem ipsum dolor sit amet isse potenti. Vesquam ante aliquet lacusemper elit.
                            </p>
                        </div>
                    </div>
                </div>
                <!-- End Service-->
                <!-- Start Service -->
                <div class="col-md-4 col-sm-6">
                    <div class="services-box">
                        <div class="services-icon">
                            <i class="icon-umbrella"></i>
                        </div>
                        <div class="services-content">
                            <h4><a href="#">Rich Doc and Support</a></h4>
                            <p>
                                Lorem ipsum dolor sit amet isse potenti. Vesquam ante aliquet lacusemper elit.
                            </p>
                        </div>
                    </div>
                </div>
                <!-- End Service-->
            </div>
        </div>
        <!-- Container Ends -->
    </section>
    <!-- Services Section Ends -->

    <!-- Start Testimonial Section  -->
    <div class="testimonial section">
        <div class="container">
            <div class="row">
                <!-- Testimonial section  -->
                <div class="testimonials-carousel owl-carousel">
                    @foreach($testimonials as $testimonial)
                        <div class="item">
                            <div class="testimonial-item">
                                <div class="img">
                                    <a href="#"><img src="{{ $testimonial->image_url }}"  alt=""></a>
                                </div>
                                <div class="datils">
                                    <p class="">“ {!! $testimonial->content !!}  “</p>
                                    <h5>{{ $testimonial->name }}</h5>
                                    <span>- {{ $testimonial->job_title }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
    <!-- End Testimonial Section  -->

    <!-- List Cart Products Start -->
    <section class="listcart-products section">
        <div class="container">
            <h1 class="section-title">Recommended For You</h1>
            <hr class="lines">
            <div class="row">
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="listcartproducts">
                        <h2 class="title-cart">Men's</h2>
                        <div class="products-item-inner">
                            <div class="products-item">
                                <div class="left">
                                    <a href="product-details.html"><img src="{{ asset('website/assets/img/products/p1.jpg') }}" alt=""></a>
                                    <a href="product-details.html" class="quick-view"><i class="icon-magnifier"></i></a>
                                </div>
                                <div class="right">
                                    <h5 class="product-name">Floral Print Buttoned</h5>
                                    <div class="reviews-icon">
                                        <i class="i-color fa fa-star"></i>
                                        <i class="i-color fa fa-star"></i>
                                        <i class="i-color fa fa-star"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                    </div>
                                    <div class="price">
                                        $ 49.00
                                    </div>
                                </div>
                            </div>
                            <div class="products-item">
                                <div class="left">
                                    <a href="product-details.html"><img src="{{ asset('website/assets/img/products/p2.jpg') }}" alt=""></a>
                                    <a href="product-details.html" class="quick-view"><i class="icon-magnifier"></i></a>
                                </div>
                                <div class="right">
                                    <h5 class="product-name">Floral Print Buttoned</h5>
                                    <div class="reviews-icon">
                                        <i class="i-color fa fa-star"></i>
                                        <i class="i-color fa fa-star"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                    </div>
                                    <div class="price">
                                        $ 12.00
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="listcartproducts">
                        <h2 class="title-cart">Women's</h2>
                        <div class="products-item-inner">
                            <div class="products-item">
                                <div class="left">
                                    <a href="product-details.html"><img src="{{ asset('website/assets/img/products/p3.jpg') }}" alt=""></a>
                                    <a href="product-details.html" class="quick-view"><i class="icon-magnifier"></i></a>
                                </div>
                                <div class="right">
                                    <h5 class="product-name">Floral Print Buttoned</h5>
                                    <div class="reviews-icon">
                                        <i class="i-color fa fa-star"></i>
                                        <i class="i-color fa fa-star"></i>
                                        <i class="i-color fa fa-star"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                    </div>
                                    <div class="price">
                                        $ 59.00
                                        <span class="old-price">$ 69.78</span>
                                    </div>
                                </div>
                            </div>
                            <div class="products-item">
                                <div class="left">
                                    <a href="product-details.html"><img src="{{ asset('website/assets/img/products/p4.jpg') }}" alt=""></a>
                                    <a href="product-details.html" class="quick-view"><i class="icon-magnifier"></i></a>
                                </div>
                                <div class="right">
                                    <h5 class="product-name">Floral Print Buttoned</h5>
                                    <div class="reviews-icon">
                                        <i class="i-color fa fa-star"></i>
                                        <i class="i-color fa fa-star"></i>
                                        <i class="i-color fa fa-star"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                    </div>
                                    <div class="price">
                                        $ 19.00
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="listcartproducts">
                        <h2 class="title-cart">Accessories</h2>
                        <div class="products-item-inner">
                            <div class="products-item">
                                <div class="left">
                                    <a href="product-details.html"><img src="{{ asset('website/assets/img/products/p5.jpg') }}" alt=""></a>
                                    <a href="product-details.html" class="quick-view"><i class="icon-magnifier"></i></a>
                                </div>
                                <div class="right">
                                    <h5 class="product-name">Floral Print Buttoned</h5>
                                    <div class="reviews-icon">
                                        <i class="i-color fa fa-star"></i>
                                        <i class="i-color fa fa-star"></i>
                                        <i class="i-color fa fa-star"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                    </div>
                                    <div class="price">
                                        $ 36.60
                                    </div>
                                </div>
                            </div>
                            <div class="products-item">
                                <div class="left">
                                    <a href="product-details.html"><img src="{{ asset('website/assets/img/products/p6.jpg') }}" alt=""></a>
                                    <a href="product-details.html" class="quick-view"><i class="icon-magnifier"></i></a>
                                </div>
                                <div class="right">
                                    <h5 class="product-name">Floral Print Buttoned</h5>
                                    <div class="reviews-icon">
                                        <i class="i-color fa fa-star"></i>
                                        <i class="i-color fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                    </div>
                                    <div class="price">
                                        $ 12.00
                                        <span class="old-price">$ 16.78</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- List Cart Products End -->

    <!-- Start Client Section -->
    <div class="client section">
        <div class="container">
            <div class="row">
                <div id="client-logo" class="owl-carousel">
                    @foreach($brands as $brand)
                        <div class="client-logo item">
                            <a href="#">
                                <img src="{{$brand->image_url}}" alt="" />
                            </a>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
    <!-- End Client Section -->

    <!-- Support Section Start -->
    <div class="support section">
        <div class="container">
            <div class="row">
                <div class="support-inner">
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="row-normal clearfix">
                            <div class="support-info">
                                <div class="info-title">
                                    <i class="icon-plane"></i>
                                    Free Shipping Worldwide
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="row-normal clearfix">
                            <div class="support-info">
                                <div class="info-title">
                                    <i class="icon-earphones-alt"></i>
                                    24/7 Customer Service
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="row-normal clearfix">
                            <div class="support-info">
                                <div class="info-title">
                                    <i class="icon-refresh"></i>
                                    Easy Return Policy
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Support Section End -->

</x-website.website-layout>