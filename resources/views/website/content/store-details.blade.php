<x-website.website-layout title="store">
    <x-website.breadcrumb current="store" title="store"/>
    <!-- Product Categories Section Start -->
    <div id="content" class="product-area">
        <div class="container">
            <div class="row">
                <div class="col-md-9 col-sm-8 col-xs-12">
                    <div class="shop-content" style="width: 100%;">
                        <div class="col-md-12" >
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
                        {{ $products->links() }}

                    </div>
                    <!-- End Pagination -->
                </div>

                <div class="col-md-3 col-sm-4 col-xs-12">
                    <div class="widget-ct widget-profile mb-30">
                        <div class="widget-s-title">
                            <h4>Shop Details</h4>
                        </div>
                        <div class="info">
                            <a href="#"><img src="{{$store->cover_image_url}}" alt=""></a>
                            <h4 class="name">{{$store->name}}</h4>
                            <ul class="contacts-list">
                                <li><i class="icon-user"></i>
                                    @foreach($store->owners as $owner)
                                        @if($loop->last)
                                            {{ $owner->name }}
                                        @else
                                            {{ $owner->name }},
                                        @endif
                                    @endforeach
                                </li>
                                <li><i class="icon-phone"></i> {{$store->phone_number}}</li>
                                <li><i class="icon-envelope"></i> {{$store->email}}</li>
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