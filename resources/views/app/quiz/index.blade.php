@extends('layouts.app')
@section('content')
    <main class="main-container">
        <!-- Page aside -->
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
                                        <a class="nav-link text-truncate w-160px" href="{{url('/quizzes?organization=').$organization->id}}">{{$organization->name}}</a>
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
                                    <a class="nav-link" href="{{url('/quizzes?organization=').$organization_id}}&department={{$department->id}}">{{$department->name}}</a>
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
                                    <a class="nav-link" href="{{url('/quizzes?organization=').$organization_id}}&department={{$department_id}}&user={{$user->id}}">{{$user->first_name}} {{$user->last_name}}</a>
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
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-striped table-bordered" cellspacing="0" data-provide="datatables">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Lean tool</th>
                                    <th>Score</th>
                                    <th>Correct</th>
                                    <th>Incrorrect</th>
                                    <th>Date</th>
                                </tr>
                                </thead>
                                <tbody>

                                @if(count($quizs) > 0)
                                    @foreach($quizs as $quiz)
                                        <tr>
                                            <td class="">
                                                <img class="avatar avatar-sm" src="{{$quiz->avatar }}" alt="">
                                                <a href="{{url("users")}}/{{$quiz->user_id}}/profile">
                                                    {{ $quiz->first_name }} {{$quiz->last_name}}
                                                </a>
                                            </td>
                                            <td>{{$quiz->tool_name}}</td>
                                            <td>{{$quiz->score}}</td>
                                            <td>{{$quiz->correct}}</td>
                                            <td>{{$quiz->incorrect}}</td>
                                            <td>{{ date('m/d/Y h:i A', strtotime($quiz->created_at)) }}</td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
@endsection