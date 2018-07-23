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
                        <strong>Account Recovery</strong>
                    </h4>

                    <div class="card-body">
                        @if (Session::has('success'))
                            <div class="callout callout-success" role="alert">
                                <button type="button" class="close" data-dismiss="callout" aria-label="Close">
                                    <span>×</span>
                                </button>
                                <h5>Success</h5>
                                <p>{{ Session::get('success') }}</p>
                            </div>
                        @endif

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

                        <form class="" method="post" action="{{ url("recovery") }}" >
                            {{ csrf_field() }}
                            {{ method_field('post') }}
                            <div class="form-group">
                                <label for="username">Email</label>
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                            </div>

                            <div class="form-group">
                                <button class="btn btn-bold btn-block btn-primary" type="submit">Proceed</button>
                            </div>
                        </form>

                        <p class="text-center text-muted fs-13 mt-20">Try <a class="text-primary fw-500" href="{{ url('login') }}">Login</a> into your account</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection