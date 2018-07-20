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
                                <li class="nav-item {{$organization_id == $organization->id ? 'active' : ''}}">
                                    <a class="nav-link" href="{{url('/assessment?organization=').$organization->id}}">{{$organization->name}}</a>
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
                                <li class="nav-item {{($department_id == $department->id) ? 'active' : '' }}">
                                    <a class="nav-link" href="{{url('/assessment?organization=').$organization_id}}&department={{$department->id}}">{{$department->name}}</a>
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
                                    <a class="nav-link" href="{{url('/assessment?organization=').$organization_id}}&department={{$department_id}}&user={{$user->id}}">{{$user->first_name}} {{$user->last_name}}</a>
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
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-striped table-bordered" cellspacing="0" data-provide="datatables">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Max Score</th>
                                    <th>Min Score</th>
                                    <th>Average</th>
                                    <th>Date</th>
                                </tr>
                                </thead>
                                <tbody>

                                @if(count($assessments) > 0)
                                    @foreach($assessments as $assessment)
                                        @php
                                            $assessment_result=json_decode($assessment->result,true);
                                            $min=array_keys($assessment_result, min($assessment_result))[0];
                                            $max=array_keys($assessment_result, max($assessment_result))[0];
                                        @endphp
                                        <tr>
                                            <td class="">
                                                <img class="avatar avatar-sm" src="{{ $assessment->avatar }}" alt="">
                                                <a href="{{url("users")}}/{{$assessment->user_id}}/profile">
                                                    {{ $assessment->first_name }} {{$assessment->last_name}}
                                                </a>
                                            </td>
                                            <td>{{$max}} ({{$assessment_result[$max]}})</td>
                                            <td>{{$min}} ({{$assessment_result[$min]}})</td>
                                            <td>{{$assessment_result['Average']}}</td>
                                            <td>{{ date('m/d/Y h:i A', strtotime($assessment->created_at)) }}</td>
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