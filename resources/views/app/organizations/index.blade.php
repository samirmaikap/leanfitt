@extends('layouts.app')
@section('content')

    <main>
        <header class="header no-border">
            <div class="header-bar">
                <h4>Organizations</h4>
                <button class="btn btn-round btn-success" data-toggle="modal" data-target="#modal-organization">Create</button>
            </div>
        </header>
        <div class="main-content">
            <div class="card">
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
                            <td><a href="{{ url("users?organization=". $organization->id) }}">{{ $organization->name }}</a></td>
                            <td>{{ $organization->contact_person }}</td>
                            <td>{{ $organization->users_count }}</td>
                            <td>
                                @if(isset($organization))
                                    @if(!empty($organization->trial_ends_at) && strtotime($organization->trial_ends_at)>strtotime(date('Y-m-d')))
                                        <span class="text-warning">On Trial</span>
                                    @else
                                        @if($organization->subscriptions[0]->ends_at && strtotime($organization->subscriptions[0]->ends_at) < strtotime(date('Y-m-d')))
                                            <span class="text-danger">Stopped</span>
                                        @else
                                            <span class="text-success">Active</span>
                                        @endif
                                    @endif
                                @endif
                            </td>
                            <td>
                                <nav class="nav no-gutters">
                                    <a href="{{url('organizations').'/'.$organization->id.'/view'}}" class="nav-link hover-primary"
                                       data-provide="tooltip" title="" data-original-title="View" >
                                        <i class="ti-eye"></i>
                                    </a>
                                    <a class="nav-link hover-danger delete-organization" href="#"
                                       data-provide="tooltip" title="" data-original-title="Delete">
                                        <i class="ti-trash"></i>
                                    </a>
                                    <form id="delete-organization-form" action="{{ url("organizations/". $organization->id) }}" method="post">
                                        {{ csrf_field() }}
                                        {{ method_field('delete') }}
                                    </form>
                                </nav>
                            </td>
                        </tr>
                        <!-- Modal - Create new organization -->
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <div class="modal modal-top fade" id="modal-organization" tabindex="-1">
        <div class="modal-dialog mt-30 ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create Organization</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="register-form" action="{{url('organizations/create/custom')}}" method="post" data-provide="wizard">

                        {{ csrf_field() }}
                        {{ method_field('post') }}

                        <ul class="nav nav-process nav-process-circle">
                            <li class="nav-item">
                                <span class="nav-title">Admin</span>
                                <a class="nav-link" data-toggle="tab" href="#wizard-form-1"></a>
                            </li>
                            <li class="nav-item">
                                <span class="nav-title">Organization</span>
                                <a class="nav-link" data-toggle="tab" href="#wizard-form-2"></a>
                            </li>
                            <li class="nav-item">
                                <span class="nav-title">Subscription</span>
                                <a class="nav-link" data-toggle="tab" href="#wizard-form-3"></a>
                            </li>
                        </ul>

                        <div class="tab-content">

                            <div class="tab-pane fade" id="wizard-form-1">

                                <p class="text-center text-gray">
                                    Create an admin
                                </p>
                                <hr class="w-100px">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>First Name</label>
                                            <input class="form-control" type="text" name="admin[first_name]" value="{{ old('admin.first_name') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Last Name</label>
                                            <input class="form-control" type="text" name="admin[last_name]" value="{{ old('admin.last_name') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Email</label>
                                    <input class="form-control" type="text" name="admin[email]" value="{{ old('admin.email') }}">
                                </div>
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input class="form-control" type="text" name="admin[phone]" value="{{ old('admin.phone') }}">
                                </div>

                            </div>

                            <div class="tab-pane fade" id="wizard-form-2">

                                <p class="text-center text-gray">
                                    Create an organization
                                </p>
                                <hr class="w-100px">

                                <div class="form-group">
                                    <label>Organization Name</label>
                                    <input class="form-control" type="text" name="organization[name]" value="{{ old('organization.name') }}">
                                </div>
                                <div class="form-group">
                                    <label>Contact Email</label>
                                    <input class="form-control" type="text" name="organization[email]" value="{{ old('organization.email') }}">
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Contact Person</label>
                                            <input class="form-control" type="text" name="organization[contact_person]" value="{{ old('organization.contact_person') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Phone</label>
                                            <input class="form-control" type="text" name="organization[phone]" value="{{ old('organization.contact_person') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="wizard-form-3">

                                <p class="text-center text-gray">Enter number of days for trial</p>
                                <hr class="w-100px">

                                <div class="form-group">
                                    <label>Trial Days</label>
                                    <input class="form-control" type="text" name="subscription[trial]" value="{{ old('subscription.trial') }}">
                                </div>
                            </div>

                        </div>

                        <hr>

                        <div class="flexbox">
                            <button class="btn btn-bold btn-outline btn-secondary" data-wizard="prev" type="button">Back</button>
                            <button class="btn btn-bold btn-outline btn-secondary" data-wizard="next" type="button">Next</button>
                            <button class="btn btn-bold btn-primary d-none" data-wizard="finish" type="submit">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script data-provide="sweetalert">
        window.onload=function(){

            $('.main-content').on('click','.delete-organization',function(e){
                e.preventDefault();
                swal({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then(function() {
                    $('#delete-organization-form').submit();
                })
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


    <!-- END Modal - Add new department -->

@endsection