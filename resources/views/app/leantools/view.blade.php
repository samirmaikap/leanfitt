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
            @if(!isSuperadmin() && !isAdmin())
                <div class="fab fab-fixed">
                    <button class="btn btn-float btn-danger" data-toggle="button">
                        <i class="fab-icon-default ti-arrow-up"></i>
                        <i class="fab-icon-active ti-close"></i>
                    </button>

                    <ul class="fab-buttons">
                        @if($tool->id==7)
                            <li><a  href="{{url('assessment/take')}}" class="btn btn-float btn-sm btn-info" title="Assessment"><i class="ti-book"></i></a></li>
                        @endif
                        <li><a href="{{url('quizzes/take/')}}/{{$tool->id}}" class="btn btn-float btn-sm btn-info" title="Quiz"><i class="ti-crown"></i></a></li>
                    </ul>
                </div>
            @endif
        </div>
@endsection