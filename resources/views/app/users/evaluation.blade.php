@extends('layouts.app')
@section('content')
    <main class="main-container">
        <aside class="aside aside-expand-md">
            <div class="aside-body">
                <div class="aside-block mt-20">
                    <div class="flexbox mb-1">
                        <h6 class="aside-title">Users</h6>
                    </div>

                    <ul class="nav nav-pills flex-column">
                        @if(count($users) > 0)
                            @foreach($users as $user)
                                <li class="nav-item {{$user_id==$user->id  ? 'active' : ''}}">
                                    <a href="{{url('evaluations')}}?user={{$user->id}}" class="nav-link text-truncate w-160px">{{$user->first_name}} {{$user->last_name}}</a>
                                </li>
                            @endforeach
                        @else
                            <li class="nav-item">
                                <a class="nav-link text-truncate w-160px">No users found</a>
                            </li>
                        @endif
                    </ul>
                </div>
                <hr>
                <div class="aside-block mt-20">
                    <div class="flexbox mb-1">
                        <h6 class="aside-title">Evaluators</h6>
                    </div>

                    <ul class="nav nav-pills flex-column">
                        @if(count($evaluators) > 0)
                            @foreach($evaluators as $evaluator)
                                <li class="nav-item {{$evaluator_id==$evaluator->id  ? 'active' : ''}}">
                                    <a href="{{url('evaluations')}}?evaluator={{$evaluator->id}}" class="nav-link text-truncate w-160px">{{$user->first_name}} {{$user->last_name}}</a>
                                </li>
                            @endforeach
                        @else
                            <li class="nav-item">
                                <a class="nav-link text-truncate w-160px">No users found</a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>

            <button class="aside-toggler"></button>
        </aside>

        <header class="header no-border">
            <div class="header-bar">
                <h4>Evaluations</h4>
            </div>
        </header>
        <div class="main-content">
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped table-bordered" cellspacing="0" data-provide="datatables">
                        <thead>
                        <tr>
                            <td>Name</td>
                            <th>Communication</th>
                            <th>Enthusiasm</th>
                            <th>participation</th>
                            <th>Quality Work</th>
                            <th>Dependability</th>
                            <th>Evaluator</th>
                            <th>Date</th>
                            <th>Remark</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($evaluations as $evaluation)
                            <tr>
                                <td>{{$evaluation->first_name}} {{$evaluation->last_name}}</td>
                                <td>{{$evaluation->communication}}</td>
                                <td>{{$evaluation->enthusiasm}}</td>
                                <td>{{$evaluation->participation}}</td>
                                <td>{{$evaluation->quality_work}}</td>
                                <td>{{$evaluation->dependability}}</td>
                                <td>{{$evaluation->evaluator->first_name}} {{$evaluation->evaluator->last_name }}</td>
                                <td>{{date('m/d/Y',strtotime($evaluation->created_at))}}</td>
                                <td><span class="cursor-pointer" data-toggle="modal" data-target="#modal-remark-{{$evaluation->id}}"><i class="ti-eye"></i></span></td>
                            </tr>
                            <div class="modal modal-center fade" id="modal-remark-{{$evaluation->id}}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Remark</h5>
                                            <button type="button" class="close" data-dismiss="modal">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>{{empty($evaluation->remark) ? 'Not available'  : $evaluation->remark}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
@endsection