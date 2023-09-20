<x-website.website-layout>
    <section id="product-collection" class="section">
        <div class="container">
{{--            <div class="row">--}}
{{--                <div class="col-3">--}}
{{--                    <div class="nav nav-pills nav-stacked" id="v-pills-tab" role="tablist" aria-orientation="vertical">--}}
{{--                        <button class="nav-link active" id="v-pills-home-tab" data-toggle="pill" data-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">Profile</button>--}}
{{--                        <button class="nav-link" id="v-pills-profile-tab" data-toggle="pill" data-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">Orders</button>--}}
{{--                        <button class="nav-link" type="button" id="logout-btn" onclick="$('#logout-form').submit()">Logout</button>--}}
{{--                        <form action="{{route('logout')}}" method="post" id="logout-form">--}}
{{--                            @csrf--}}
{{--                        </form>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-9">--}}
{{--                    <div class="tab-content" id="v-pills-tabContent">--}}
{{--                        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">test</div>--}}
{{--                        <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">--}}
{{--                            <table class="table table-striped">--}}
{{--                                <thead>--}}
{{--                                <tr>--}}
{{--                                    <th scope="col">#</th>--}}
{{--                                    <th scope="col">First</th>--}}
{{--                                    <th scope="col">Last</th>--}}
{{--                                    <th scope="col">Handle</th>--}}
{{--                                </tr>--}}
{{--                                </thead>--}}
{{--                                <tbody>--}}
{{--                                <tr>--}}
{{--                                    <th scope="row">1</th>--}}
{{--                                    <td>Mark</td>--}}
{{--                                    <td>Otto</td>--}}
{{--                                    <td>@mdo</td>--}}
{{--                                </tr>--}}
{{--                                <tr>--}}
{{--                                    <th scope="row">2</th>--}}
{{--                                    <td>Jacob</td>--}}
{{--                                    <td>Thornton</td>--}}
{{--                                    <td>@fat</td>--}}
{{--                                </tr>--}}
{{--                                <tr>--}}
{{--                                    <th scope="row">3</th>--}}
{{--                                    <td>Larry</td>--}}
{{--                                    <td>the Bird</td>--}}
{{--                                    <td>@twitter</td>--}}
{{--                                </tr>--}}
{{--                                </tbody>--}}
{{--                            </table>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
            <div class="row" style="margin-bottom: 200px">

                <!-- Navigation Buttons -->
                <div class="col-md-3">
                    <ul class="nav nav-pills nav-stacked" id="myTabs">
                        <li ><a href="#home" data-toggle="pill">Profile</a></li>
                        <li class="active"><a href="#profile" data-toggle="pill">Orders</a></li>
                        <li><a href="#messages" onclick="$('#logout-form').submit()">Logout</a></li>
                        <form action="{{route('logout')}}" method="post" id="logout-form">
                            @csrf
                        </form>
                    </ul>
                </div>

                <!-- Content -->
                <div class="col-md-9">
                    <div class="tab-content">
                        <div class="tab-pane " id="home">Home</div>
                        <div class="tab-pane active" id="profile">
                            @if(session('success'))
                                <div id="alert">
                                    <div  class="alert alert-success" role="alert">
                                        <strong>Paid Successfully!</strong> Order Paid by Stripe.
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                </div>
                            @endif
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#Number</th>
                                        <th scope="col">Store</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Pay Status</th>
                                        <th scope="col">Total</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   @forelse($orders as $order)
                                       <tr>
                                           <th scope="row">{{$order->number}}</th>
                                           <td>{{$order->store->name}}</td>
                                           <td>{{$order->status}}</td>
                                           <td>{{$order->payment_status}}</td>
                                           <td>{{ Currency::format($order->total)}}</td>
                                           <td>{{ $order->created_at->diffForHumans() }}</td>
                                           <td>
                                               @if($order->payment_status!= 'paid')
                                                   <a class="btn btn-sm btn-info" href="{{route('orders.payments.create', $order->id)}}">
                                                       <span class="icon-action-redo" >
                                                           Pay on Stripe
                                                       </span>
                                                   </a>
                                               @else
                                                   <label class="badge btn-sm badge-notifications">
                                                       Paid Complete
                                                   </label>
                                               @endif
                                           </td>
                                       </tr>
                                   @empty
                                       <tr>
                                           <td colspan="6" class="text-center" style="font-size: larger; padding: 30px">
                                               No Orders, <a href="{{route('all-products')}}">
                                                   <span class="icon-action-redo">Go to Shopping</span>
                                               </a>
                                           </td>
                                       </tr>
                                   @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane" id="messages">Messages</div>
                    </div>
                </div>

            </div>
{{--            <div class="row">--}}
{{--                <div class="col-3" style="width: 25%; padding: 20px" >--}}
{{--                    <ul class="nav nav-pills nav-stacked ">--}}
{{--                        <li role="presentation" class="active"><a href="#">Home</a></li>--}}
{{--                        <li role="presentation"><a href="#">Profile</a></li>--}}
{{--                        <li role="presentation"><a href="#">Messages</a></li>--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--                <div class="col-9">--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
    </section>
{{--    @push('styles')--}}
{{--        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">--}}
{{--    @endpush--}}
</x-website.website-layout>