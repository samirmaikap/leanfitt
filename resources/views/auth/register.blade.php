@extends("layouts.static")
@section("content")

    <div class="row no-gutters min-h-fullscreen bg-white">

        <div class="col-md-6 col-lg-7 col-xl-8 d-none d-md-block bg-img" style="background-image: url(https://image.shutterstock.com/z/stock-photo-warehouse-managers-and-worker-working-together-in-warehouse-office-508535986.jpg)" data-overlay="5">

            <div class="row h-100 pl-50">
                <div class="col-md-10 col-lg-8 align-self-end">
                    {{--<img src="https://preview.ibb.co/nnWvuy/logopng_2.png" alt="...">--}}
                    <br><br><br>
                    <h4 class="text-white">LeanFITT™ is the best Lean Management available online.</h4>
                    <p class="text-white">Some cool description about LeanFITT™.</p>
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
                        <strong class="">Register</strong>
                    </h4>
                    <div class="card-body">
                        <div id="errors" class="callout callout-danger b-1" role="alert"
                             style="{{ $errors->any() ? 'display:block' : 'display:none' }}">
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

                        <form id="register-form" action="" method="post">
                            {{ csrf_field() }}
                            {{ method_field('post') }}

                            <p class="text-center text-gray">
                                Set up your account. This information will be used to connect to your Organizations.
                            </p>
                            <hr class="w-100px">

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>First Name</label>
                                    <input class="form-control" type="text" name="first_name" value="{{ old('first_name') }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Last Name</label>
                                    <input class="form-control" type="text" name="last_name" value="{{ old('last_name') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Phone</label>
                                <input class="form-control" type="text" name="phone" value="{{ old('phone') }}">
                            </div>
                            <div class="form-group">
                                <label>Email address</label>
                                <input class="form-control" type="text" name="email" value="{{ old('email') }}">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input class="form-control" type="password" name="password">
                            </div>
                            <div class="form-group">
                                <label>Confirm Password</label>
                                <input class="form-control" type="password" name="password_confirmation">
                            </div>
                            <hr>
                            <button class="btn btn-bold btn-block btn-primary" type="submit">Register</button>
                        </form>
                    </div>
                </div>

                <p class="text-center text-muted fs-13 mt-20">Already have an account? <a class="text-primary fw-500" href="{{ url('login') }}">Login</a></p>
            </div>
        </div>
    </div>

@endsection