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
                            <form  class="login-form" role="form" method="post">
                                <div class="form-group">
                                    <div class="controls">
                                        <input type="text" class="form-control" placeholder="Username" name="name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="controls">
                                        <input type="password" class="form-control" placeholder="Password" name="password">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="controls">
                                        <input type="text" class="form-control" placeholder="Email" name="email">
                                    </div>
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