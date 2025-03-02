<x-website.website-layout>
    <x-website.breadcrumb title="my Account" current="my Account"/>

    <section id="product-collection" class="section">
        <div class="container">
            <div class="row" style="margin-bottom: 200px">

                <!-- Navigation Buttons -->
                <div class="col-md-3">
                    <ul class="nav nav-pills nav-stacked" id="myTabs">
                        <li class="active"><a href="#home" data-toggle="pill">Profile</a></li>
                        <li class=""><a href="#profile" data-toggle="pill">Orders</a></li>
                        <li><a href="#messages" onclick="$('#logout-form').submit()">Logout</a></li>
                        <form action="{{route('logout')}}" method="post" id="logout-form">
                            @csrf
                        </form>
                    </ul>
                </div>

                <!-- Content -->
                <div class="col-md-9">
                    <div class="tab-content">
                        <div class="tab-pane active" id="home">
                            <h2 class="" style="margin-bottom: 20px">Basic Info</h2>
                            <form class="contact-form" method="post" action="{{ route('account.update') }}">
                                @method('PUT')
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <x-website.form.input type="text" class="form-control"
                                                              id="name" name="name" placeholder="Full Name" required
                                                              value="{{$user->name}}" label="Full Name"
                                        />
                                    </div>
                                    <div class="col-md-6">
                                        <x-website.form.input type="text" class="form-control"
                                                              id="phone" name="phone_number" placeholder="Phone" required
                                                              value="{{$user->phone_number}}" label="Phone Number"
                                        />
                                    </div>
                                    <div class="col-md-12">
                                        <x-website.form.input type="email" class="form-control"
                                                              id="email" name="email" placeholder="mail@sitename.com" required
                                                              value="{{$user->email}}" label="Email"
                                        />
                                    </div>


                                    <div class="col-md-12 col-xs-12">
                                        <button type="submit" id="submit" class="btn btn-common"><i class="fa fa-save"></i> Save</button>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </form>
                            <h2 class="" style="margin-top: 50px; margin-bottom: 20px">Change Password</h2>
                            <form class="contact-form" method="post" action="{{ route('account.change-password') }}">
                                @method('PATCH')
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <x-website.form.input type="password" class="form-control"
                                                              id="current_password" name="current_password" placeholder="Current Password" required
                                                              label="Current Password"
                                        />
                                    </div>
                                        <div class="col-12 col-md-6">
                                            <x-website.form.input type="password" class="form-control"
                                                                  id="password" name="password" placeholder="New Password" required
                                                                  autocomplete="false" label="New Password"
                                            />
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <x-website.form.input type="password" class="form-control"
                                                                  id="phone" name="password_confirmation" placeholder="confirm Password" required
                                                                  autocomplete="false" label="Confirm Password"
                                            />
                                        </div>

                                    <div class="col-md-12 col-xs-12">
                                        <button type="submit" id="submit" class="btn btn-common"><i class="fa fa-save"></i> Save</button>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </form>

                        </div>
                        <div class="tab-pane " id="profile">
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
</x-website.website-layout>