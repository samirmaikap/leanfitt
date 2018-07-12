@extends('layouts.app')
@section('content')

<!-- Main container -->
<main>
    <div class="main-content">

        <div id="errors" class="callout callout-danger b-1" role="alert"
             style="{{ $errors->any() ? 'display:block' : 'display:none' }}">
            <button type="button" class="close" data-dismiss="callout" aria-label="Close">
                <span>×</span>
            </button>
            <h5>Oh snap!</h5>
            @foreach($errors->all() as $error)
                <p>
                    {{ $error }}
                </p>
            @endforeach
        </div>

        <div class="card">
            <h4 class="card-title"><strong>All Users</strong></h4>
            <div class="card-body">
                <table class="table table-striped table-bordered" cellspacing="0" data-provide="datatables">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Users(s)</th>
                        <th>Create At</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($departments as $department)
                        <tr>
                            <td>{{ $department->name }}</td>
                            <td>{{ $department->users_count  }}</td>
                            <td>{{ date('m/d/Y h:i A', strtotime($department->create_at)) }}</td>
                            <td>
                                <nav class="nav no-gutters">
                                    <a class="nav-link hover-primary" href="#edit-department{{ $department->id }}-modal"
                                       data-toggle="modal" data-provide="tooltip"
                                       title="" data-original-title="Edit">
                                        <i class="ti-pencil"></i>
                                    </a>
                                    <a class="nav-link hover-danger" href="#"
                                       data-provide="tooltip" title="" data-original-title="Delete"
                                       onclick="submitForm('#delete-department{{ $department->id }}-form')">
                                        <i class="ti-trash"></i>
                                    </a>

                                    <!-- Modal - Edit user -->
                                    <div id="edit-department{{ $department->id }}-modal" class="modal modal-center fade" tabindex="-1">
                                        <div class="modal-dialog modal-sm">
                                            <div class="modal-content">
                                                <form action="{{ url('departments/' . $department->id) }}" method="post">
                                                    {{ csrf_field() }}
                                                    {{ method_field('put') }}
                                                    <div class="modal-header bg-primary">
                                                        <h5 class="modal-title text-white"> Edit Department</h5>
                                                        <button type="button" class="close text-white" data-dismiss="modal">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label>Name</label>
                                                            <input class="form-control" type="text" name="name" value="{{ $department->name }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Description</label>
                                                            <textarea name="description" rows="5" class="form-control">{{ $department->description }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        {{--<button type="button" class="btn btn-bold btn-secondary" data-dismiss="modal">Cancel</button>--}}
                                                        <button type="submit" class="btn btn-bold btn-block btn-primary" >Edit</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END Modal - Edit user -->

                                    <form id="delete-department{{ $department->id }}-form" action="{{ url("departments/". $department->id ) }}" method="post">
                                        {{ csrf_field() }}
                                        {{ method_field('delete') }}
                                    </form>
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
<!-- END Main container -->

<div class="fab fab-fixed">
    <a class="btn btn-float btn-primary" href="#add-department-modal" title="Create Department"
       data-provide="tooltip" data-toggle="modal">
        <i class="ti-plus"></i>
    </a>
</div>

<!-- Modal - Add user -->
<div id="add-department-modal" class="modal modal-center fade" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form action="{{ url('departments') }}" method="post">
                {{ csrf_field() }}
                {{ method_field('post') }}
                <input type="hidden" name="organization_id" value="{{ session('organization')->id }}">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white"> Create Department</h5>
                    <button type="button" class="close text-white" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Name</label>
                        <input class="form-control" type="text" name="name" value="{{ old('name') }}">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" rows="5" class="form-control">{{ old('description') }}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    {{--<button type="button" class="btn btn-bold btn-secondary" data-dismiss="modal">Cancel</button>--}}
                    <button type="submit" class="btn btn-bold btn-block btn-primary" >Create</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- END Modal - Add user -->

@endsection

