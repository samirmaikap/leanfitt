@extends('layouts.app')
@section('content')
    <main>
        @include('app.projects.partials.header')
        <div class="main-content">
            <form class="card card-transparent">
                <h4 class="card-title fw-400 text-center">Contact Us</h4>
                <div class="card-body">
                    {{--@include('static.partials.maintenance')--}}
                    @include("app.action-items.partials.board")
                </div>
            </form>
        </div>
    </main>

    <style>
        .media {
            background-color: #fff;
        }
    </style>


    @include('app.action-items.partials.action-item-modal')

    <!-- Dragula dependencies -->

    <link rel="stylesheet" href="{{ asset('assets/vendor/dragula/dragula.min.css') }}">
    <script src="{{ asset('assets/vendor/dragula/dragula.min.js') }}"></script>

    <script src="{{ asset('assets/vendor/dom-autoscroller/dom-autoscroller.min.js') }}"></script>

    <!-- Dragula script-->
    <script>

        window.onload = function () {

            var drake = dragula(
                $('.board-scroller .media-list').get()
            );

            var scroll = autoScroll([
                document.querySelector('.board-wrapper')
            ], {
                direction: 'horizontal',
                margin: 20,
                pixels: 10,
                maxSpeed: 25,
                scrollWhenOutside: true,
                autoScroll: function () {
                    return this.down && drake.dragging;
                }
            });
        };

    </script>
@endsection