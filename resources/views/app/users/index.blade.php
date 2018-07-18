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
                        <th>Department(s)</th>
                        <th>Roles(s)</th>
                        <th>Joined On</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($users as $user)
                        <tr>
                            <td class="">
                                <img class="avatar avatar-sm" src="{{ $user->avatar }}" alt="">
                                {{ $user->full_name }}
                            </td>
                            <td>{{ $user->departments->count() ? implode(', ',$user->departments->pluck('name')->toArray()) : 'N/A' }}</td>
                            <td>{{ "N/A" }}</td>
                            <td>{{ date('m/d/Y h:i A', strtotime($user->created_at)) }}</td>
                            <td>
                                <nav class="nav no-gutters">
                                    <a class="nav-link hover-primary" href="#edit-user{{ $user->id }}-modal"
                                       data-toggle="modal" data-provide="tooltip"
                                       title="" data-original-title="Edit">
                                        <i class="ti-pencil"></i>
                                    </a>
                                    @if(session()->get('user')->id != $user->id)
                                    <a class="nav-link hover-danger" href="#"
                                       data-provide="tooltip" title="" data-original-title="Delete"
                                       onclick="submitForm('#delete-user{{ $user->id }}-form')">
                                        <i class="ti-trash"></i>
                                    </a>
                                    @endif

                                    <!-- Modal - Edit user -->
                                    <div id="edit-user{{ $user->id }}-modal" class="modal modal-center fade" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="{{ url('users/' . $user->id) }}" method="post">
                                                    {{ csrf_field() }}
                                                    {{ method_field('put') }}
                                                    <div class="modal-header bg-primary">
                                                        <h5 class="modal-title text-white"> Edit User</h5>
                                                        <button type="button" class="close text-white" data-dismiss="modal">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="form-group col-md-6">
                                                                <label>First Name</label>
                                                                <input class="form-control" type="text" name="first_name" value="{{ $user->first_name }}">
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label>Last Name</label>
                                                                <input class="form-control" type="text" name="last_name" value="{{ $user->last_name }}">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Phone</label>
                                                            <input class="form-control" type="text" name="phone" value="{{ $user->phone }}">
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-md-6">
                                                                <label>Password</label>
                                                                <input class="form-control" type="password" name="password">
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label>Confirm Password</label>
                                                                <input class="form-control" type="password" name="password_confirmation">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Confirm Password</label>
                                                            <input class="form-control" type="password" name="password_confirmation">
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-md-6">
                                                                <label>Departments</label>
                                                                <select name="departments[]" id="" data-provide="selectpicker" multiple>
                                                                    @if($departments->count())
                                                                        @foreach($departments as $department)
                                                                            <option value="{{ $department->id }}" {{ in_array($department->name, $user->departments->toArray()) ? 'selected' : '' }} >
                                                                                {{ $department->name }}
                                                                            </option>
                                                                        @endforeach
                                                                    @else
                                                                        <option value="">None</option>
                                                                    @endif

                                                                </select>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label>Roles</label>
                                                                <select name="roles[]" id="" data-provide="selectpicker" multiple>
                                                                    @foreach($roles as $role)
                                                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        {{--<button type="button" class="btn btn-bold btn-secondary" data-dismiss="modal">Cancel</button>--}}
                                                        <button type="submit" class="btn btn-bold btn-block btn-primary" >Update</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END Modal - Edit user -->

                                    <form id="delete-user{{ $user->id }}-form" action="{{ url("users/". $user->id ) }}" method="post">
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
    <a class="btn btn-float btn-primary" href="#add-user-modal" title="Add User"
       data-provide="tooltip" data-toggle="modal">
        <i class="ti-plus"></i>
    </a>
</div>

<!-- Modal - Add user -->
<div id="add-user-modal" class="modal modal-center fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ url('users') }}" method="post">
                {{ csrf_field() }}
                {{ method_field('post') }}
                <input type="hidden" name="organization" value="{{ session('organization')->id }}">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white"> Add User</h5>
                    <button type="button" class="close text-white" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>First Name</label>
                            <input class="form-control" type="text" name="first_name" value="{{ old('first_name') }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Last Name</label>
                            <input class="form-control" type="text" name="last_name" value="{{ old('last_name') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Phone</label>
                        <input class="form-control" type="text" name="phone" value="{{ old('phone') }}">
                    </div>
                    <div class="form-group">
                        <label>Email address</label>
                        <input class="form-control" type="text" name="email" value="{{ old('email') }}">
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Password</label>
                            <input class="form-control" type="password" name="password">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Confirm Password</label>
                            <input class="form-control" type="password" name="password_confirmation">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Departments</label>
                            <select name="departments[]" id="" data-provide="selectpicker" multiple>
                                @foreach($departments as $department)
                                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Roles</label>
                            <select name="roles[]" id="" data-provide="selectpicker" multiple>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    {{--<button type="button" class="btn btn-bold btn-secondary" data-dismiss="modal">Cancel</button>--}}
                    <button type="submit" class="btn btn-bold btn-block btn-primary" >Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- END Modal - Add user -->

@endsection

