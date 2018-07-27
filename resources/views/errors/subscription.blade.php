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
        body{
            background-color: #fff!important;
        }
    </style>
    <div class="row min-h-fullscreen center-vh p-20 m-0">
        <div class="col-12">
            <div class="px-50 py-30 w-400px mx-auto" style="max-width: 100%">
                <div class="form-group">
                    <span class="logo center-vh">
                  <a href="/">
                      <img src="https://preview.ibb.co/nnWvuy/logopng_2.png" alt="LeanFITT" width="150">
                  </a>
                </span>
                </div>
                <div class="form-group">
                    <span class="logo center-vh">
                 <img src="{{asset('assets/img/error.png')}}" alt="LeanFITT" height="200">
                </span>
                </div>
                <div class="form-group text-center">
                    <p>Your organization subscription has ended.Please contact your admin</p>
                </div>
                <div class="form-group text-center">
                    <a href="{{env('APP_URL').'/logout'}}" class="btn btn-success btn-round">Logout</a>
                </div>
            </div>
        </div>


        <footer class="col-12 align-self-end text-center fs-13">
            <p class="mb-0"><small>Copyright © {{date('Y')}} <a href="{{env('APP_URL')}}">{{config('app.name')}}</a>. All rights reserved.</small></p>
        </footer>
    </div>
@endsection