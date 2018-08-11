@extends('layouts.app')
@section('content')
    <main class="main-container">
        <header class="header no-border">
            <div class="header-bar">
                <h4>Lean Tools</h4>
                {{--@if(strtolower(session('role'))=='superadmin')--}}
                    {{--<a href="{{url('leantool/create')}}" class="btn btn-round btn-success">Create</a>--}}
                {{--@endif--}}
                @if(isSuperadmin())
                    <a href="{{url('lean-tools/create')}}" class="btn btn-round btn-success">Create</a>
                @endif
            </div>
        </header>

        <div class="main-content">
            <div class="row">
                @if(count($tools) > 0)
                    @foreach($tools as $tool)
                        <div class="col-md-12 col-lg-6">
                            <div class="card card-inverse">
                                <h4 class="card-title">{{ucfirst($tool->name)}}</h4>
                                <div class="card-body" style="min-height: 350px">
                                    <img class="w-70px h-70px mb-20" src="{{ url(asset('assets/icons/light/') . str_slug(strtolower($tool->name),'_') . '.png') }}">
                                    <p>{{$tool->description}}</p>
                                    <span>{{$tool->quiz_count}} Questions</span>
                                </div>
                                <div class="card-footer text-center">
                                    <a href="{{url('/lean-tools/view').'/'.$tool->id}}" class="btn btn-round btn-primary">View</a>
                                    @if(isSuperadmin())
                                        <a href="{{url('lean-tools/edit').'/'.$tool->id}}" class="btn btn-round btn-primary">Edit</a>
                                    @endif
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