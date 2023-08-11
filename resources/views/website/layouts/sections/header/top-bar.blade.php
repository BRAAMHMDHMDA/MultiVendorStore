<!-- Start Top Bar -->
<div class="top-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-2">
                <div class="language-wrapper">
                    <div class="box-currency" >
                        <form method="post" id="form-currency">
                            <div class="btn-group toggle-wrap">
                      <span class="toggle">
                        $USD
                      </span>
                                <ul class="toggle_cont pull-right">
                                    <li>
                                        <button class="currency-select selected" type="button" name="USD">
                                            $ USD </button>
                                    </li>
                                    <li>
                                        <button class="currency-select" type="button" name="EUR">
                                            € EUR
                                        </button>
                                    </li>
                                    <li>
                                        <button class="currency-select" type="button" name="GBP">
                                            £ GBP </button>
                                    </li>
                                </ul>
                            </div>
                        </form>
                    </div>
                    <a href="#"><i class="icon-phone"></i> Call Us: (123) 456- 789</a>
                </div>
                <div class="clear"></div>
            </div>
            <div class="col-md-9 col-sm-10">
                <!-- shopping cart end -->
                <div class="search-area">
                    <form>
                        <div class="control-group">
                            <ul class="categories-filter animate-dropdown">
                                <li class="dropdown"> <a class="dropdown-toggle" data-toggle="dropdown" href="category.html">Categories <span class="caret"></span></a>
                                    <ul class="dropdown-menu animated fadeIn">
                                        <li class="menu-header">Clothing</li>
                                        <li><a tabindex="-1" href="#">- Men</a></li>
                                        <li><a tabindex="-1" href="#">- Women</a></li>
                                        <li><a tabindex="-1" href="#">- Boys</a></li>
                                        <li><a tabindex="-1" href="#">- Girls</a></li>
                                        <li class="menu-header">Electronics</li>
                                        <li><a tabindex="-1" href="#">- Laptops</a></li>
                                        <li><a tabindex="-1" href="#">- Desktops</a></li>
                                        <li><a tabindex="-1" href="#">- Cameras</a></li>
                                        <li><a tabindex="-1" href="#">- Mobile Phones</a></li>
                                    </ul>
                                </li>
                            </ul>
                            <input class="search-field" placeholder="Search here...">
                            <a class="search-button" href="#"><i class="icon-magnifier"></i></a>
                        </div>
                    </form>
                </div>

                <div class="shop-cart">
                    <ul>
                        <li><a class="cart-icon cart-btn" href="wishlist.html"><span class="icon-heart"></span></a></li>
                        <li>
                            <a href="#" class="cart-icon cart-btn"><i class="icon-basket"></i><span class="cart-label">3</span></a>
                            <div class="cart-box">
                                <div class="popup-container">
                                    <div class="cart-entry">
                                        <a href="#" class="image">
                                            <img src="{{ asset('website/assets/img/products/product-menu-1.jpg') }}"  alt="">
                                        </a>
                                        <div class="content">
                                            <a href="#" class="title">Pullover Batwing</a>
                                            <p class="quantity">Quantity: 3</p>
                                            <span class="price">$45.00</span>
                                        </div>
                                        <div class="button-x">
                                            <i class="icon-close"></i>
                                        </div>
                                    </div>
                                    <div class="cart-entry">
                                        <a href="#" class="image">
                                            <img src="{{ asset('website/assets/img/products/product-menu-2.jpg') }}"  alt="">
                                        </a>
                                        <div class="content">
                                            <a href="#" class="title">Pullover Batwing</a>
                                            <p class="quantity">Quantity: 3</p>
                                            <span class="price">$90.00</span>
                                        </div>
                                        <div class="button-x">
                                            <i class="icon-close"></i>
                                        </div>
                                    </div>
                                    <div class="summary">
                                        <div class="subtotal">Sub Total</div>
                                        <div class="price-s">$210.5</div>
                                    </div>
                                    <div class="cart-buttons">
                                        <a href="#" class="btn btn-border-2">View Cart</a>
                                        <a href="#" class="btn btn-common">Checkout</a>
                                        <div class="clear"></div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                @auth('web')
                    <div class="account link-inline">
                        <a href="{{ route('logout') }}"><i class="icon-logout"></i><span class="hidden-mobile">logout</span></a>
                    </div>
                    <div href="#" style="padding: 15px"><i class="icon-user" ></i> Hi, {{ Auth::user()->name }}</div>
                @else
                    <div class="account link-inline">
                        <a href="{{ route('login') }}"><i class="icon-login"></i><span class="hidden-mobile">login/register</span></a>
                    </div>
                @endauth

            </div>
        </div>
    </div>
</div>
<!-- End Top Bar -->