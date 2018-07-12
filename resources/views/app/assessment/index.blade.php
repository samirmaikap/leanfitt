@extends('layouts.app')
@section('content')
    <main class="main-container">
        <!-- Page aside -->
        <aside class="aside aside-expand-md">
            <div class="aside-body">
                {{--@if(strtolower(session('role'))=='superadmin')--}}
                    {{--<div class="aside-block mt-20">--}}
                        {{--<div class="flexbox mb-1">--}}
                            {{--<h6 class="aside-title">Organizations</h6>--}}
                        {{--</div>--}}

                        {{--<ul class="nav nav-pills flex-column">--}}
                            {{--@if(count($organizations) > 0)--}}
                                {{--@foreach($organizations as $organization)--}}
                                    {{--<li class="nav-item {{$organization_id == $organization['id'] ? 'active' : ''}}">--}}
                                        {{--<a class="nav-link" href="{{url('/assessment?organization=').$organization['id']}}">{{$organization['name']}}</a>--}}
                                    {{--</li>--}}
                                {{--@endforeach--}}
                            {{--@endif--}}
                        {{--</ul>--}}
                    {{--</div>--}}
                    {{--<hr>--}}
                {{--@endif--}}

                <div class="aside-block mt-20">
                    <div class="flexbox mb-1">
                        <h6 class="aside-title">Organizations</h6>
                    </div>

                    <ul class="nav nav-pills flex-column">
                        @if(count($organizations) > 0)
                            @foreach($organizations as $organization)
                                <li class="nav-item {{$organization_id == $organization['id'] ? 'active' : ''}}">
                                    <a class="nav-link" href="{{url('/assessment?organization=').$organization['id']}}">{{$organization['name']}}</a>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
                <hr>
                <div class="aside-block">
                    <div class="flexbox mb-1">
                        <h6 class="aside-title">Departments</h6>
                    </div>

                    <ul class="nav nav-pills flex-column">
                        @if(count($departments) > 0)
                            @foreach($departments as $department)
                                <li class="nav-item {{($department_id == $department['id']) ? 'active' : '' }}">
                                    <a class="nav-link" href="{{url('/assessment?organization=').$organization_id}}&department={{$department['id']}}">{{$department['name']}}</a>
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
                                <li class="nav-item {{($user_id == $user['id']) ? 'active' : '' }}">
                                    <a class="nav-link" href="{{url('/assessment?organization=').$organization_id}}&department={{$department_id}}&user={{$user['id']}}">{{$user['name']}}</a>
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
        <!-- END Page aside -->
        <header class="header no-border">
            <div class="header-bar">
                <h4>assessment</h4>
            </div>
        </header>

        <div class="main-content">
            <div class="row">
                @if(count($assessments) > 0)
                    @foreach($assessments as $assessment)
                        <div class="col-md-6 col-lg-3">
                            <div class="card">
                                <div class="card-body text-center h-250px">
                                    <a href="javascript:void(0)">
                                        <img class="avatar avatar-xxl" src="{{$assessment->user_avatar}}">
                                    </a>
                                    <h5 class="mt-3 mb-1"><a class="hover-primary" href="#">{{$assessment->user_first_name}} {{$assessment->user_last_name}}</a></h5>
                                    <span class="d-block">{{$assessment->depart_name}}</span>
                                    <span class="text-fade d-block">{{\Carbon\Carbon::parse(\Carbon\Carbon::parse($assessment->updated_at))->diffForHumans(\Carbon\Carbon::now())}} </span>
                                </div>
                                @php
                                   $assessment_result=json_decode($assessment->result,true);
                                @endphp
                                <div class="flexbox flex-justified bt-1 border-light py-12 bg-lightest text-center">
                                    <span class="text-muted">
                                        <i class="fe fe-activity fs-20"></i><br>
                                        {{count($assessment_result)}} Tools
                                    </span>
                                    <span class="text-muted">
                                        <i class="fe fe-target fs-20"></i><br>
                                        {{$assessment_result['Average']}} Score
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <h3 class="text-danger p-20">No result found</h3>
                @endif


            </div>
        </div>
@endsection