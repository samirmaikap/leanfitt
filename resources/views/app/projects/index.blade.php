@extends('layouts.app')
@section('content')
    <main class="main-container">
        @php $colors=['brown','success','danger','warning','primary','info','cyan']; @endphp
        <header class="header no-border">
            <div class="header-bar">
                <h4>Projects</h4>
                <a href="{{url('lean-tools/create')}}" class="btn btn-round btn-success">Create</a>
            </div>
        </header>

        <div class="main-content">
            <div class="row">
                <div class="col-md-12 col-lg-4">
                    @php $color=$colors[array_rand($colors)]; @endphp
                    <div class="card text-white card-{{$color}} bg-img" >
                        <div class="card-body h-250px">
                            <h3 class="text-white">Project Nmae</h3>
                            <p class="">Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
                            <p>Start Date: 17 Jul 2018</p>
                            <p>End Date: 17 Jul 2018</p>
                            <p>
                                <span class="mr-3">5 <i class="fe ml-1 fe-users"></i></span>
                                <span class="mr-3">5 <i class="fe ml-1 fe-clipboard"></i></span>
                            </p>
                        </div>
                        <div class="card-footer text-center py-20" data-overlay="4">
                            <a href="#" class="btn btn-outline text-{{$color}}">Kpi</a>
                            <a href="#" class="btn btn-outline text-{{$color}}">Action Items</a>
                            <a href="#" class="btn btn-outline text-{{$color}}">Reports</a>
                            <a href="#" class="btn btn-outline text-{{$color}}">View</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection