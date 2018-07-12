@extends('layouts.app')
@section('content')

    <main>
        <div class="main-content">
            <div class="card">
                <h4 class="card-title"><strong>All Organizations</strong></h4>
                <div class="card-body">
                    <table class="table table-striped table-bordered" cellspacing="0" data-provide="datatables">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Contact Person</th>
                            <th>Total Users</th>
                            <th>Subscription</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($organizations as $organization)
                        <tr>
                            <td>{{ $organization->name }}</td>
                            <td>{{ $organization->contact_person }}</td>
                            <td>0</td>
                            <td>Trial</td>
                            <td>
                                <nav class="nav no-gutters">
                                    <a class="nav-link hover-primary" href="{{ url("organizations/". $organization->id ."/users") }}"
                                       data-provide="tooltip" title="" data-original-title="View">
                                        <i class="ti-eye"></i>
                                    </a>
                                    <a class="nav-link hover-danger" href="#"
                                       data-provide="tooltip" title="" data-original-title="Delete"
                                        onclick="submitForm('#delete-organization-form')">
                                        <i class="ti-trash"></i>
                                    </a>
                                    <form id="delete-organization-form" action="{{ url("organizations/". $organization->id ."/12") }}" method="post">
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

    <div class="fab fab-fixed">
        <a class="btn btn-float btn-primary" href="#create-organization" title="Create New Organization"
           data-provide="tooltip" data-toggle="modal">
            <i class="ti-plus"></i>
        </a>
    </div>

    <!-- Modal - Create new organization -->
    <div id="create-organization" class="modal modal-center fade" tabindex="-1">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <form action="" method="post">
                    {{ csrf_field() }}
                    {{ method_field('post') }}
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title text-white"> Create New Organization</h5>
                        <button type="button" class="close text-white" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="text-fader">Name</label>
                            <input class="form-control" type="text" name="name">
                        </div>
                        <div class="form-group">
                            <label class="text-fader">Email</label>
                            <input class="form-control" type="email" name="email">
                        </div>

                        <div class="form-group">
                            <label class="text-fader">Phone</label>
                            <input class="form-control" type="text" name="phone">
                        </div>
                        <div class="form-group">
                            <label class="text-fader">Contact Person</label>
                            <input class="form-control" type="text" name="contact_person">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-bold btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-bold btn-primary" >Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- END Modal - Add new department -->

@endsection