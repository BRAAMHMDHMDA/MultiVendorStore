<x-website.website-layout title="Stores">
    <x-website.breadcrumb current="Stores" title="List Stores" />

    <!-- Stores Section Start -->
    <div id="content" class="product-area">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <div class="widget-search md-30">
                        <form action="#">
                            <input class="form-control" placeholder="Search here..." type="text">
                            <button type="submit">
                                <i class="fa fa-search"></i>
                            </button>
                        </form>
                    </div>
                </div>
                <div class="col-md-9 col-sm-9 col-xs-12">
                    <div class="shop-content" style="width:100%">
                        <div class="product-option mb-30 clearfix">
                            <ul class="shop-tab">
                                <li class="active"><a aria-expanded="false" href="#list-view" data-toggle="tab"><i class="icon-list"></i></a></li>
                            </ul>
                            <!-- Size end -->
                            <div class="showing text-right">
                                <p class="hidden-xs">Showing 01-09 of 17 Results</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="tab-content">
                    <div id="list-view" class="tab-pane active">
                        <div class="shop-list">
                            @foreach($stores as $store)
                                <x-website.store-box :store="$store" />
                            @endforeach
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

        </div>
    </div>
    <!-- Stores Section End -->
</x-website.website-layout>