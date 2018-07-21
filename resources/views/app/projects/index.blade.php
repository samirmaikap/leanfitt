@extends('layouts.app')
@section('content')
    <main class="main-container">
        @php $colors=['brown','success','danger','warning','primary','info','cyan']; @endphp
        <header class="header no-border">
            <div class="header-bar">
                <h4>Projects</h4>
                <button class="btn btn-round btn-success" data-toggle="modal" data-target="#modal-project">Create</button>
            </div>
        </header>

        <div class="main-content">
            <div class="row">
                @if(count($projects) > 0 )
                    @foreach($projects as $project)
                        <div class="col-md-12 col-lg-6">
                            @php $color=$colors[array_rand($colors)]; @endphp
                            <div class="card text-white card-{{$color}} bg-img" >
                                <div class="card-body h-250px">
                                    <h3 class="text-white">{{$project->name}}</h3>
                                    <p class="">{{$project->note}}</p>
                                    <p>Start Date: {{date('m/d/Y',strtotime($project->start_date))}}</p>
                                    <p>End Date: {{date('m/d/Y',strtotime($project->end_date))}}</p>
                                    <p>Report Date: {{date('m/d/Y',strtotime($project->report_date))}}</p>
                                    <p>
                                        <span class="mr-3" title="{{$project->member_count}} Members">{{$project->member_count}} <i class="fe ml-1 fe-users"></i></span>
                                        <span class="mr-3" title="{{$project->attachments_count}} Attachments">{{$project->attachments_count}} <i class="fe ml-1 fe-paperclip"></i></span>
                                        <span class="mr-3" title="{{$project->comments_count}} Comments">{{$project->comments_count}} <i class="fe ml-1 fe-message-circle"></i></span>
                                    </p>
                                </div>
                                <div class="card-footer text-center py-20" data-overlay="4">
                                    <a href="{{url('projects')}}/{{$project->id}}/kpi" class="btn btn-round btn-outline text-{{$color}}">Kpi</a>
                                    <a href="{{url('projects')}}/{{$project->id}}/action-items" class="btn btn-round btn-outline text-{{$color}}">Action Items</a>
                                    <a href="{{url('projects')}}/{{$project->id}}/reports" class="btn btn-round btn-outline text-{{$color}}">Reports</a>
                                    <a href="{{url('projects')}}/{{$project->id}}/details" class="btn btn-round btn-outline text-{{$color}}">View</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif

            </div>
        </div>
        <div class="modal modal-top fade" id="modal-project" tabindex="-1">
            <div class="modal-dialog mt-30 ">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">New Project</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="post" action="{{url('projects')}}" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="input-normal">Name</label>
                                <input type="text" name="name" class="form-control" id="input-normal" value="{{old('name')}}">
                            </div>
                            <div class="form-group">
                                <label for="textarea">Description</label>
                                <textarea name="note" class="form-control" id="textarea" rows="2">{{old('note')}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="input-normal">Goal</label>
                                <textarea name="goal" class="form-control" id="textarea" rows="2">{{old('goal')}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="input-normal">Start Date</label>
                                <input type="text" name="start_date" class="form-control" id="input-normal" data-provide="datepicker" data-date-today-highlight="true" value="{{old('start_date')}}">
                            </div>
                            <div class="form-group">
                                <label for="input-normal">End Date</label>
                                <input type="text" name="end_date" class="form-control" id="input-normal" data-provide="datepicker" data-date-today-highlight="true" value="{{old('end_date')}}">
                            </div>
                            <div class="form-group">
                                <label for="input-normal">Report Date</label>
                                <input type="text" name="report_date" class="form-control" id="input-normal" data-provide="datepicker" data-date-today-highlight="true" value="{{old('report_date')}}">
                            </div>
                            <input type="hidden" name="organization_id" value="{{pluckSession('id')}}">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-bold btn-pure btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-bold btn-pure btn-primary">Save</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </main>
    <script>
        window.onload=function(){
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
    </script>
@endsection