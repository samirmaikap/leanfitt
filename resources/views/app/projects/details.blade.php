@extends('layouts.app')
@section('content')
    <main class="main-container">
        <header class="header row p-0 m-0 mb-0" style="flex-direction: row">
            <div class="col-lg-6">
                <h3>Project Name</h3>
            </div>
            <div class="col-lg-6 center-h header-action " style="background-color: red">
                <nav class="nav" style="background-color: green;float: right!important;">
                    <a class="nav-link" href="">Profile</a>
                    <a class="nav-link" href="">Awards</a>
                    <a class="nav-link active" href="">Performance</a>
                </nav>
            </div>
        </header>
    </main>
@endsection