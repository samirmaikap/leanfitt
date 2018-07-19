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
            <h4 class="card-title"><strong>All Roles</strong></h4>
            <div class="card-body">
                <table class="table table-striped table-bordered" cellspacing="0" data-provide="datatables">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Users(s)</th>
                        <th>Permission</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($roles as $role)
                        {{--{{ dd($role) }}--}}
                        <tr>
                            <td>{{ $role->name }}</td>
                            <td>{{ $role->users_count  }}</td>
                            <td> {{ $role->permissions->count() }}</td>
                            <td>{{ date('m/d/Y h:i A', strtotime($role->create_at)) }}</td>
                            <td>
                                <nav class="nav no-gutters">
                                    <a class="nav-link hover-primary" href="#edit-role{{ $role->id }}-modal"
                                       data-toggle="modal" data-provide="tooltip"
                                       title="" data-original-title="Edit">
                                        <i class="ti-pencil"></i>
                                    </a>
                                    <a class="nav-link hover-danger" href="#"
                                       data-provide="tooltip" title="" data-original-title="Delete"
                                       onclick="submitForm('#delete-role{{ $role->id }}-form')">
                                        <i class="ti-trash"></i>
                                    </a>

                                    <!-- Modal - Edit user -->
                                    <div id="edit-role{{ $role->id }}-modal" class="modal modal-center fade" tabindex="-1">
                                        <div class="modal-dialog modal-sm">
                                            <div class="modal-content">
                                                <form action="{{ url('roles/' . $role->id) }}" method="post">
                                                    {{ csrf_field() }}
                                                    {{ method_field('put') }}
                                                    <div class="modal-header bg-primary">
                                                        <h5 class="modal-title text-white"> Edit Role</h5>
                                                        <button type="button" class="close text-white" data-dismiss="modal">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label>Name</label>
                                                            <input class="form-control" type="text" name="name" value="{{ $role->name }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Description</label>
                                                            <textarea name="description" rows="2" class="form-control">{{ $role->description }}</textarea>
                                                        </div>
                                                        <div class="h-200px" style="overflow-x: hidden; overflow-y: scroll">
                                                            @foreach (config('permission.models') as $model)
                                                                <div class="form-group">
                                                                    <p>{{ ucfirst($model) }}</p>
                                                                    <div class="row">
                                                                        <div class="col">
                                                                            @foreach (config('permission.actions') as $action)
                                                                                <label class="custom-control custom-control-primary custom-checkbox">
                                                                                    <input type="checkbox" class="custom-control-input" name="permissions[]" value="{{ $action . '.' . $model }}" @if($role->hasPermission($action . '.' . $model))  {{ 'checked' }} @endif>
                                                                                    <span class="custom-control-indicator"></span>
                                                                                    <span class="custom-control-description">{{ ucfirst($action) }}</span>
                                                                                </label>
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
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

                                    <form id="delete-role{{ $role->id }}-form" action="{{ url("roles/". $role->id ) }}" method="post">
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
    <a class="btn btn-float btn-primary" href="#add-role-modal" title="Create Role"
       data-provide="tooltip" data-toggle="modal">
        <i class="ti-plus"></i>
    </a>
</div>

<!-- Modal - Add user -->
<div id="add-role-modal" class="modal modal-center fade" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form action="{{ url('roles') }}" method="post">
                {{ csrf_field() }}
                {{ method_field('post') }}

                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white"> Create Role</h5>
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
                        <textarea name="description" rows="2" class="form-control">{{ old('description') }}</textarea>
                    </div>

                    <div class="form-group">
                        <label>Permissions</label>
                    </div>

                    <div class="h-200px" style="overflow-x: hidden; overflow-y: scroll">
                        @foreach (config('permission.models') as $model)
                            <div class="form-group">
                                <p>{{ ucfirst($model) }}</p>
                                <div class="row">
                                    <div class="col">
                                        @foreach (config('permission.actions') as $action)
                                            <label class="custom-control custom-control-primary custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="permissions[]" value="{{ $action . '.' . $model }}">
                                                <span class="custom-control-indicator"></span>
                                                <span class="custom-control-description">{{ ucfirst($action) }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach
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

