<x-website.website-layout title="Stores">
    <x-website.breadcrumb current="Stores" title="List Stores" />

    <!-- Stores Section Start -->
    <div id="content" class="product-area">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <div class="widget-search md-30">
                        <form action="#">
                            <input class="form-control" placeholder="Search By Store Name..." type="text" name="search" value="{{ request('search') }}">
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
                                <p class="hidden-xs">Showing {{$stores->firstItem()}}-{{$stores->lastItem()}} of {{$stores->total()}} Results</p>
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
                                <x-website.store-box :store="$store"/>
                            @endforeach
                        </div>
                    </div>
                </div>
                <!-- Start Pagination -->
                <div class="pagination">
                    {{$stores->withQueryString()->links()}}
                </div>
                <!-- End Pagination -->
            </div>

        </div>
    </div>
    <!-- Stores Section End -->
</x-website.website-layout>