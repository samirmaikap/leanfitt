@extends('layouts.app')
@section('content')
    <main>
        <style>
            .avatar-container .avatar{
                vertical-align: middle !important;
            }
        </style>
        {{--<header class="header mb-0 bg-ui-general">--}}
            {{--<div class="header-bar center-h">--}}
                {{--<h4 class="text-dark">{{$project->name}}</h4>--}}
            {{--</div>--}}
            {{--<div class="header-action center-h">--}}
                {{--<nav class="nav">--}}
                    {{--<a class="nav-link active" href="{{url('projects')}}/{{$project->id}}/details">Details</a>--}}
                    {{--<a class="nav-link" href="{{url('projects')}}/{{$project->id}}/kpi">KPI</a>--}}
                    {{--<a class="nav-link" href="{{url('projects')}}/{{$project->id}}/action-items">Action Items</a>--}}
                    {{--<a class="nav-link" href="{{url('projects')}}/{{$project->id}}/reports">Reports</a>--}}
                {{--</nav>--}}
            {{--</div>--}}
        {{--</header>--}}
        @include('app.projects.partials.header')
        <div class="main-content">
            <div class="row">
                <div class="col-lg-4 project-container">
                    <div class="card">
                        <div class="card-header center-h"><h3><strong>{{$project->name}}</strong></h3></div>
                        <div class="card-body text-center bg-lighter">
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
                                <p>Status: <span class="text-primary">Ongoing</span></p>
                            @endif

                        </div>
                        <div class="card-body text-center">
                            @if($project->is_completed==0 && $project->is_archived==0 )
                                <button class="btn m-1 btn-round btn-primary" data-toggle="modal" data-target="#modal-project">Edit</button>
                                <form class="d-inline-block" id="compeleteProjectForm" method="post" action="{{url('projects')}}/{{$project->id}}/complete">
                                    {{csrf_field()}}
                                    {{method_field('put')}}
                                    <button class="btn m-1 btn-round btn-success complete-project">Mark Complete</button>
                                </form>
                            @elseif($project->is_completed==1 && $project->is_archived==0 )
                                <form class="d-inline-block" id="archiveProjectForm" method="post" action="{{url('projects')}}/{{$project->id}}/archive">
                                    {{csrf_field()}}
                                    {{method_field('put')}}
                                    <button class="btn m-1 btn-round btn-warning archive-project">Archive</button>
                                </form>

                            @elseif($project->is_completed==1 && $project->is_archived==1)
                                <form class="d-inline-block" id="deleteProjectForm" method="post" action="{{url('projects')}}/{{$project->id}}/delete">
                                    {{csrf_field()}}
                                    {{method_field('put')}}
                                    <button class="btn m-1 btn-round btn-danger delete-project">Delete</button>
                                </form>
                            @else
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-md-12 avatar-container members-container">
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
                                                    <form id="memberRemoveForm" method="post" action="{{url('projects')}}/{{$project->id}}/member/{{$pmem->member_id}}/remove">
                                                        {{csrf_field()}}
                                                        {{method_field('delete')}}
                                                        <button type="submit" class="close cursor-pointer remove-member">&times;</button>
                                                    </form>

                                                </a>
                                            @endforeach
                                        @endforeach
                                    @endif
                                    <div class="avatar avatar-add avatar-lg hover-white cursor-pointer" data-toggle="modal" data-target="#modal-member"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 avatar-container attachments-container">
                            <div class="card">
                                <div class="card-header"><h4>Attachments</h4></div>
                                <div class="card-body">
                                    @if(isset($project->attachments) && count($project->attachments) > 0)
                                        @foreach($project->attachments as $key=>$attachment)
                                            @php $ext= empty($attachment->url) ? 'N/A' : pathinfo($attachment->url, PATHINFO_EXTENSION); @endphp
                                            <a class="avatar avatar-pill avatar-lg" title="{{pathinfo($attachment->url, PATHINFO_BASENAME)}}" style="overflow: hidden" href="{{$attachment->url}}" target="_blank">
                                                <img src="https://ui-avatars.com/api/?font-size=0.21&length=4&uppercase=false&name={{$ext}}" alt="...">
                                                <span class="text-truncate w-150px">{{pathinfo($attachment->url, PATHINFO_FILENAME)}}</span>
                                                <form id="attachmentRemoveForm" method="post" action="{{url('projects')}}/{{$project->id}}/attachment/{{$attachment->id}}/remove">
                                                    {{csrf_field()}}
                                                    {{method_field('delete')}}
                                                    <button type="submit" class="close cursor-pointer remove-attachment">&times;</button>
                                                </form>
                                            </a>
                                        @endforeach
                                    @endif
                                    <a class="avatar avatar-add avatar-lg hover-white cursor-pointer add-attachment"></a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 comments-container">
                            <div class="card">
                                <div class="card-header"><h4>Comments</h4></div>
                                <div class="card-body">
                                    <div class="media-list media-list-divided">
                                        <div class="media">
                                            @if(isset($project->comments) && count($project->comments) > 0)
                                                @foreach($project->comments as $comment)
                                                    <a class="avatar" href="#">
                                                        <img src="{{isset($comment->user) ? $comment->user->avatar : null}}" alt="...">
                                                    </a>
                                                    <div class="media-body">
                                                        <p>
                                                            <a href="{{url('users')}}/{{isset($comment->user) ? $comment->user->id : null}}/profile"><strong>{{isset($comment->user) ? $comment->user->full_name : 'No Name'}}</strong></a>
                                                            <time class="float-right text-fade" datetime="2018-07-14 20:00">{{date('m/d/Y',strtotime($comment->created_at))}}</time>
                                                        </p>
                                                        <p>{{$comment->comment}}</p>
                                                        <p>
                                                            {{--<span class="cursor-pointer badge badge-gray mr-1">Edit</span> --}}
                                                        @if(auth()->user()->id==$comment->user->id)
                                                            <form id="commentDeleteForm" method="post" action="{{url('projects')}}/comment/{{$comment->id}}/remove">
                                                                {{csrf_field()}}
                                                                {{method_field('delete')}}
                                                                <button type="submit" class="btn btn-xs btn-outline-danger mr-5 mt-1 remove-comment">Delete</button>
                                                            </form>
                                                        @endif
                                                        </p>
                                                    </div>
                                                @endforeach
                                                @else
                                                <h4>No comments</h4>
                                            @endif
                                        </div>
                                    </div>
                                    <form class="publisher bg-transparent bt-1 border-fade" method="post" action="{{url('projects/comment')}}">
                                        {{csrf_field()}}
                                        <textarea name="comment" class="publisher-input" style="resize: none" placeholder="Add Comment">{{old('comment')}}</textarea>
                                        {{--<input class="publisher-input" type="text" placeholder="Add Comment">--}}
                                        <input type="hidden" name="type" value="project">
                                        <input type="hidden" name="project_id" value="{{$project->id}}">
                                        <button type="submit" class="publisher-btn" href="#"><i class="fe fe-arrow-right"></i></button>
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
    <script data-provide="sweetalert">
        window.onload=function(){
            $('.add-attachment').click(function(){
                $('#file-input').trigger('click');
            })

            $('.project-container').on('click','.complete-project',function(e){
                e.preventDefault();
                swal({
                    title: 'Are you sure?',
                    text: "You can't revert this later!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes'
                }).then(function() {
                    $('#compeleteProjectForm').submit();
                })
            })

            $('.project-container').on('click','.archive-project',function(e){
                e.preventDefault();
                swal({
                    title: 'Are you sure?',
                    text: "You can't revert this later!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes'
                }).then(function() {
                    $('#archiveProjectForm').submit();
                })
            })

            $('.project-container').on('click','.delete-project',function(e){
                e.preventDefault();
                swal({
                    title: 'Are you sure?',
                    text: "You can't revert this later!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes'
                }).then(function() {
                    $('#deleteProjectForm').submit();
                })
            })

            $('.members-container').on('click','.remove-member',function(e){
                e.preventDefault();
                e.stopImmediatePropagation();
                swal({
                    title: 'Are you sure?',
                    text: "You can revert this later!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes'
                }).then(function() {
                    $('#memberRemoveForm').submit();
                })
            })

            $('.attachments-container').on('click','.remove-attachment',function(e){
                e.preventDefault();
                e.stopImmediatePropagation();
                swal({
                    title: 'Are you sure?',
                    text: "You can revert this later!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes'
                }).then(function() {
                    $('#attachmentRemoveForm').submit();
                })
            })

            $('.comments-container').on('click','.remove-comment',function(e){
                e.preventDefault();
                swal({
                    title: 'Are you sure?',
                    text: "You can't revert this later!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes'
                }).then(function() {
                    $('#commentDeleteForm').submit();
                })
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