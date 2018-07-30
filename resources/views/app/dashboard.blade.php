@extends('layouts.app')
@section('content')
    <main class="main-container">
        <header class="header no-border">
            <div class="header-bar">
                <h4>Dashboard</h4>
                {{--<a href="{{url('dashboard/export/pdf')}}" class="btn btn-round btn-info">Download Pdf</a>--}}
            </div>
        </header>
        <div class="main-content">
            <div class="row">
                @if(isSuperadmin() || isAdmin())
                    <div class="col-lg-3">
                        <a href="{{url('users')}}">
                            <div class="card">
                                <div class="card-body">
                                    <div class="text-center my-2">
                                        <div class="fs-60 fw-400 text-success">{{isset($user->active) ? $user->active : 0}}</div>
                                        <span class="fw-400 text-muted">Active Users</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3">
                        <a href="{{url('users')}}">
                            <div class="card">
                                <div class="card-body">
                                    <div class="text-center my-2">
                                        <div class="fs-60 fw-400 text-warning">{{isset($user->invited) ? $user->invited : 0}}</div>
                                        <span class="fw-400 text-muted">Invited Users</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endif
                <div class="col-lg-3">

                    <a href="{{url('users')}}/{{session()->get('user')->id}}/profile">
                        <div class="card">
                            <div class="card-body">
                                <div class="text-center my-2">
                                    <div class="fs-60 fw-400 text-dark">{{isset($department) ? $department : 0}}</div>
                                    <span class="fw-400 text-muted">Departments</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3">
                    <a href="{{url('users')}}/{{session()->get('user')->id}}/profile">
                        <div class="card">
                            <div class="card-body">
                                <div class="text-center my-2">
                                    <div class="fs-60 fw-400 text-primary">{{isset($role) ? $role : 0}}</div>
                                    <span class="fw-400 text-muted">Roles</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3">
                    <a href="{{url('projects')}}">
                        <div class="card">
                            <div class="card-body">
                                <div class="text-center my-2">
                                    <div class="fs-60 fw-400 text-info">{{isset($project->active) ? $project->active : 0}}</div>
                                    <span class="fw-400 text-muted">Active Projects</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3">
                    <a href="{{url('projects')}}">
                        <div class="card">
                            <div class="card-body">
                                <div class="text-center my-2">
                                    <div class="fs-60 fw-400 text-success">{{isset($project->completed) ? $project->completed : 0}}</div>
                                    <span class="fw-400 text-muted">Completed Projects</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3">
                    <a href="{{url('quizzes')}}">
                        <div class="card">
                            <div class="card-body">
                                <div class="text-center my-2">
                                    <div class="fs-60 fw-400 text-info">{{isset($quiz) ? $quiz : 0}}</div>
                                    <span class="fw-400 text-muted">Quiz Taken</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3">
                    <a href="{{url('assessments')}}">
                        <div class="card">
                            <div class="card-body">
                                <div class="text-center my-2">
                                    <div class="fs-60 fw-400 text-warning">{{isset($assessment) ? $assessment : 0}}</div>
                                    <span class="fw-400 text-muted">Assessment Taken</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card ">
                        <div class="card-header">
                            <h3 class="card-title pull-left">Action items due dates  </h3>
                            <a class="pull-right fs-17" href="{{url('projects')}}"><i class="fe fe-external-link"></i></a>
                        </div>
                        <div class="card-body">
                            <div id="calendar" data-provide="fullcalendar"></div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card ">
                        <div class="card-header">
                            <h3 class="card-title pull-left">Tangible Savings</h3>
                            <a class="pull-right fs-17" href="{{url('projects')}}"><i class="fe fe-external-link"></i></a>
                        </div>
                        <div class="card-body">
                            <canvas id="tangible-chart" width="400" height="400"></canvas>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>
    <script>
        window.onload=function(){
            $(function(){
                var calendar = $('#calendar');
                var events=[];
                var items=JSON.parse('{!!$action_items->values()->toJson() !!}');
                for(var i=0; i<items.length;i++){
                    if(items[i].process=='Backlog'){
                        var color = '#dc3545';
                    }
                    else if(items[i].process=='To Do'){
                        var color = '#428bca';
                    }
                    else if(items[i].process=='In Review'){
                        var color = '#ffc107';
                    }
                    else if(items[i].process=='In Progress'){
                        var color = '#5bc0de';
                    }
                    else{
                        var color = '#28a745';
                    }

                    var event = {
                        title: items[i].title,
                        start: (new Date(items[i].due_date)),
                        allDay: true,
                        color: color,
                        tooltip:items[i].process,
                    };
                    events.push(event);
                }

                calendar.fullCalendar({
                    header: false,
                    defaultDate: "{{date('Y-m-d')}}",
                    editable: false,
                    droppable: false, // this allows things to be dropped onto the calendar
                    navLinks: true, // can click day/week names to navigate views
                    eventLimit: true, // allow "more" link when too many events
                    events: events,
                    eventRender: function(event, element) {
                        $(element).tooltip({title: event.tooltip});
                    }
                    // dayClick: function(date, jsEvent, view) {
                    //     $('#modal-add-event').modal('show');
                    // },
                    // eventClick: function(date, jsEvent, view) {
                    //     $('#modal-view-event').modal('show');
                    // }
                });
            })

            var value=JSON.parse('{!!$tangibles->pluck('value')->toJson() !!}')
            var label=JSON.parse('{!!$tangibles->pluck('created_at')->toJson() !!}')
            var date_arr=[];
            for (var j=0;j<label.length;j++){
                var date=moment(label[j].date, "YYYY-MM-DD");
                date_arr.push(date.format('MM/DD/YYYY'));
            }
            var default_options={
                maintainAspectRatio: false,
                scales: {
                    yAxes: [{
                        scaleLabel: {
                            display: true,
                            labelString: 'Value'
                        }
                    }],
                    xAxes: [{
                        scaleLabel: {
                            display: true,
                            labelString: 'Date'
                        }
                    }]
                },
            };
            lineChart('tangible-chart',date_arr,value,'Date','Value',default_options);
        }

    </script>
@endsection