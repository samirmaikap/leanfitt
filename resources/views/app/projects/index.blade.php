@extends('layouts.app')
@section('content')

    <main>
        <div class="main-content">
            <div class="card">
                <h4 class="card-title"><strong>All Projects</strong></h4>
                <div class="card-body">

                    <table class="table table-striped table-bordered" cellspacing="0" data-provide="datatables">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Members</th>
                            <th>Action Items</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($projects as $project)
                        <tr>
                            <td>{{ $project['name'] }}</td>
                            <td>{{ $project['member_count'] }}</td>
                            <td>{{ $project['item_count'] }}</td>
                            <td>{{ date('m/d/Y h:i A', strtotime($project['created_at'])) }}</td>
                            <td>
                                <nav class="nav no-gutters">
                                    <a class="nav-link hover-primary" href="{{ url("projects/" . $project['id']) }}" data-provide="tooltip" title="" data-original-title="View">
                                        <i class="ti-eye"></i>
                                    </a>
                                    <a class="nav-link hover-primary" href="{{ url("projects/archive/" . $project['id'] . "/" . (auth()->user() ? auth()->user()->id : 0)) }}" data-provide="tooltip" title="" data-original-title="Archive">
                                        <i class="ti-archive"></i>
                                    </a>
                                    <a class="nav-link hover-danger" href="#" data-provide="tooltip" title="" data-original-title="Delete"
                                        onload="submitForm('#delete-project{{ $project['id'] }}-form')">
                                        <i class="ti-trash"></i>
                                        <form id="delete-project{{ $project['id'] }}-form" action="{{ url("projects/" . $project['id'] . "/" . (auth()->user() ? auth()->user()->id : 0)) }}" method="post">
                                            {{ csrf_field() }}
                                            {{ method_field('delete') }}
                                        </form>
                                    </a>
                                </nav>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>


    <div class="fab fab-fixed">
        <a class="btn btn-float btn-primary" href="#create-project-modal" title="Create New Project"
           data-provide="tooltip" data-toggle="modal">
            <i class="ti-plus"></i>
        </a>
    </div>

    <!-- Modal - Create Project -->
    <div id="create-project-modal" class="modal modal-center fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white"> Create New Project</h5>
                    <button type="button" class="close text-white" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="create-project-form" action="" method="post">
                        {{ csrf_field() }}
                        {{ method_field('post') }}

                        <input type="hidden" name="organization_id" value="1">
                        <input type="hidden" name="created_by" value="1">

                        <div class="form-group">
                            <label>Name</label>
                            <input class="form-control" type="text" name="name">
                        </div>

                        <div class="form-group">
                            <label>Note</label>
                            <textarea class="form-control" type="text" name="note"></textarea>
                        </div>

                        <div class="form-group">
                            <label>Goal</label>
                            <input class="form-control" type="text" name="goal">
                        </div>

                        <div class="form-group">
                            <label>Leader</label>
                            <input class="form-control" type="text" name="leader">
                        </div>

                        <div class="form-group">
                            <label>Lean Sensie</label>
                            <input class="form-control" type="text" name="lean_sensie">
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Start Date</label>
                                    <input class="form-control" type="text" name="start_date" data-provide="datepicker">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>End Date</label>
                                    <input class="form-control" type="text" name="end_date" data-provide="datepicker">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-bold btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-bold btn-primary" onclick="submitForm('#create-project-form')">Create</button>
                </div>
            </div>
        </div>
    </div>
    <!-- END Modal - Add Project -->
@endsection