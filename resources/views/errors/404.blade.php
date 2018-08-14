@extends("layouts.static")
@section('content')
    <div class="row no-margin h-fullscreen" style="padding-top: 10%">

        <div class="col-12">
            <div class="card card-transparent mx-auto text-center">
                <h1 class="text-secondary lh-1" style="font-size: 200px">404</h1>
                <hr class="w-30px">
                <h3 class="text-uppercase">Page not found!</h3>

                <p class="lead">Seems you're looking for something that doesn't exist.</p>

                <ul class="nav nav-primary nav-dotted nav-dot-separated justify-content-center fs-14">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/support') }}">Report problem</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:window.history.back()">Go back</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection