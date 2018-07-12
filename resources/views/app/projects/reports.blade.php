@extends('layouts.app')
@section('content')
    <main>
        @include('app.projects.partials.header')
        <div class="main-content">
            <form class="card">
                {{--<h4 class="card-title fw-400 text-center">Contact Us</h4>--}}
                <div class="card-body">
                    @include('static.partials.maintenance')
                </div>
            </form>
        </div>
    </main>
@endsection