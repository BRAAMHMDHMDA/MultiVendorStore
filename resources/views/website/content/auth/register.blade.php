<x-website.website-layout title="Register Page">

    <div id="content">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-6 col-lg-offset-3">
                    <div class="login">
                        <div class="login-form-container">
                            <div class="login-text">
                                <h3>Creat a new account</h3>
                                <p>Please Register using account detail bellow.</p>
                            </div>
                            <!-- Account Form Start -->
                            <form  class="login-form" role="form" method="post" action="{{route('register')}}">
                                @csrf
                                <div class="form-group">
                                    <div class="controls">
                                        <input type="text" class="form-control" placeholder="Your Name" name="name" value="{{ old('name') }}">
                                    </div>
                                    {{$errors->has('name') ? $errors->first('name') : null }}
                                </div>
                                <div class="form-group">
                                    <div class="controls">
                                        <input type="number" class="form-control" placeholder="Phone Number" name="phone_number" value="{{ old('phone_number') }}">
                                    </div>
                                    {{$errors->has('phone_number') ? $errors->first('phone_number') : null }}

                                </div>
                                <div class="form-group">
                                    <div class="controls">
                                        <input type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}">
                                    </div>
                                    {{$errors->has('email') ? $errors->first('email') : null }}

                                </div>
                                <div class="form-group">
                                    <div class="controls">
                                        <input type="password" class="form-control" placeholder="Password" name="password">
                                    </div>
                                    {{$errors->has('password') ? $errors->first('password') : null }}

                                </div>
                                <div class="form-group">
                                    <div class="controls">
                                        <input type="password" class="form-control" placeholder="Password Confirmation" name="password_confirmation">
                                    </div>
                                    {{$errors->has('password') ? $errors->first('password') : null }}

                                </div>
                                <div class="button-box">
                                    <button type="submit" class="btn btn-common log-btn">Register</button>
                                </div>
                                <p style="margin-top: 25px">
                                    You have account? <a href="{{ route('login') }}">Login</a>
                                </p>
                            </form>
                            <!-- Account Form End -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-website.website-layout>