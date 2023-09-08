<x-website.website-layout title="asd">
    <x-website.breadcrumb current="Search" title="Search Page" />
    <!-- Start Content -->
    <div id="content">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <!-- Product filter Start -->
                    <div class="product-filter">
                        <p class="result-count">Showing result of your search keyword "{{ request('search') }}"</p>
{{--                        <div class="sort-by">--}}
{{--                            <span>Sort by: </span>--}}
{{--                            <form class="woocommerce-ordering" method="post">--}}
{{--                                <label>--}}
{{--                                    <select name="order" class="orderby">--}}
{{--                                        <option selected="selected" value="menu-order">Default sortion</option>--}}
{{--                                        <option value="popularity">popularity</option>--}}
{{--                                        <option value="popularity">Average ration</option>--}}
{{--                                        <option value="popularity">newness</option>--}}
{{--                                        <option value="popularity">price</option>--}}
{{--                                    </select>--}}
{{--                                </label>--}}
{{--                            </form>--}}
{{--                        </div>--}}
                    </div>
                    <!-- Product filter End -->

                    <!-- Product Item Start -->
                    <div class="category-product-grid row">
                        @foreach($products as $product)
                            <x-website.product-card :product="$product" class="col-md-3 col-sm-6 col-xs-12"/>
                        @endforeach
                    </div>
                    <!-- Product Item End -->
                    <!-- Start Pagination -->
                    <div class="pagination">
                        {{$products->withQueryString()->links()}}
                    </div>
                    <!-- End Pagination -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Content -->
</x-website.website-layout>