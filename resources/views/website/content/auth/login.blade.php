<x-website.website-layout title="Login Page">
    <div id="content">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-6 col-lg-offset-3">
                    <div class="login">
                        <div class="login-form-container">
                            <div class="login-text">
                                <h3>Login</h3>
                                <p>Please Register using account detail bellow.</p>
                            </div>
                            <!-- Login Form Start -->
                            <form  class="login-form" role="form" action="{{ route('login') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <div class="controls">
                                        <input type="text" class="form-control" placeholder="Email" name="email">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="controls">
                                        <input type="password" class="form-control" placeholder="Password" name="password">
                                    </div>
                                </div>
                                <div class="button-box">
                                    <div class="login-toggle-btn">
                                        <input type="checkbox">
                                        <label>Remember me</label>
                                        <a href="#">Forgot Password?</a>
                                    </div>
                                    <button type="submit" class="btn btn-common log-btn">Login</button>
                                    <p style="margin-top: 25px">
                                        Dont have account? <a href="{{ route('register') }}">Register</a>
                                    </p>
                                </div>
                            </form>
                            <!-- Login Form End -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-website.website-layout>