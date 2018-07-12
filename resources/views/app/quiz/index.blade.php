@extends('layouts.app')
@section('content')
    <main class="main-container">
        <!-- Page aside -->
        <aside class="aside aside-expand-md">
            <div class="aside-body">
                <div class="aside-block mt-20">
                    <div class="flexbox mb-1">
                        <h6 class="aside-title">Organizations</h6>
                    </div>

                    <ul class="nav nav-pills flex-column">
                        @if(count($organizations) > 0)
                            @foreach($organizations as $organization)
                                <li class="nav-item {{$organization_id == $organization['id'] ? 'active' : ''}}">
                                    <a class="nav-link" href="{{url('/quizzes?organization=').$organization['id']}}">{{$organization['name']}}</a>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
                <hr>
                {{--@if(strtolower(session('role')=='superadmin'))--}}
                    {{--<div class="aside-block mt-20">--}}
                        {{--<div class="flexbox mb-1">--}}
                            {{--<h6 class="aside-title">Organizations</h6>--}}
                        {{--</div>--}}

                        {{--<ul class="nav nav-pills flex-column">--}}
                            {{--@if(count($organizations) > 0)--}}
                                {{--@foreach($organizations as $organization)--}}
                                    {{--<li class="nav-item {{$organization_id == $organization['id'] ? 'active' : ''}}">--}}
                                        {{--<a class="nav-link" href="{{url('/quiz?organization=').$organization['id']}}">{{$organization['name']}}</a>--}}
                                    {{--</li>--}}
                                {{--@endforeach--}}
                            {{--@endif--}}
                        {{--</ul>--}}
                    {{--</div>--}}
                    {{--<hr>--}}
                {{--@endif--}}

                <div class="aside-block">
                    <div class="flexbox mb-1">
                        <h6 class="aside-title">Departments</h6>
                    </div>

                    <ul class="nav nav-pills flex-column">
                        @if(count($departments) > 0)
                            @foreach($departments as $department)
                                <li class="nav-item {{($department_id == $department['id']) ? 'active' : '' }}">
                                    <a class="nav-link" href="{{url('/quizzes?organization=').$organization_id}}&department={{$department['id']}}">{{$department['name']}}</a>
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
                                    <a class="nav-link" href="{{url('/quizzes?organization=').$organization_id}}&department={{$department_id}}&user={{$user['id']}}">{{$user['name']}}</a>
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
                <h4>Quiz</h4>
            </div>
        </header>

        <div class="main-content">
            <div class="row">
                @if(count($quizs) > 0)
                    @foreach($quizs as $quiz)
                        <div class="col-md-6 col-lg-3">
                            <div class="card">
                                <div class="card-body text-center" style="height: 270px">
                                    <a href="javascript:void(0)">
                                        <img class="avatar avatar-xxl" src="{{$quiz->avatar}}">
                                    </a>
                                    <h5 class="mt-3 mb-1"><a class="hover-primary" href="#">{{$quiz->first_name}} {{$quiz->last_name}}</a></h5>
                                    <span class="d-block">{{$quiz->department_name}}</span>
                                    <span class="text-fade d-block ">{{ucfirst($quiz->tool_name)}}</span>
                                    <span class="text-fade d-block">{{\Carbon\Carbon::parse(\Carbon\Carbon::parse($quiz->updated_at))->diffForHumans(\Carbon\Carbon::now())}} </span>
                                </div>

                                <div class="flexbox flex-justified bt-1 border-light py-12 bg-lightest text-center">
                                    <span class="text-muted">
                                        <i class="fe fe-activity fs-20"></i><br>
                                        {{$quiz->correct}} Correct
                                    </span>
                                    <span class="text-muted">
                                        <i class="fe fe-target fs-20"></i><br>
                                        {{$quiz->score}}% Score
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