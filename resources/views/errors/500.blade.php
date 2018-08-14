@extends("layouts.static")
@section('content')
    <div class="row no-margin h-fullscreen" style="padding-top: 10%">
        <div class="col-12">
            <div class="card card-transparent mx-auto text-center">
                <h1 class="text-secondary lh-1" style="font-size: 200px">500</h1>
                <hr class="w-30px">
                <h3 class="text-uppercase">Internal server error</h3>

                <p class="lead">Looks like we have an internal issue, please try again in couple of minutes.</p>
                <br>
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
{{--        @include('layouts.partials.footer')--}}
    </div>
@endsection