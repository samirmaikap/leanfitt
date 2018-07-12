@extends('layouts.app')
@section('content')

<!-- Main container -->
<main>

    <!-- Page aside -->
    <aside class="aside aside-expand-md">
        <div class="aside-body">
            <!-- <div class="aside-block"> -->
            <!-- <button type="button" class="btn btn-block btn-info" data-toggle="modal" data-target="#modal-center">+ New Department</button> -->
            <!-- </div> -->

            <!-- <hr> -->

            <div class="aside-block">
                <div class="flexbox mb-1">
                    <h6 class="aside-title">
                        <i class="ti-window"></i>
                        &nbsp;
                        Departments
                    </h6>
                    </a>
                </div>

                <ul class="nav nav-pills flex-column">
                    <li class="nav-item active">
                        <a class="nav-link" href="">All Users (100)</a>
                        <hr>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="{{ url("organizations/12/users?department=") }}">Finance (53)</a>
                    </li>
                </ul>
            </div>

            <hr>

            {{--<div class="aside-block">--}}
                {{--<div class="flexbox align-items-center mb-1">--}}
                    {{--<h6 class="aside-title fs-13">Roles</h6>--}}
                    {{--<a class="float-right text-lighter hover-success" href="#" data-provide="tooltip"--}}
                       {{--data-title="Create New Label" data-toggle="modal" data-target="#modal-add-label"><i--}}
                                {{--class="ti-plus"></i></a>--}}
                {{--</div>--}}

                {{--<ul class="nav flex-column">--}}
                    {{--<li class="nav-item">--}}
                        {{--<a class="nav-link active" href="#">--}}
                            {{--<span class="badge badge-ring fill badge-danger"></span>--}}
                            {{--<span>Family</span>--}}
                        {{--</a>--}}
                        {{--<a class="nav-action hover-info" href="#" data-provide="tooltip" data-title="Edit"><span--}}
                                    {{--class="ti-pencil"></span></a>--}}
                        {{--<a class="nav-action hover-danger delete-label" href="#" data-provide="tooltip"--}}
                           {{--data-title="Remove"><span class="ti-close"></span></a>--}}
                    {{--</li>--}}

                    {{--<li class="nav-item">--}}
                        {{--<a class="nav-link" href="#">--}}
                            {{--<span class="badge badge-ring badge-warning"></span>--}}
                            {{--<span>Fiends</span>--}}
                        {{--</a>--}}
                        {{--<a class="nav-action hover-info" href="#" data-provide="tooltip" data-title="Edit"><span--}}
                                    {{--class="ti-pencil"></span></a>--}}
                        {{--<a class="nav-action hover-danger delete-label" href="#" data-provide="tooltip"--}}
                           {{--data-title="Remove"><span class="ti-close"></span></a>--}}
                    {{--</li>--}}

                    {{--<li class="nav-item">--}}
                        {{--<a class="nav-link" href="#">--}}
                            {{--<span class="badge badge-ring badge-info"></span>--}}
                            {{--<span>Work</span>--}}
                        {{--</a>--}}
                        {{--<a class="nav-action hover-info" href="#" data-provide="tooltip" data-title="Edit"><span--}}
                                    {{--class="ti-pencil"></span></a>--}}
                        {{--<a class="nav-action hover-danger delete-label" href="#" data-provide="tooltip"--}}
                           {{--data-title="Remove"><span class="ti-close"></span></a>--}}
                    {{--</li>--}}

                    {{--<li class="nav-item">--}}
                        {{--<a class="nav-link" href="#">--}}
                            {{--<span class="badge badge-ring badge-purple"></span>--}}
                            {{--<span>Bills</span>--}}
                        {{--</a>--}}
                        {{--<a class="nav-action hover-info" href="#" data-provide="tooltip" data-title="Edit"><span--}}
                                    {{--class="ti-pencil"></span></a>--}}
                        {{--<a class="nav-action hover-danger delete-label" href="#" data-provide="tooltip"--}}
                           {{--data-title="Remove"><span class="ti-close"></span></a>--}}
                    {{--</li>--}}
                {{--</ul>--}}
            {{--</div>--}}
        </div>

        <button class="aside-toggler"></button>
    </aside>
    <!-- END Page aside -->


    <div class="main-content">
        <div class="card">
            <div class="media-list media-list-hover media-list-divided">
                <div class="media-list-header bg-transparent">
                    {{--<div class="d-none d-md-block pull-right">--}}
                        {{--<div class="lookup lookup-circle lookup-right">--}}
                            {{--<input type="text" data-provide="media-search">--}}
                        {{--</div>--}}
                    {{--</div>--}}
                </div>
                <div class="media-body">
                    <div class="media media-single">
                        <a href="#">
                            <img class="avatar" src="../assets/img/avatar/2.jpg" alt="...">
                        </a>

                        <div class="media-body">
                            <h6><a href="#">Hossein Shams</a></h6>
                            <small class="text-fader">Co-Founder</small>
                        </div>

                        <div class="media-right">
                            <a class="btn btn-sm btn-bold btn-round btn-outline btn-secondary w-100px" href="#">Intived</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/.main-content -->
</main>
<!-- END Main container -->


<div class="fab fab-fixed">
    <a class="btn btn-float btn-primary" href="#add-user" title="Add User"
       data-provide="tooltip" data-toggle="modal">
        <i class="ti-plus"></i>
    </a>
</div>

<!-- Modal - Add user -->
<div id="add-user" class="modal modal-center fade" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form action="" method="post">
                {{ csrf_field() }}
                {{ method_field('post') }}
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white"> Add User</h5>
                    <button type="button" class="close text-white" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="text-fader">First name</label>
                            <input class="form-control" type="text">
                        </div>

                        <div class="form-group col-md-6">
                            <label class="text-fader">Last name</label>
                            <input class="form-control" type="text">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="text-fader">Email</label>
                        <input class="form-control" type="text">
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="text-fader">Department</label>
                            <div class="btn-group bootstrap-select form-control">
                                <select class="form-control" title="&nbsp;" data-provide="selectpicker" tabindex="-98">
                                    <option class="bs-title-option" value="">&nbsp;</option>
                                    <option>United States</option>
                                    <option>Canada</option>
                                    <option>Mexico</option>
                                    <option>United Kingdom</option>
                                </select></div>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="text-fader">Phone</label>
                            <input class="form-control" type="text">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-bold btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-bold btn-primary" >Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- END Modal - Add user -->


<script>
//    app.ready(function () {
    window.onload = function () {
        // Delete label
        $('.delete-label').on('click', function () {
            $(this).closest('.nav-item').fadeOut(700, function () {
                app.toast('Label removed successfully.', {
                    actionTitle: 'Undo'
                })
            });
        });
    };
//    });
</script>

@endsection

