<x-website.website-layout :title="$product->name">
    <x-website.breadcrumb current="Products" :title="$product->name.' Details'"/>
    <!-- Single-prouduct Section Start -->
    <section id="product-collection" class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="product-details-image">
                        <div class="slider-for slider">
                            <div>
                                <img src="{{ $product->image_url }}" alt="">
                            </div>
                            <div>
                                <img src="{{ $product->image_url }}" alt="">
                            </div>
                        </div>
                        <ul id="productthumbnail" class="slider slider-nav">
                            <li>
                                <img src="{{ $product->image_url }}" alt="">
                            </li>
                            <li>
                                <img src="{{ $product->image_url }}" alt="">
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-8 col-sm-6 col-xs-12">
                    <div class="info-panel">
                        <h1 class="product-title">{{ $product->name }}</h1>
                        <!-- Rattion Price -->
                        <div class="price-ratting">
                            <div class="price float-left">
                                {{ $product->format_price }}
                                <del>{{ $product->format_compare_price }}</del>
                            </div>
                            <div class="ratting float-right">
                                <div class="product-star">
                                    <i class="icon-star active"></i>
                                    <i class="icon-star active"></i>
                                    <i class="icon-star active"></i>
                                    <i class="icon-star active"></i>
                                    <i class="icon-star active"></i>
                                    <span>(01 Customer Review)</span>
                                </div>
                            </div>
                        </div>
                        <!-- Short Description -->
                        <div class="short-desc">
                            <h5 class="sub-title">Quick Overview</h5>
                            <p>{{ $product->description }}</p>
                        </div>
                        <form action="{{ route('cart.store') }}" method="post">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <!-- Quantity Cart -->
                            <div class="quantity-cart">
                                @if($product->quantity != 0)
                                    <span style="color: #00b300;font-size: large ">In Stock </span>
                                    <span style="font-size: small">{{ $product->quantity }}</span>
                                    <br />
                                    <button class="btn btn-common" style="margin-top: 15px" type="submit"><i class="icon-basket-loaded"></i> add to cart</button>
                                @else
                                    <div style="color: #5b0101;font-size: large ">Out Stock </div>
                                    <button class="btn btn-common" style="margin-top: 15px" type="button" disabled><i class="icon-basket-loaded"></i> add to cart</button>
                                @endif
                            </div>
                        </form>
                        <!-- Usefull Link -->
                        <ul class="usefull-link">
                            <li><a href="#"><i class="icon-envelope-open"></i> Email to a Friend</a></li>
                            <li><a href="#"><i class="icon-heart"></i> Wishlist</a></li>
                            <li><a href="#"><i class="icon-printer"></i> print</a></li>
                        </ul>
                        <!-- Share -->
                        <div class="share-icons">
                            <span>share :</span>
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                            <a href="#"><i class="fa fa-pinterest"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Single-prouduct Section End -->

    <!-- Single-prouduct-tab Start -->
    <div class="single-pro-tab section">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <div class="single-pro-tab-menu">
                        <!-- Nav tabs -->
                        <ul class="">
                            <li class="active"><a href="#description" data-toggle="tab">Description</a></li>
                            <li><a href="#reviews" data-toggle="tab">Reviews</a></li>
                            <li><a href="#information" data-toggle="tab">Information</a></li>
                            <li><a href="#tags" data-toggle="tab">Tags</a></li>
                        </ul>
                    </div>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane active" id="description">
                            <div class="pro-tab-info pro-description">
                                <h3 class="small-title">{{ $product->name }}</h3>
                                <p>
                                    {{ $product->description }}
                                </p>
                            </div>
                        </div>
                        <div class="tab-pane" id="reviews">
                            <div class="pro-tab-info pro-reviews">
                                <div class="customer-review">
                                    <h3 class="small-title">Customer review</h3>
                                    <ul class="product-comments clearfix">
                                        <li class="mb-30">
                                            <div class="pro-reviewer">
                                                <img src="{{ asset('website/assets/img/reviewer/1.jpg') }}" alt="">
                                            </div>
                                            <div class="pro-reviewer-comment">
                                                <div class="fix">
                                                    <div class="pull-left mbl-center">
                                                        <h5><strong>Gerald Barnes</strong></h5>
                                                        <p class="reply-date">27 Jun, 2016 at 2:30pm</p>
                                                    </div>
                                                    <div class="comment-reply pull-right">
                                                        <a href="#"><i class="fa fa-reply"></i></a>
                                                        <a href="#"><i class="fa fa-close"></i></a>
                                                    </div>
                                                </div>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer
                                                    accumsan egestas elese ifend. Phasellus a felis at est bibendum
                                                    feugiat ut eget eni Praesent et messages in con sectetur posuere
                                                    dolor non.</p>
                                            </div>
                                        </li>
                                        <li class="threaded-comments">
                                            <div class="pro-reviewer">
                                                <img src="{{ asset('website/assets/img/reviewer/2.jpg') }}" alt="">
                                            </div>
                                            <div class="pro-reviewer-comment">
                                                <div class="fix">
                                                    <div class="pull-left mbl-center">
                                                        <h5 class="text-uppercase mb-0"><strong>Gerald Barnes</strong>
                                                        </h5>
                                                        <p class="reply-date">27 Jun, 2016 at 2:30pm</p>
                                                    </div>
                                                    <div class="comment-reply pull-right">
                                                        <a href="#"><i class="fa fa-reply"></i></a>
                                                        <a href="#"><i class="fa fa-close"></i></a>
                                                    </div>
                                                </div>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer
                                                    accumsan egestas elese ifend. Phasellus a felis at est bibendum
                                                    feugiat ut eget eni Praesent et messages in con sectetur posuere
                                                    dolor non.</p>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="leave-review">
                                    <h3 class="small-title">Leave your reviw</h3>
                                    <div class="your-rating mb-30">
                                        <p class="mb-10"><strong>Your Rating</strong></p>
                                        <span>
                        <a href="#"><i class="fa fa-star-o"></i></a>
                      </span>
                                        <span class="separator">|</span>
                                        <span>
                        <a href="#"><i class="fa fa-star-o"></i></a>
                        <a href="#"><i class="fa fa-star-o"></i></a>
                      </span>
                                        <span class="separator">|</span>
                                        <span>
                        <a href="#"><i class="fa fa-star-o"></i></a>
                        <a href="#"><i class="fa fa-star-o"></i></a>
                        <a href="#"><i class="fa fa-star-o"></i></a>
                      </span>
                                        <span class="separator">|</span>
                                        <span>
                        <a href="#"><i class="fa fa-star-o"></i></a>
                        <a href="#"><i class="fa fa-star-o"></i></a>
                        <a href="#"><i class="fa fa-star-o"></i></a>
                        <a href="#"><i class="fa fa-star-o"></i></a>
                      </span>
                                        <span class="separator">|</span>
                                        <span>
                        <a href="#"><i class="fa fa-star-o"></i></a>
                        <a href="#"><i class="fa fa-star-o"></i></a>
                        <a href="#"><i class="fa fa-star-o"></i></a>
                        <a href="#"><i class="fa fa-star-o"></i></a>
                        <a href="#"><i class="fa fa-star-o"></i></a>
                      </span>
                                    </div>
                                    <div class="reply-box">
                                        <form class="form-horizontal">
                                            <div class="form-group">
                                                <div class="col-md-6">
                                                    <input class="form-control" type="text" name="Name"
                                                           placeholder="Your name here...">
                                                </div>
                                                <div class="col-md-6">
                                                    <input class="form-control" name="subject" type="text"
                                                           placeholder="Subject...">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <textarea class="form-control input-lg" name="comment" rows="4"
                                                              placeholder="Your review here..."></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <button class="btn btn-common" type="submit">Submit Review</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="information">
                            <div class="pro-tab-info pro-information">
                                <h3 class="small-title">Product information</h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer accumsan egestas
                                    elese ifend. Phasellus a felis at est bibendum feugiat ut eget eni Praesent et
                                    messages in con sectetur posuere dolor non.</p>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer accumsan egestas
                                    elese ifend. Phasellus a felis at est bibendum feugiat ut eget eni Praesent et
                                    messages in con sectetur posuere dolor non.</p>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer accumsan egestas
                                    elese ifend. Phasellus a felis at est bibendum feugiat ut eget eni Praesent et
                                    messages in con sectetur posuere dolor non.</p>
                            </div>
                        </div>
                        <div class="tab-pane" id="tags">
                            <div class="pro-tab-info pro-information">
                                <h3 class="small-title">tags</h3>
                                @foreach($product->tags as $tag)
                                    {{ $tag->name }}
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Single-prouduct-tab End -->
    @push('scripts')
        <script>
            const csrf_token = "{{ csrf_token() }}";
        </script>
        {{--        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>--}}
        <script src="{{ asset('js/cart.js') }}"></script>
    @endpush
</x-website.website-layout>