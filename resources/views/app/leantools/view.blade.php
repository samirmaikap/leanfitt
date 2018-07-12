@extends('layouts.app')
@section('content')
    <main class="main-container">
        <header class="header no-border">
            <div class="header-bar">
                <h4>Lean Tools</h4>
            </div>
            <ul class="nav nav-tabs nav-tabs-inverse-mode">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#overview">Overview</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#steps">Steps</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#case-studies">Case Studies</a>
                </li>
            </ul>
        </header>

        <div class="main-content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="tab-content">
                        <div class="tab-pane active show" id="overview">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body">
                                           {!! isset($tool->overview) ? $tool->overview : 'Not Available' !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane " id="steps">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body">
                                            {!! isset($tool->steps) ? $tool->steps : 'Not Available' !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="case-studies">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body">
                                            {!! isset($tool->case_studies) ? $tool->case_studies : 'Not Available' !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
@endsection