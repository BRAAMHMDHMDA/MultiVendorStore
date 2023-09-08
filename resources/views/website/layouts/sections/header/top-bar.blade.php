<!-- Start Top Bar -->
<div class="top-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-2">
                <div class="language-wrapper">
                    <div class="box-currency" >
                        <form method="post" action="{{ route('currency') }}">
                            @csrf
                            <div class="btn-group toggle-wrap">
                                @php
                                    $chosenCurrency = Session::get('currency_code', Config::get('app.currency_default'));
                                @endphp
                                <span class="toggle">{{$chosenCurrency ==='USD' ? '' : $chosenCurrency }}{{Symfony\Component\Intl\Currencies::getSymbol($chosenCurrency)}} </span>
                                <ul class="toggle_cont pull-right">
                                    <li>
                                        <button class="currency-select @if($chosenCurrency==='USD') selected @endif" type="submit" name="currency_code" value="USD">
                                            USD $ </button>
                                    </li>
                                    <li>
                                        <button class="currency-select @if($chosenCurrency==='EUR') selected @endif" type="submit" name="currency_code" value="EUR">
                                            EUR €
                                        </button>
                                    </li>
                                    <li>
                                        <button class="currency-select @if($chosenCurrency==='ILS') selected @endif" type="submit" name="currency_code" value="ILS">
                                            ILS ₪ </button>
                                    </li>
                                </ul>
                            </div>
                        </form>
                    </div>
                    <a href="#"><i class="icon-phone"></i> Call Us: {{config('contact.phone')}}</a>
                </div>
                <div class="clear"></div>
            </div>
            <div class="col-md-9 col-sm-10">
                <!-- shopping cart end -->
                <div class="search-area">
                    <form action="{{ route('search-page') }}">
                        <div class="control-group">
{{--                            <ul class="categories-filter animate-dropdown">--}}
{{--                                <li class="dropdown"> <a class="dropdown-toggle" data-toggle="dropdown" href="category.html">Categories <span class="caret"></span></a>--}}
{{--                                    <ul class="dropdown-menu animated fadeIn">--}}
{{--                                        <li><a href="#">- Men</a></li>--}}
{{--                                        <li><a href="#">- Women</a></li>--}}
{{--                                        <li><a href="#">- Boys</a></li>--}}
{{--                                        <li><a href="#">- Girls</a></li>--}}
{{--                                        <li><a href="#">- Laptops</a></li>--}}
{{--                                        <li><a href="#">- Desktops</a></li>--}}
{{--                                        <li><a href="#">- Cameras</a></li>--}}
{{--                                        <li><a href="#">- Mobile Phones</a></li>--}}
{{--                                    </ul>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
                            <input class="search-field" placeholder="   Search for the product you want..." type="text" name="search" value="{{ request('search') }}">
{{--                            <button type="submit">--}}
{{--                                <i class="fa fa-search"></i>--}}
{{--                            </button>--}}
                            <button class="search-button" type="submit"><i class="icon-magnifier"></i></button>
                        </div>
                    </form>
                </div>

                {{--Cart Menu--}}
                <x-website.cart-menu />
                {{--End Cart Menu--}}

                @auth('web')
                    <div class="account link-inline">
                        <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout').submit();"><i class="icon-logout"></i><span class="hidden-mobile">logout</span></a>
                        <form id="logout" method="post" action="{{ route('logout')}}" hidden>
                            @csrf
                        </form>
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