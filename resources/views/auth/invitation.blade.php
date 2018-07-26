@extends("layouts.static")
@section("content")
    <style>
        .square{
            width: 100px;
            height: 100px;
            border-radius: 50%;
            justify-content: center;
            align-items: center;
        }
    </style>
    <div class="row min-h-fullscreen center-vh p-20 m-0">
        <div class="col-12">
            <div class="card card-shadowed px-50 py-30 w-400px mx-auto" style="max-width: 100%">
                <div class="form-group">
                    <span class="logo center-vh">
                  <a href="/">
                      <img src="https://preview.ibb.co/nnWvuy/logopng_2.png" alt="LeanFITT" width="150">
                  </a>
                </span>
                </div>
                @if(isset($success))
                    <div class="form-group text-center center-h">
                        <span class="status-square btn mt-20 mb-20 btn-success btn-round fs-30 center-h center-v btn-square h-100px w-100px"><i class="ti-check"></i></span>
                    </div>
                    <div class="form-group text-center">
                        <p>{{$success}}</p>
                    </div>
                    <div class="form-group">
                        <p class="d-block text-center">Please <a href="{{url('login')}}">Login</a> to your account </p>
                    </div>
                @else
                    <div class="form-group text-center center-h">
                        <span class="status-square btn mt-20 mb-20 btn-danger btn-round fs-30 center-h center-v btn-square h-100px w-100px"><i class="ti-close"></i></span>
                    </div>
                    <div class="form-grou text-center">
                        <p>{{$error}}</p>
                    </div>
                @endif
            </div>
            <p class="text-center text-muted d-block fs-13 mt-20">Don't have an account? <a class="text-primary fw-500" href="{{url('register')}}">Sign up</a></p>
        </div>


        <footer class="col-12 align-self-end text-center fs-13">
            <p class="mb-0"><small>Copyright © {{date('Y')}} <a href="{{env('APP_URL')}}">{{config('app.name')}}</a>. All rights reserved.</small></p>
        </footer>
    </div>
@endsection