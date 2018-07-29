@extends('layouts.app')
@section('content')
<main class="main-container">
    <!-- Page aside -->
    @if(isSuperadmin() || isAdmin())
    <aside class="aside aside-expand-md">
        <div class="aside-body">
            @if(isSuperadmin())
                <div class="aside-block mt-20">
                    <div class="flexbox mb-1">
                        <h6 class="aside-title">Organizations</h6>
                    </div>

                    <ul class="nav nav-pills flex-column">
                        @if(count($organizations) > 0)
                            @foreach($organizations as $organization)
                                <li class="nav-item {{$organization_id == $organization->id ? 'active' : ''}}">
                                    <a class="nav-link text-truncate w-160px" href="{{url('/awards?organization=').$organization->id}}">{{$organization->name}}</a>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
                <hr>
            @endif
            <div class="aside-block">
                <div class="flexbox mb-1">
                    <h6 class="aside-title">Departments</h6>
                </div>

                <ul class="nav nav-pills flex-column">
                    @if(count($departments) > 0)
                    @foreach($departments as $department)
                    <li class="nav-item {{($department_id == $department->id) ? 'active' : '' }}">
                        <a class="nav-link text-truncate" href="{{url('/awards?organization=').$organization_id}}&department={{$department->id}}">{{$department->name}}</a>
                    </li>
                    @endforeach
                    @else
                    <li class="nav-item">
                        <span class="nav-link text-danger">No department found</span>
                    </li>
                    @endif
                </ul>
            </div>

            <hr>

            <div class="aside-block mb-20">
                <div class="flexbox mb-1">
                    <h6 class="aside-title">users</h6>
                </div>

                <ul class="nav nav-pills flex-column">
                    @if(count($users) > 0)
                    @foreach($users as $user)
                    <li class="nav-item {{($user_id == $user->id) ? 'active' : '' }}">
                        <a class="nav-link text-truncate" href="{{url('/awards?organization=').$organization_id}}&department={{$department_id}}&user={{$user->id}}">{{ucfirst($user->first_name)}} {{ucfirst($user->last_name)}}</a>
                    </li>
                    @endforeach
                    @else
                    <li class="nav-item">
                        <span class="nav-link text-danger">No user found</span>
                    </li>
                    @endif
                </ul>
            </div>
        </div>

        <button class="aside-toggler"></button>
    </aside>
    @endif
    <!-- END Page aside -->
    <header class="header no-border">
        <div class="header-bar">
            <h4>Awards</h4>
        </div>
    </header>

    <div class="main-content">
        <div class="row">
            <div class="col-lg-12">
                @if(count($awards) > 0)
                    <ol class="timeline" id="demo-timeline-alignment">
                        @foreach($awards as $award)
                            <li class="timeline-block">
                                <div class="timeline-detail">
                                    <time>{{date('m/d/Y',strtotime($award->created_at))}}</time><br>
                                </div>
                                <div class="timeline-point">
                                    <span class="avatar bg-primary"><i class="fa fa-trophy"></i></span>
                                </div>

                                <div class="timeline-content">
                                    <div class="card">
                                        <div class="media align-items-center">
                                            <img class="avatar avatar-lg" src="{{$award->avatar}}" alt="...">
                                            <div class="media-body">
                                                <p class="lead">{{ucfirst($award->first_name)}} {{ucfirst($award->last_name)}}</p>
                                                <p>{{$award->title}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach

                    </ol>
                @else
                    <h3 class="py-20 text-danger">No awards available</h3>
                @endif
            </div>
        </div>
    </div>
    @endsection