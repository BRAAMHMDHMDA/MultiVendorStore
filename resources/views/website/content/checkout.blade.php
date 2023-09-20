<x-website.website-layout title="Checkout Order">
    <x-website.breadcrumb current="Checkout" title="Checkout Order">
        <a href="{{ route('cart.index') }}"><i class="icon-basket"></i> Cart</a>
        <span class="crumbs-spacer"><i class="fa fa-angle-double-right"></i></span>
    </x-website.breadcrumb>
    <!-- Content Section Start -->
    <div id="content">
        <div class="container">
            <div class="row">
                <form action="{{ route('checkout') }}" method="post">
                    @csrf

                    <!-- Start Left Area -->
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <!-- Billing Address -->
                        <div id="billing-address">
                            <span class="note pull-right" style="margin-right: 50px">* Required Fields</span>
                            <h2 class="title-checkout"><i class="icon-user"></i>Name & Address</h2>
                                <div class="row">
                                    <div class="col-md-6">
                                        <x-website.form.input label="First Name <sup>*</sup>" name="addr[billing][first_name]" placeholder="Enter First Name"/>
                                        <x-website.form.input label="Email Address <sup>*</sup>" name="addr[billing][email]" placeholder="Enter Email Address"/>
                                        <x-website.form.input label="City <sup>*</sup>" name="addr[billing][city]" placeholder="Enter First Name"/>
                                        <x-website.form.input label="State <sup>*</sup>" name="addr[billing][state]" placeholder="Enter First Name"/>
                                    </div>
                                    <div class="col-md-6">
                                        <x-website.form.input label="Last Name <sup>*</sup>" name="addr[billing][last_name]" placeholder="Enter Last Name"/>
                                        <x-website.form.input label="Phone Number <sup>*</sup>" name="addr[billing][phone_number]" placeholder="Enter Phone Number"/>
                                        <x-website.form.input label="Zip/Postal Code <sup>*</sup>" name="addr[billing][postal_code]" placeholder="Enter Postal Code"/>
                                        <div class="form-group">
                                            <label>Country <sup>*</sup></label>
                                            <select class="selectpicker" name="addr[billing][country]">
                                                <option  selected disabled>--Select Country--</option>
                                                @foreach($countries as $symbol => $countryName)
                                                    <option  value="{{$symbol}}">{{$countryName}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                </div>
{{--                                    <x-website.form.input label="Street Address <sup>*</sup>" name="addr[billing][street_address]" placeholder="Enter Street Address"/>--}}
                            <div class="alert alert-light alert-primary alert-icon mb-4 card-header">
                                <i class="icon-action-redo"></i>
                                <span class="text-body">Ship to a different address?</span>
                                <button class="text-primary" type="button" onclick="toggleShippingForm()">Click here to enter Shipping Address</button>
                            </div>
                        </div>
                        <!-- End Billing Address -->

                        <!-- Shipping Address -->
                        <div id="shipping-address" style="display: none">
                            <h2 class="title-checkout"><i class="icon-home"></i>Shipping Address</h2>
                            <div class="row">
                                <div class="col-md-6">
                                    <x-website.form.input label="First Name <sup>*</sup>" name="addr[shipping][first_name]" placeholder="Enter First Name"/>
                                    <x-website.form.input label="Email Address <sup>*</sup>" name="addr[shipping][email]" placeholder="Enter Email Address"/>
                                    <x-website.form.input label="City <sup>*</sup>" name="addr[shipping][city]" placeholder="Enter First Name"/>
                                    <x-website.form.input label="State <sup>*</sup>" name="addr[shipping][state]" placeholder="Enter First Name"/>
                                </div>
                                <div class="col-md-6">
                                    <x-website.form.input label="Last Name <sup>*</sup>" name="addr[shipping][last_name]" placeholder="Enter Last Name"/>
                                    <x-website.form.input label="Phone Number <sup>*</sup>" name="addr[shipping][phone_number]" placeholder="Enter First Name"/>
                                    <x-website.form.input label="Zip/Postal Code <sup>*</sup>" name="addr[shipping][postal_code]" placeholder="Enter First Name"/>
                                    <div class="form-group">
                                        <label>Country <sup>*</sup></label>
                                        <select class="selectpicker" name="addr[shipping][country]">
                                            <option  selected disabled>--Select Country--</option>
                                            @foreach($countries as $symbol => $countryName)
                                                <option value="{{$symbol}}">{{$countryName}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Shipping Address -->
                    </div>
                    <!-- End Left Area -->

                    <!-- Start Right Area -->
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="order-details mb-50">
                            <h2 class="title-checkout"><i class="icon-basket-loaded"></i>Your Order</h2>
                            <div class="order_review margin-bottom-35">
                                <table class="table table-responsive table-review-order">
                                    <thead>
                                    <tr>
                                        <th class="product-name">Product</th>
                                        <th class="product-quantity" style="width:0">Qty</th>
                                        <th class="product-total">Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($cart->get() as $item)
                                            <tr>
                                                <td><p>{{$item->product->name}}</p></td>
                                                <td><p>{{$item->quantity}}</p></td>
                                                <td><p class="price">{{Currency::format($item->product->price)}} x {{$item->quantity}}</p></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>Subtotal</th>
                                        <td colspan="2">
                                            <p class="price">{{ Currency::format($cart->total()) }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Shipping</th>
                                        <td colspan="2">
                                            <form action="#" class="shipping">
                                                <div class="radio">
                                                    <label><input checked="" type="radio" name="ship"> <span>Free Shipping</span></label>
                                                </div>
                                                <div class="radio">
                                                    <label><input type="radio" name="ship"> <span>Flat Rate:</span> </label><span class="price"> $10.00</span>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Total</th>
                                        <td colspan="2"><p class="price">{{ Currency::format($cart->total()) }}</p></td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div class="payment-method">
                            <!-- Payment Method -->
                            <h2 class="title-checkout">
                                <i class="icon-credit-card"></i>
                                Payment Method
                            </h2>
                            <!-- /Payment Method -->
                            <div class="form-group form-group-top clearfix">
                                <div class="radio">
                                    <label><input type="radio" name="payment" value="COD" checked><span>Cash On Delivery</span></label>
                                </div>
                                <div class="radio">
                                    <label><input type="radio" name="payment" value="stripe"><span>Stripe</span></label>
                                </div>
                            </div>

                            <!-- GRAND TOTAL -->
                            <div class="card card--padding fill-bg">
                                <table class="table-total-checkout">
                                    <tbody>
                                    <tr>
                                        <th>GRAND TOTAL:</th>
                                        <td>{{ Currency::format($cart->total()) }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                                <button href="#" class="btn btn-common btn-full" type="submit">Place Order Now <span class="icon-action-redo"></span></button>
                            </div>
                            <!-- /GRAND TOTAL -->
                        </div>
                    </div>
                    <!-- End Right Area -->
                </form>
            </div>
        </div>
    </div>
    <!-- Content Section End -->

    @push('scripts')
        <script type="text/javascript">
            function toggleShippingForm(e){
                $('#shipping-address').toggle();
                // let div = document.getElementById('shipping-address');
                // let isVisible = div.css('display')==='none'; // Check if the div is currently hidden
                //
                // if (isVisible) {
                //     div.css('display', 'block');
                // } else {
                //     div.css('display', 'none');
                // }
            }
        </script>
    @endpush
</x-website.website-layout>