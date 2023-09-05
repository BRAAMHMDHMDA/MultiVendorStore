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
                    <form action="#">
                        <div class="widget-search md-30">
                                <input class="form-control" placeholder="Search By Product Name..." type="text" name="search" value="{{ request('search') }}">
                                <button type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                        </div>
                        <div class="widget-ct widget-categories mb-30">
                            <div class="widget-s-title">
                                <h4>Categories</h4>
                            </div>
                            <ul id="accordion-category" class="product-cat">
                                <li>
                                    <input type="radio" id="vehicle1" name="category" value="" @checked(request()->category=='')>
                                    <p style="display: inline-block;">All</p>
                                </li>
                                @foreach($categories as $category)
                                    <li>
                                        <input type="radio" id="vehicle1" name="category" value="{{$category->name}}" @checked(request()->category==$category->name)>
                                        <p style="display: inline-block; font-size: small">{{$category->name}} ({{$category->products_count}})</p>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="widget-ct widget-filter mb-30">
                        <div class="widget-s-title">
                            <h4>Filter By Price</h4>
                        </div>
                        <!-- Range contents -->
                        <div class="widget-info filter-price">
                            <div  style="display: flex;gap: 20px">
                                <div style="display:flex;flex-direction: column; width: 40%">
                                    <label>Min</label>
                                    <input type="number" name="min_price" min="0" max="{{$maxPrice}}" value="{{request()->min_price}}">
                                </div>
                                <div style="display:flex;flex-direction: column; width: 40%">
                                    <label>Max</label>
                                    <input type="number" name="max_price" min="{{ $minPrice }}" max="{{$maxPrice}}" value="{{request()->max_price}}">
                                </div>
                            </div>
                            <div class="filter-btn" style="display: flex; flex-direction: column; gap: 15px">
                                <button class="btn btn-common" type="submit">Filter</button>
                                <a class="btn btn-common" href="{{ route('all-products') }}">Clear Filter</a>
                            </div>
                        </div>
                    </div>
                    </form>
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
</x-website.website-layout>