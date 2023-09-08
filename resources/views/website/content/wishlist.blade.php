<x-website.website-layout title="Wishlist">
    <x-website.breadcrumb title="wishlist" current="wishlist" />
    <!-- Start Content -->
    <div id="content">
        <div class="container">
            <div class="row">
                <div class="header text-center">
                    <h3 class="small-title">Wishlist</h3>
                </div>
                <div class="col-md-12">
                    <div class="wishlist">
                        <div class="col-md-4 col-sm-4 text-center">
                            <p>Product</p>
                        </div>
                        <div class="col-md-2 col-sm-2">
                            <p>Price</p>
                        </div>
                        <div class="col-md-2 col-sm-2">
                            <p>Stock status</p>
                        </div>
                        <div class="col-md-2 col-sm-2">
                            <p>Add to cart</p>
                        </div>
                        <div class="col-md-2 col-sm-2">
                            <p>Close</p>
                        </div>
                    </div>
                    <div class="wishlist-entry clearfix">
                        <div class="col-md-4 col-sm-4">
                            <div class="cart-entry">
                                <a class="image" href="#"><img src="{{ asset('website/assets/img/wishlist/img-1.jpg') }}"  alt=""></a>
                                <div class="cart-content">
                                    <h4 class="title">Little Barrel in White</h4>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing Commodo...</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-2 entry">
                            <div class="price">
                                $ 190.00 <del>$280.00</del>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-2 entry">
                            <a class="instock" href="#">In stock</a>
                        </div>
                        <div class="col-md-2 col-sm-2 entry">
                            <a class="btn btn-common " href="#">
                                <i class="icon-basket"></i> add to Cart
                            </a>
                        </div>
                        <div class="col-md-2 col-sm-2 entry">
                            <a class="btn-close" href="#"><i class="icon-close"></i></a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- End Content -->
</x-website.website-layout>