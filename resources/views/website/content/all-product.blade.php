<x-website.website-layout title="List Products">

    <!-- Start Page Header -->
    <x-website.breadcrumb current="Products" title="List Products" />
    <!-- End Page Header -->

    <!-- Product Categories Section Start -->
    <div id="content" class="product-area">
        <div class="container">
            <div class="row">

                {{-- start Sidebar--}}
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <div class="widget-search md-30">
                        <form action="#">
                            <input class="form-control" placeholder="Search By Product Name..." type="text" name="search" value="{{ request('search') }}">
                            <button type="submit">
                                <i class="fa fa-search"></i>
                            </button>
                        </form>
                    </div>
                    <div class="widget-ct widget-categories mb-30">
                        <div class="widget-s-title">
                            <h4>Categories</h4>
                        </div>
                        <ul id="accordion-category" class="product-cat">
                            <li class="panel">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion-category" href="#category1">Fashion <span><i class="icon-arrow-down"></i></span></a>
                                <div id="category1" class="panel-collapse collapse">
                                    <ul class="listSidebar">
                                        <li><a href="#">Men</a></li>
                                        <li><a href="#">Women</a></li>
                                        <li><a href="#">Bag</a></li>
                                    </ul>
                                </div>
                            </li>
                            <li><a href="#">Trending <span>(69)</span></a></li>
                            <li><a href="#">New Arrivals <span>(27)</span></a></li>
                            <li><a href="#">Flowerpot<span>(57)</span></a></li>
                            <li><a href="#">Cups<span>(39)</span></a></li>
                            <li><a href="#">Beauty<span>(95)</span></a></li>
                            <li><a href="#">Wall Hook <span>(69)</span></a></li>
                            <li><a href="#" class="pr-all">Product All</a></li>
                        </ul>
                    </div>
                    <div class="widget-ct widget-color mb-30">
                        <div class="widget-s-title">
                            <h4>Color</h4>
                        </div>
                        <div class="widget-info color-filter clearfix">
                            <ul>
                                <li><a href="#"><span class="color color-1"></span>LightSalmon<span class="count">12</span></a></li>
                                <li><a href="#"><span class="color color-2"></span>Dark Salmon<span class="count">20</span></a></li>
                                <li><a href="#"><span class="color color-3"></span>Tomato<span class="count">59</span></a></li>
                                <li class="active"><a href="#"><span class="color color-4"></span>Deep Sky Blue<span class="count">45</span></a></li>
                                <li><a href="#"><span class="color color-5"></span>Electric Purple<span class="count">78</span></a></li>
                                <li><a href="#"><span class="color color-6"></span>Atlantis<span class="count">10</span></a></li>
                                <li><a href="#"><span class="color color-7"></span>Deep Lilac<span class="count">15</span></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="widget-ct widget-filter mb-30">
                        <div class="widget-s-title">
                            <h4>Filter By Price</h4>
                        </div>
                        <!-- Range contents -->
                        <div class="widget-info filter-price" style="position: relative;">
                            <div>
                                <input type="text" id="range" value="" name="range" />
                            </div>
                            <div class="filter-btn">
                                <button class="btn btn-common" type="button">Filter</button>
                            </div>
                        </div>
                    </div>
                    <div class="widget-ct widget-size mb-30">
                        <div class="widget-s-title">
                            <h4>Size</h4>
                        </div>
                        <div class="widget-info size-filter clearfix">
                            <ul>
                                <li><a href="#">M</a></li>
                                <li class="active"><a href="#">S</a></li>
                                <li><a href="#">L</a></li>
                                <li><a href="#">SL</a></li>
                                <li><a href="#">XL</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="widget-ct widget-banner">
                        <div class="widget-info widget-banner-img">
                            <a href="#"><img src="{{ asset('website/assets/img/banner-left.jpg') }}"  alt=""></a>
                        </div>
                    </div>
                </div>
                {{-- End Sidebar--}}

                <div class="col-md-9 col-sm-9 col-xs-12">
                    <div class="shop-content" style="width: 100%">
                        <div class="col-md-12">
                            <div class="product-option mb-30 clearfix">
                                <ul class="shop-tab">
                                    <li class="active"><a aria-expanded="true" href="#grid-view" data-toggle="tab"><i class="icon-grid"></i></a></li>
                                </ul>
                                <!-- Size end -->
                                <div class="showing text-right">
                                    <p class="hidden-xs">Showing {{$products->firstItem()}}-{{$products->lastItem()}} of {{$products->total()}} Results</p>
                                </div>
                            </div>
                        </div>

                        <div class="tab-content">
                            <div id="grid-view" class="tab-pane active">
                                @foreach($products as $product)
                                        <x-website.product-card :product="$product" class="col-md-4 col-sm-6 col-xs-12"/>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Start Pagination -->
                    <div class="pagination">
                        {{$products->withQueryString()->links()}}
                    </div>
                    <!-- End Pagination -->

                </div>
            </div>
        </div>
    </div>
    <!-- Product Categories Section End -->

    @push('scripts')
        <script>
            const csrf_token = "{{ csrf_token() }}";
        </script>
        <script src="{{ asset('js/cart.js') }}"></script>
    @endpush
</x-website.website-layout>