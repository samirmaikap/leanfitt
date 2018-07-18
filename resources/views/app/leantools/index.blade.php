@extends('layouts.app')
@section('content')
    <main class="main-container">
        <header class="header no-border">
            <div class="header-bar">
                <h4>Lean Tools</h4>
                {{--@if(strtolower(session('role'))=='superadmin')--}}
                    {{--<a href="{{url('leantool/create')}}" class="btn btn-round btn-success">Create</a>--}}
                {{--@endif--}}
                <a href="{{url('lean-tools/create')}}" class="btn btn-round btn-success">Create</a>
            </div>
        </header>

        <div class="main-content">
            <div class="row">
                @if(count($tools) > 0)
                    @foreach($tools as $tool)
                        <div class="col-md-12 col-lg-6">
                            <div class="card card-inverse bg-img" style="background-image:{{url('/assets/img/gallery/2.jpg')}}; padding-top: 275px">
                                <div class="flexbox align-items-center px-20" data-overlay="4">
                                    <div class="flexbox align-items-center mr-auto">
                                        <div class="pl-12 d-none d-md-block">
                                            <h5 class="mb-0"><a class="hover-primary text-white" href="#">{{ucfirst($tool->name)}}</a></h5>
                                            <span>{{$tool->quiz_count}} Questions</span>
                                        </div>
                                    </div>

                                    <ul class="flexbox flex-justified text-center py-20">
                                        @if(session('role')=='employee')
                                            <li class="px-10">
                                                <a href="{{url('/leantool/view').'/'.$tool->id}}" class="btn btn-round btn-primary">View</a>
                                            </li>
                                        @else
                                            <li class="px-10">
                                                <a href="{{url('/lean-tools/view').'/'.$tool->id}}" class="btn btn-round btn-primary">View</a>
                                            </li>
                                            <li class="px-10">
                                                <a href="{{url('lean-tools/edit').'/'.$tool->id}}" class="btn btn-round btn-primary">Edit</a>
                                            </li>
                                        @endif

                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                   <h3 class="text-danger p-20">No tool found</h3>
                @endif

            </div>
        </div>
@endsection