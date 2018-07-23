@extends('layouts.app')
@section('content')
    <style>
        .avatar{
            vertical-align: middle !important;
        }
    </style>
    <main class="main-container">
        <header class="header mb-0 bg-ui-general">

            <div class="header-bar center-h">
                <h4 class="text-dark">{{$project->name}}</h4>
            </div>
            <div class="header-action center-h">
                <nav class="nav">
                    <a class="nav-link active" href="{{url('projects')}}/{{$project->id}}/details">Details</a>
                    <a class="nav-link" href="{{url('projects')}}/{{$project->id}}/kpi">KPI</a>
                    <a class="nav-link" href="{{url('projects')}}/{{$project->id}}/action-items">Action Items</a>
                    <a class="nav-link" href="{{url('projects')}}/{{$project->id}}/reports">Reports</a>
                </nav>
            </div>
        </header>
        <div class="main-content">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header"><h3><strong>{{$project->name}}</strong></h3></div>
                        <div class="card-body bg-lighter">
                            <p>{{$project->note}}</p>
                            <p>{{$project->goal}}</p>
                            <p>Start Date: {{date('m/d/Y',strtotime($project->start_date))}}</p>
                            <p>End Date: {{date('m/d/Y',strtotime($project->end_date))}}</p>
                            <p>Report Date: {{date('m/d/Y',strtotime($project->report_date))}}</p>
                            @if($project->is_completed==1)
                                <p>Status: <span class="text-success">Completed</span></p>
                            @elseif($project->is_archived==1)
                                <p>Status: <span class="text-warning">Archived</span></p>
                            @else
                                <p>Status: <span class="text-default">Ongoing</span></p>
                            @endif

                        </div>
                        <div class="card-body text-center">
                            <button class="btn m-1 btn-round btn-square btn-primary"><i class="fe fe-edit-3"></i></button>
                            <button class="btn m-1 btn-round btn-square btn-success"><i class="fe fe-check"></i></button>
                            <button class="btn m-1 btn-round btn-square btn-warning"><i class="fe fe-archive"></i></button>
                            <button class="btn m-1 btn-round btn-square btn-danger"><i class="fe fe-trash-2"></i></button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header"><h4>Members</h4></div>
                                <div class="card-body">
                                    @if(count($project_members) > 0)
                                        @foreach($project_members as $key=>$pmems)
                                            <label class="d-block my-20">{{$key}}</label>
                                            @foreach($pmems as $pmem)
                                                <a class="avatar avatar-pill avatar-lg" href="{{url('users')}}/{{$pmem->id}}/profile">
                                                    <img src="{{$pmem->avatar}}" alt="...">
                                                    <span>{{$pmem->first_name}} {{$pmem->last_name}}</span>
                                                    <form method="post" action="{{url('projects')}}/{{$project->id}}/member/{{$pmem->member_id}}/remove">
                                                        {{csrf_field()}}
                                                        {{method_field('delete')}}
                                                        <button type="submit" class="close cursor-pointer">&times;</button>
                                                    </form>

                                                </a>
                                            @endforeach
                                        @endforeach
                                    @endif
                                    <div class="avatar avatar-add avatar-lg hover-white cursor-pointer" data-toggle="modal" data-target="#modal-member"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header"><h4>Attachments</h4></div>
                                <div class="card-body">
                                    <a class="avatar avatar-pill avatar-lg" style="overflow: hidden" href="#" style="vertical-align: middle">
                                        <img src="{{asset('assets')}}/img/attachment.png" alt="...">
                                        <span class="text-truncate w-150px">Continually drive user friendly solut</span>
                                        <span class="close">&times;</span>
                                    </a>
                                    <a class="avatar avatar-pill avatar-lg" style="overflow: hidden" href="#" style="vertical-align: middle">
                                        <img src="{{asset('assets')}}/img/attachment.png" alt="...">
                                        <span class="text-truncate w-150px">Continually drive user friendly solut</span>
                                        <span class="close">&times;</span>
                                    </a>
                                    <a class="avatar avatar-add avatar-lg hover-white cursor-pointer add-attachment"></a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header"><h4>Comments</h4></div>
                                <div class="card-body">
                                    <div class="media-list media-list-divided">
                                        <div class="media">
                                            <a class="avatar" href="#">
                                                <img src="../assets/img/avatar/5.jpg" alt="...">
                                            </a>
                                            <div class="media-body">
                                                <p>
                                                    <a href="#"><strong>Tim Hank</strong></a>
                                                    <time class="float-right text-fade" datetime="2018-07-14 20:00">25 Dec</time>
                                                </p>
                                                <p>Continually drive user friendly solutions through performance based infomediaries.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <form class="publisher bg-transparent bt-1 border-fade">
                                        <textarea class="publisher-input" style="resize: none" placeholder="Add Comment"></textarea>
                                        {{--<input class="publisher-input" type="text" placeholder="Add Comment">--}}
                                        <a class="publisher-btn" href="#"><i class="fe fe-arrow-right"></i></a>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="modal modal-top fade" id="modal-project" tabindex="-1">
            <div class="modal-dialog mt-30 ">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Project</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="post" action="{{url('projects')}}/{{$project->id}}" enctype="multipart/form-data">
                        {{csrf_field()}}
                        {{method_field('put')}}
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="input-normal">Name</label>
                                <input type="text" name="name" class="form-control" id="input-normal" value="{{isset($project->name) ? $project->name : old('name')}}">
                            </div>
                            <div class="form-group">
                                <label for="textarea">Description</label>
                                <textarea name="note" class="form-control" id="textarea" rows="2">{{isset($project->note) ? $project->note : old('note')}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="input-normal">Goal</label>
                                <textarea name="goal" class="form-control" id="textarea" rows="2">{{isset($project->goal) ? $project->goal : old('goal')}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="input-normal">Start Date</label>
                                <input type="text" name="start_date" class="form-control" id="input-normal" data-provide="datepicker" data-date-today-highlight="true" value="{{isset($project->start_date) ? date('m/d/Y',strtotime($project->start_date)) : old('start_date')}}">
                            </div>
                            <div class="form-group">
                                <label for="input-normal">End Date</label>
                                <input type="text" name="end_date" class="form-control" id="input-normal" data-provide="datepicker" data-date-today-highlight="true" value="{{isset($project->end_date) ? date('m/d/Y',strtotime($project->end_date)) : old('end_date')}}">
                            </div>
                            <div class="form-group">
                                <label for="input-normal">Report Date</label>
                                <input type="text" name="report_date" class="form-control" id="input-normal" data-provide="datepicker" data-date-today-highlight="true" value="{{isset($project->report_date) ? date('m/d/Y',strtotime($project->report_date)) : old('report_date')}}">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-bold btn-pure btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-bold btn-pure btn-primary">Save</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        @include('app.projects.partials.members-modal')

        {{--Upload attachment--}}
        <form method="post" action="{{url('projects/attachment')}}" enctype="multipart/form-data">
            {{csrf_field()}}
            <input type="file" id="file-input" style="display: none" name="attachment" onchange="$('#uploadFile').trigger('click')">
            <input type="hidden" name="type" value="project">
            <input type="hidden" name="project_id" value="{{$project->id}}">
            <input type="submit" value="true" id="uploadFile" style="display: none">
        </form>

    </main>
    <script>
        window.onload=function(){
            $('.add-attachment').click(function(){
                $('#file-input').trigger('click');
            })

            @if(session()->has('success') || session('success'))
            setTimeout(function () {
                toastr.success('{{ session('success') }}');
            }, 500);
            @endif
            @if(isset($errors) && count($errors->all()) > 0 && $timeout = 700)
            @foreach ($errors->all() as $key => $error)
            setTimeout(function () {
                toastr.error("{{ $error }}");
            }, {{ $timeout * $key }});
            @endforeach
            @endif
        }

    </script>
@endsection