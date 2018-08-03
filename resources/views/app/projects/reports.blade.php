@extends('layouts.app')
@section('content')
    <main>
        @include('app.projects.partials.header')
        <div class="main-content">
            <div class="row">
                @if(count($reports) > 0)
                    @foreach($reports as $report)
                        <div class="col-lg-3 col-md-4 col-sm-12">
                            <a href="{{url('projects')}}/{{$project->id}}/reports/{{$report->id}}">
                                <div class="card">
                                    <div class="card-body text-center pt-50">
                                        <div class="mb-20">
                                            <img class="avatar avatar-xxl" src="../assets/img/avatar/1.jpg">
                                        </div>
                                        <span class="fs-15 mt-3 mb-1"><strong>{{$report->report_category}}</strong></span>
                                        <p class="text-fade">Created : {{date('m/d/Y',strtotime($report->created_at))}}</p>
                                    </div>
                                    <div class="card-body text-center pb-20">
                                        <button class="btn btn-danger btn-round">Delete</button>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                @else
                    <h3 class="py-20 text-danger">No reports found</h3>
                @endif
            </div>
        </div>
    </main>
    <div class="fab fab-fixed">
        <button class="btn btn-float btn-primary" data-toggle="modal" data-target="#modal-report">
            <i class="fab-icon-default ti-plus"></i>
        </button>
    </div>
    <div class="modal modal-center fade" id="modal-report" tabindex="-1">
        <div class="modal-dialog mt-30 ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Choose a report</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{url('projects')}}/reports" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="input-normal">Module Name</label>
                            <select id="report-category" name="lean_tool_id" data-provide="selectpicker" data-width="100%">
                                @if(count($categories) > 0)
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}" data-info="{{$category->description}}">{{$category->name}}</option>
                                    @endforeach
                                @else
                                    <option value="">None</option>
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <p class="category-info"></p>
                        </div>
                        <input type="hidden" name="project_id" value="{{$project->id}}">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-bold btn-pure btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-bold btn-pure btn-primary">Create</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <script>
        window.onload=function(){
            $('select').on('change',function(){
                var info=$('select option:selected').data('info');
                $('.category-info').text(info);
            })

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