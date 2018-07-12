@extends("layouts.static")
@section("content")

    <div class="row no-gutters min-h-fullscreen bg-white">
        <div class="col-md-6 col-lg-7 col-xl-8 d-none d-md-block bg-img" style="background-image: url(../assets/img/gallery/11.jpg)" data-overlay="5">

            <div class="row h-100 pl-50">
                <div class="col-md-10 col-lg-8 align-self-end">
                    <img src="../assets/img/logo-light-lg.png" alt="...">
                    <br><br><br>
                    <h4 class="text-white">The admin is the best admin framework available online.</h4>
                    <p class="text-white">Credibly transition sticky users after backward-compatible web services. Compellingly strategize team building interfaces.</p>
                    <br><br>
                </div>
            </div>

        </div>



        <div class="col-md-6 col-lg-5 col-xl-4 align-self-center">
            <div class="p-20">

                <span class="logo center-vh">
                  <a href="/">
                      <img src="https://preview.ibb.co/nnWvuy/logopng_2.png" alt="LeanFITT" width="150">
                  </a>
                </span>
                <div class="card">
                    <h4 class="card-title text-center">
                        <strong>Login</strong>
                    </h4>

                    <div class="card-body">
                        <div id="errors" class="callout callout-danger b-1" role="alert"  style="{{ $errors->any() ? 'display:block' : 'display:none' }}">
                            <button type="button" class="close" data-dismiss="callout" aria-label="Close">
                                <span>×</span>
                            </button>
                            <h5>Oh snap!</h5>
                            @foreach($errors->all() as $error)
                                <p>
                                    {{ $error }}
                                </p>
                            @endforeach
                        </div>

                        <form class="" method="post" action="{{ url("login") }}" >
                            {{ csrf_field() }}
                            {{ method_field('post') }}
                            <div class="form-group">
                                <label for="username">Email</label>
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password">
                            </div>

                            <div class="form-group flexbox">
                                <label class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" name="remember">
                                    <span class="custom-control-indicator"></span>
                                    <span class="custom-control-description">Remember me</span>
                                </label>

                                <a class="text-muted hover-primary fs-13" href="#">Forgot password?</a>
                            </div>

                            <div class="form-group">
                                <button class="btn btn-bold btn-block btn-primary" type="submit">Login</button>
                            </div>
                        </form>

                        <p class="text-center text-muted fs-13 mt-20">Don't have an account? <a class="text-primary fw-500" href="{{ url('register') }}">Register</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection