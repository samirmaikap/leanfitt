@extends('layouts.app')
@section('content')
    <main class="main-container">
        <header class="header no-border">
            <div class="header-bar">
                <h4>Organization Profile</h4>
            </div>
        </header>
        <div class="main-content">
            <div class="row">
                <div class="col-lg-4 col-sm-12">
                    <div class="card">
                        <form method="post" action="{{url('organizations')}}/{{$organization->id}}" enctype="multipart/form-data">
                            {{csrf_field()}}
                            {{method_field('put')}}
                            <div class="card-header pt-20 pb-20">
                                <div class="flexbox gap-items-4">
                                    <img class="avatar avatar-xl" id="user-avatar" src="{{isset($organization->featured_image) ? $organization->featured_image : ''}}" alt="...">
                                    <div class="flex-grow">
                                        <h5>{{isset($organization->name) ? $organization->name : ''}}</h5>
                                        <div class="d-flex flex-column flex-sm-row gap-items-2 gap-y mt-16">
                                            <div class="file-group file-group-inline">
                                                <button class="btn btn-sm btn-w-lg btn-outline btn-round btn-secondary file-browser" type="button">Change Picture</button>
                                                <input type="file" name="image" id="imgInp" onchange="loadFile(event)">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @php $status=isset($stripe->subscriptions) ? $stripe->subscriptions->data[0]->status : 'N/A';  @endphp
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="text-dark">Name</label>
                                    <input class="form-control" name="name" value="{{isset($organization->name) ? $organization->name : ''}}" type="text">
                                </div>
                                <div class="form-group">
                                    <label class="text-dark">Contact Person</label>
                                    <input class="form-control" name="contact_person" value="{{isset($organization->contact_person) ? $organization->contact_person : ''}}" type="text">
                                </div>
                                <div class="form-group">
                                    <label class="text-dark">Email</label>
                                    <input class="form-control" type="text" value="{{isset($organization->email) ? $organization->email : ''}}" disabled="disabled">
                                </div>
                                <div class="form-group">
                                    <label class="text-dark">Phone</label>
                                    <input class="form-control" name="phone" value="{{isset($organization->phone) ? $organization->phone : ''}}" type="text">
                                </div>
                                <div class="form-group text-center">
                                    <label class="text-dark d-block">Current Plan: {{isset($stripe->subscriptions) ? $stripe->subscriptions->data[0]->plan->id : 'N/A'}}</label>
                                    <label class="text-dark d-block">Billing Interval: {{isset($stripe->subscriptions) ? ucfirst($stripe->subscriptions->data[0]->plan->interval) : 'N/A'}}</label>
                                    <label class="text-dark d-block">Billing Type: {{isset($stripe->subscriptions) ? ucwords(str_replace('_' ,' ',$stripe->subscriptions->data[0]->billing)) : 'N/A'}}</label>
                                    <label class="text-dark d-block">Subscription Status: {!! $status=='active' ? '<span class="text-success">'.ucfirst($status).'</span>' : '<span class="text-warning">'.ucfirst($status).'</span>' !!}</label>
                                </div>
                            </div>
                            @if(!isSuperadmin())
                                @permission('update.organization')
                                <div class="card-body text-center pb-20">
                                    @if(empty($organization->subscriptions[0]->ends_at))
                                        <button type="button" class="btn btn-danger revoke-subscription">Cancel Subscription</button>
                                    @else
                                        <button type="button" class="btn btn-primary resume-subscription">Resume Subscription</button>
                                    @endif

                                    <button type="submit" class="btn btn-success">Update</button>
                                </div>
                                @endpermission
                            @endif
                        </form>
                    </div>
                </div>
                <div class="col-lg-8 col-sm-12">
                    <div class="card card-slided-down">
                        <header class="card-header border-0">
                            <h4 class="card-title"><strong>Departments</strong></h4>
                            <ul class="card-controls">
                                <li><a class="card-btn-slide" href="#"></a></li>
                            </ul>
                        </header>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media-list media-list-divided scrollable" style="max-height: 345px">
                                    @if(isset($organization->departments) && count($organization->departments) > 0)
                                        @foreach($organization->departments as $department)
                                            <div class="media media-single">
                                                <span class="title">{{$department->name}}</span>
                                                <span class="badge badge-pill badge-secondary" title="{{$department->users_count}} Users">{{$department->users_count}}</span>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="media media-single">
                                            <span class="title text-danger">No departments</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card card-slided-up">
                        <header class="card-header border-0">
                            <h4 class="card-title"><strong>Roles</strong></h4>
                            <ul class="card-controls">
                                <li><a class="card-btn-slide" href="#"></a></li>
                            </ul>
                        </header>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media-list media-list-divided scrollable" style="max-height: 345px">
                                    @if(isset($organization->roles) && count($organization->roles) > 0)
                                        @foreach($organization->roles as $role)
                                            <div class="media media-single">
                                                <span class="title">{{$role->name}}</span>
                                                <span class="badge badge-pill badge-secondary" title="{{$role->users_count}} Users">{{$role->users_count}}</span>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="media media-single">
                                            <span class="title text-danger">No roles</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card card-slided-up">
                        <header class="card-header border-0">
                            <h4 class="card-title"><strong>Projects</strong></h4>
                            <ul class="card-controls">
                                <li><a class="card-btn-slide" href="#"></a></li>
                            </ul>
                        </header>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media-list media-list-divided scrollable" style="max-height: 345px">
                                    @if(isset($organization->project) && count($organization->project) > 0)
                                        @foreach($organization->project as $project)
                                            <div class="media media-single">
                                                <span class="title">{{$project->name}}</span>
                                                @if($project->is_completed==1)
                                                    <span class="badge badge-pill badge-success">Completed</span>
                                                @elseif($project->is_archived==1)
                                                    <span class="badge badge-pill badge-warning">Completed</span>
                                                @else
                                                    <span class="badge badge-pill badge-info">Ongoing</span>
                                                @endif
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="media media-single">
                                            <span class="title text-danger">No departments</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script data-provide="sweetalert">
            window.onload=function(){

                $('.revoke-subscription').on('click',function () {
                    var $this=$(this);
                    swal({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, cancel it!'
                    }).then(function() {
                        window.location.href="{{url('organizations/subscription/revoke')}}"
                    })
                })

                $('.resume-subscription').on('click',function () {
                    var $this=$(this);
                    swal({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, resume it!'
                    }).then(function() {
                        window.location.href="{{url('organizations/subscription/resume')}}"
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
            var loadFile = function(event) {
                var output = document.getElementById('user-avatar');
                output.src = URL.createObjectURL(event.target.files[0]);
            }
        </script>
    </main>
@endsection