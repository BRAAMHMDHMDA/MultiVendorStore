<!-- Start  Logo & Naviagtion  -->
<nav class="navbar navbar-default">
    <div class="container">
        <div class="row">
            <div class="navbar-header">
                <!-- Stat Toggle Nav Link For Mobiles -->
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <i class="fa fa-bars"></i>
                </button>
                @if(config('app.logo&name'))
                    <a class="navbar-brand" href="{{ route('home') }}">
                        <img src="{{ config('app.logo&name') }}" alt="">
                    </a>
                @else
                    <a class="" href="{{ route('home') }}" style="display: flex; align-items: center; justify-content: center; padding: 20px; gap: 10px;color: #3f51b5">
                        <img src="{{ config('app.logo') }}" alt="" height="40px">
                        <p style="font-size: larger; font-weight: bold; text-transform: uppercase">{{ config('app.name') }}</p>
                    </a>
                @endif
            </div>
            <div class="navbar-collapse collapse">
                <!-- Start Navigation List -->
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a @if(Route::is('home')) class="active" @endif href="{{ route('home') }}">
                            Home
                        </a>
                    </li>
                    <li>
                        @php
                            $categories = \Cache::rememberForever('categories_list', function () {
                                return \App\Models\Category::get();
                            });

                            $halfCount = $categories->count() / 2;

                            $menu1 = $categories->take($halfCount);
                            $menu2 = $categories->skip($halfCount);
//                                $categories = \App\Models\Category::get(['id','name']);
//                                $numOfCategoriesInList = $categories->count()/2;
//
//                                $menu1 = $categories->take($numOfCategoriesInList);
//                                $menu2 = $categories->slice($numOfCategoriesInList);
                        @endphp
                        <a href="#">Categories <span class="caret"></span></a>
                        <div class="dropdown mega-menu megamenu1">
                            <div class="row">
                                <div class="col-sm-3 col-xs-12">
                                    <ul class="menulinks">
                                        {{--                                        <li class="maga-menu-title">--}}
                                        {{--                                            <a href="#">Men</a>--}}
                                        {{--                                        </li>--}}
                                        @foreach($menu1 as $category)
                                            <li><a href="{{ url('/products?category_selected='.$category->slug)  }}">{{ $category->name }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="col-sm-3 col-xs-12">
                                    <ul class="menulinks">
                                        @foreach($menu2 as $category)
                                            <li><a href="{{ url('/products?category_selected='.$category->slug)  }}">{{ $category->name }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="col-sm-5 col-sm-offset-1 col-xs-12">
                                    <span class="block-last">
                                      <img src="{{ asset('website/assets/img/block_menu.jpg') }}"  alt="">
                                    </span>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <a @if(Route::is('all-products')) class="active" @endif href="{{ route('all-products') }}">
                            Products
                        </a>
                    </li>
                    <li>
                        <a @if(Route::is('all-stores')) class="active" @endif href="{{ route('all-stores') }}">
                            Stores
                        </a>
                    </li>
                    <li>
                        <a @if(Route::is('about-us')) class="active" @endif href="{{ route('about-us') }}">
                            About Us
                        </a>
                    </li>
                    <li>
                        <a @if(Route::is('contact-us')) class="active" @endif href="{{ route('contact-us') }}">
                            Contact Us
                        </a>
                    </li>
                </ul>
                <!-- End Navigation List -->
            </div>
        </div>
    </div>
    <!-- End Header Logo & Naviagtion -->

    <!-- Mobile Menu Start -->
    <ul class="mobile-menu">
        <li>
            <a class="active" href="index-2.html">
                Home
            </a>
            <ul class="dropdown">
                <li>
                    <a href="index-2.html">Home V1</a>
                </li>
                <li>
                    <a class="active" href="index-3.html">Home V2</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="about.html">About</a>
        </li>
        <li>
            <a href="#">Catalog</a>
            <ul class="dropdown menulinks">
                <li class="maga-menu-title">
                    <a href="#">Men</a>
                </li>
                <li><a href="category.html">Clothing</a></li>
                <li><a href="category.html">Handbags</a></li>
                <li><a href="category.html">Maternity</a></li>
                <li><a href="category.html">Jewelry</a></li>
                <li><a href="category.html">Scarves</a></li>
                <li class="maga-menu-title">
                    <a href="#">Women</a>
                </li>
                <li><a href="category.html">Handbags</a></li>
                <li><a href="category.html">Jewelry</a></li>
                <li><a href="category.html">Clothing</a></li>
                <li><a href="category.html">Watches</a></li>
                <li><a href="category.html">Hats</a></li>
            </ul>
        </li>
        <li>
            <a href="#">Shop</a>
            <ul class="menulinks">
                <li class="maga-menu-title">
                    <a href="#">Normal Shop Pages</a>
                </li>
                <li><a href="category.html">Single Category</a></li>
                <li><a href="product-details.html">Product Details</a></li>
                <li><a href="shopping-cart.html">Cart Page</a></li>
                <li><a href="checkout.html">Checkout Page</a></li>
                <li><a href="single-shop.html">Seller's Store</a></li>
                <li><a href="shop-grid.html">Shop Grid Sidebar</a></li>
                <li><a href="shop-list.html">Shop List Sidebar</a></li>
                <li><a href="shop-right-sidebar.html">Shop Right Sidebar</a></li>
                <li><a href="order.html">Order Track</a></li>
                <li class="maga-menu-title">
                    <a href="#">Multi-vendor Pages</a>
                </li>
                <li><a href="submission.html">Product Submission</a></li>
                <li><a href="single-shop.html">Seller Store Page</a></li>
                <li><a href="edit-profile.html">Seller Account</a></li>
                <li><a href="login.html">Log In</a></li>
                <li><a href="shop.html">Search</a></li>
            </ul>
        </li>
        <li>
            <a href="#">Pages</a>
            <ul class="dropdown">
                <li>
                    <a href="about.html">About Us</a>
                </li>
                <li>
                    <a href="services.html">Services</a>
                </li>
                <li>
                    <a href="contact.html">Contact Us</a>
                </li>
                <li>
                    <a href="product-details.html">Product Details</a>
                </li>
                <li>
                    <a href="team.html">Team Member</a>
                </li>
                <li>
                    <a href="checkout.html">Checkout</a>
                </li>
                <li>
                    <a href="compare.html">Compare</a>
                </li>
                <li>
                    <a href="shopping-cart.html">Shopping cart</a>
                </li>
                <li>
                    <a href="faq.html">FAQs</a>
                </li>
                <li>
                    <a href="wishlist.html">Wishlist</a>
                </li>
                <li>
                    <a href="404.html">404 Error</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#">Blog</a>
            <ul class="dropdown">
                <li>
                    <a href="blog.html">Blog Right Sidebar</a>
                </li>
                <li>
                    <a href="blog-left-sidebar.html">Blog Left Sidebar</a>
                </li>
                <li>
                    <a href="blog-full-width.html">Blog Full Width</a>
                </li>
                <li>
                    <a href="blog-details.html">Blog Details</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="contact.html">Contact</a>
        </li>
    </ul>
    <!-- Mobile Menu End -->
</nav>