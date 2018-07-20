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
                            <td><a href="{{ url("users?organization=". $organization->id) }}">{{ $organization->name }}</a></td>
                            <td>{{ $organization->contact_person }}</td>
                            <td>{{ $organization->users_count }}</td>
                            <td>N/A</td>
                            <td>
                                <nav class="nav no-gutters">
                                    <a href="{{url('organizations').'/'.$organization->id.'/view'}}" class="nav-link hover-primary"
                                       data-provide="tooltip" title="" data-original-title="View" >
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
                        <!-- Modal - Create new organization -->
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    {{--<div class="fab fab-fixed">--}}
        {{--<a class="btn btn-float btn-primary" href="#create-organization" title="Create New Organization"--}}
           {{--data-provide="tooltip" data-toggle="modal">--}}
            {{--<i class="ti-plus"></i>--}}
        {{--</a>--}}
    {{--</div>--}}


    <!-- END Modal - Add new department -->

@endsection