<div>
    <x-website.breadcrumb current="Shopping Cart" title="Shopping Cart Products"/>

    <!-- Start Content -->
    <div id="content">
        <div class="container">
            <div class="row">
                <div class="header text-center">
                    <h3 class="small-title">Shopping cart</h3>
                    <p>Shopping Cart Checkout Order complete</p>
                </div>
                <div class="col-md-12" id="error" style="color: red">

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
                            <p>Quantity</p>
                        </div>
                        <div class="col-md-2 col-sm-2">
                            <p>Total</p>
                        </div>
                        <div class="col-md-2 col-sm-2">
                            <p>Remove</p>
                        </div>
                    </div>
                </div>
                @empty($items->count())
                    <div class="wishlist-entry clearfix" style="text-align: center">
                        No Items Available, <a href="{{ route('all-products') }}">Go To Shopping</a> (^_^) ...
                    </div>
                @endempty
                @foreach ($items as $item)
                    <div class="wishlist-entry clearfix" wire:key="{{$item->id}}">
                        <div class="col-md-4 col-sm-4">
                            <div class="cart-entry">
                                <a class="image" href="{{route('product-details',$item->product->slug)}}"><img src="{{ $item->product->image_url }}"  alt=""></a>
                                <div class="cart-content">
                                    <a href="{{route('product-details',$item->product->slug)}}"><h4 class="title">{{ $item->product->name }}</h4></a>
                                    <p>{{ $item->product->description }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-2 entry">
                            <div class="price">
                                {{ Currency::format($item->product->price) }}
                                @if($item->product->compare_price)
                                    <del>{{ Currency::format($item->product->compare_price) }}</del>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-2">
                            <ul class="quantity-selector">
                                {{--                                <li class="entry number-minus">1</li>--}}
                                {{--                                <li class="entry number">{{ $item->quantity }}</li>--}}
                                {{--                                <li class="entry number-plus">1</li>--}}
{{--                                <input class="form-control"--}}
{{--                                       wire:click="updateQuantity('{{ $item->product->id }}', '{{ $item->quantity }}')"--}}
{{--                                       value="{{$item->quantity}}" type="number" style="width: 50%; margin: auto"--}}
{{--                                >--}}
                                <input class="form-control"
                                       wire:model.debounce.500ms="quantities.{{ $item->id }}"
                                       type="number" style="width: 50%; margin: auto"
                                >
                            </ul>
                        </div>
                        <div class="col-md-2 col-sm-2 entry">
                            <div class="price">
                                {{ Currency::format($item->quantity * $item->product->price) }}
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-2 entry">
                            <a
                                class="btn-close"
                                wire:click="removeItem('{{ $item->id }}')"
                                wire:loading.attr="disabled"
                            >
                                <i class="icon-close" wire:loading.remove wire:target="removeItem('{{ $item->id }}')" style="cursor: pointer"></i>
                                <i class="glyphicon glyphicon-refresh fa-spin" wire:loading  wire:target="removeItem('{{ $item->id }}')"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
                <div class="row" style="display: flex; justify-content: end;margin-right: 1px;">
                    <div class=" card card--padding fill-bg" style=" width: 30%; background: transparent; border-style: dashed; border-width: 3px; border-top: 0">
                        <table class="table-total-checkout">
                            <tbody>
                            <tr>
                                <th>TOTAL: </th>
                                <td>{{ Currency::format($total) }}</td>
                            </tr>
                            </tbody>
                        </table>
                        <a href="{{ route('checkout') }}" class="btn btn-common btn-full">
                            Checkout
                            <span class="icon-action-redo"></span>
                        </a>
                    </div>
{{--                    <table class="table table-total-checkout" style="width: 30%">--}}
{{--                        <tr>--}}
{{--                            <th scope="row">Total : </th>--}}
{{--                            <td>{{ Currency::format($total) }}</td>--}}
{{--                        </tr>--}}
{{--                    </table>--}}
                </div>
            </div>
        </div>
    </div>
    <!-- End Content -->
</div>