@extends('layouts.app')
@section('content')
    <main class="main-container">
        <!-- Page aside -->
        <aside class="aside aside-expand-md">
            <div class="aside-body">
                <div class="aside-block mt-20">
                    <div class="flexbox mb-1">
                        <h6 class="aside-title">Organizations ({{count($orglist)}})</h6>
                    </div>

                    <ul class="nav nav-pills flex-column">
                        @if(count($orglist) > 0)
                            @foreach($orglist as $olist)
                                <li class="nav-item {{$activeorg == $olist['id'] ? 'active' : ''}}">
                                    <a class="nav-link" href="{{url('/users?organization=').$olist['id']}}">{{$olist['name']}}</a>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
                <hr>
                <div class="aside-block deplist-container {{strtolower(session('role'))=='admin' ? 'mt-20' : ''}}">
                    <div class="flexbox mb-1">
                        <h6 class="aside-title">Departments ({{count($deplist)}})</h6>
                    </div>

                    <ul class="nav nav-pills flex-column">
                        @if(count($deplist) > 0)
                            @foreach($deplist as $dlist)
                                <li data-id="{{$dlist['id']}}" class="nav-item {{($activedep == $dlist['id']) ? 'active' : '' }}">
                                    <a class="nav-link" href="{{url('/users?organization=').$activeorg}}&department={{$dlist['id']}}">{{$dlist['name']}}</a>
                                    <a class="nav-action hover-info edit-department" href="#" data-provide="tooltip" data-title="Edit" data-toggle="modal" data-target="#modal-department"><span class="ti-pencil"></span></a>
                                    <a class="nav-action hover-danger delete-department" href="#" data-provide="tooltip" data-title="Remove"><span class="ti-close"></span></a>
                                </li>

                            @endforeach
                        @else
                            <li class="nav-item">
                                <span class="nav-link text-danger">No department found</span>
                            </li>
                        @endif
                            <li><a class="btn mt-20 mb-20 btn-block btn-info new-department" href="#" data-toggle="modal" data-target="#modal-department">Add New</a></li>
                    </ul>
                </div>
            </div>

            <button class="aside-toggler"></button>
        </aside>
        <!-- END Page aside -->
        <header class="header no-border">
            <div class="header-bar">
                <h4>Users</h4>
                <button class="btn btn-round btn-success" data-toggle="modal" data-target="#modal-invite">Invite</button>
            </div>
        </header>

        <div class="main-content">
            <div class="row user-container">

                @if(count($users) > 0)
                    @foreach($users as $user)
                        <div class="col-md-6 col-lg-3">
                            <a href="{{url('users').'/'.$user->id.'/profile'}}" class="card" data-id="{{$user->id}}">
                                <div class="card-body text-center" style="height: 270px">
                                    <div>
                                        <img class="avatar avatar-xxl" src="{{$user->avatar}}">
                                    </div>
                                    <h5 class="mt-3 mb-1">{{$user->full_name}}</h5>
                                    <span class="text-fade d-block ">{{$user->email}}</span>
                                    <span class="text-fade d-block ">{{$user->phone}}</span>
                                    <span class="text-success d-block ">{{ $user->departments->count() ? implode(', ',$user->departments->pluck('name')->toArray()) : 'No Department' }}</span>
                                    <time>{{$user->is_invited==0 ? 'Joined' : 'Invited'}} {{\Illuminate\Support\Carbon::parse($user->created_at)->format('d F Y')}}</time>
                                </div>

                                <div class=" border-light py-12  text-center">
                                    @if($user->is_invited==1)
                                        <form method="get" action="{{url('users').'/'.$user->id.'/invitation/resend'}}">
                                            <button type="submit" class="mt-10 mb-10 btn btn-w-md btn-round btn-primary reinvite-user">Re Invite</button>
                                        </form>

                                    @else
                                        @if($user->is_suspended==0)
                                            <button class="mt-10 mb-10 btn btn-w-md btn-round btn-danger suspend-user">Suspend</button>
                                        @else
                                            <button class="mt-10 mb-10 btn btn-w-md btn-round btn-success restore-user">Restore</button>
                                        @endif
                                    @endif

                                </div>
                            </a>
                        </div>
                    @endforeach
                @endif
            </div>



            {{--Invitation Modal--}}
            <div class="modal modal-center fade" id="modal-invite" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">User Invitation</h5>
                            <button type="button" class="close" data-dismiss="modal">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="post" action="{{url('users/invitation')}}" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="modal-body form-type-material">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="first_name">
                                    <label>First Name</label>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="last_name">
                                    <label>Last Name</label>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="email">
                                    <label>Email</label>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="phone">
                                    <label>Phone</label>
                                </div>
                                <div class="form-group">
                                    <select class="form-control" name="department_id">
                                        @if(count($deplist) > 0)
                                            @foreach($deplist as $dlist)
                                                <option value="{{$dlist['id']}}">{{$dlist['name']}}</option>
                                            @endforeach
                                        @else
                                            <option value="">None</option>
                                        @endif
                                    </select>
                                    <label class="label-floated">Department</label>
                                </div>
                                <input type="hidden" name="organization_id" value="{{isset($activeorg) ? $activeorg : null}}">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-bold btn-pure btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-bold btn-pure btn-primary">Invite</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

            {{--Department Modal--}}
            <div class="modal modal-center fade" id="modal-department" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">User Invitation</h5>
                            <button type="button" class="close" data-dismiss="modal">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="departmentForm" method="post" action="{{url('department')}}" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="modal-body form-type-material">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="name">
                                    <label>Department Name</label>
                                </div>
                                <input type="hidden" name="organization_id" value="{{isset($activeorg) ? $activeorg : null}}">
                                <input type="hidden" id="department-id" name="department_id">
                                <input type="hidden"  name="created_by" value="{{session()->get('id')}}">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-bold btn-pure btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-bold btn-pure btn-primary">Save</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

            {{--Organization Modal--}}
            <div class="modal modal-center fade" id="modal-organization" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"></h5>
                            <button type="button" class="close" data-dismiss="modal">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="post" action="{{url('organizations')}}" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="modal-body form-type-material">
                                <div class="form-group text-center">
                                    <div>
                                        <img id="organization-logo" class="avatar avatar-xxl" src="../assets/img/avatar/1.jpg">
                                    </div>
                                    <div class="file-group file-group-inline">
                                        <button class="btn btn-square btn-pure btn-success file-browser" type="button"><i class="fa fa-upload lead"></i></button>
                                        <input type="file" name="image" onchange="loadFile(event)" accept="*.png,*.jpeg,*.jpg">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="name" value="{{isset($organization['name']) ? $organization['name'] : ''}}">
                                    <label>Name</label>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="email" value="{{isset($organization['email']) ? $organization['email'] : ''}}">
                                    <label>Email</label>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="phone" value="{{isset($organization['phone']) ? $organization['phone'] : ''}}">
                                    <label>Phone</label>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="contact_person" value="{{isset($organization['contact_person']) ? $organization['contact_person'] : ''}}">
                                    <label>Contact Person</label>
                                </div>
                                <input type="hidden" name="organization_id" value="{{isset($activeorg) ? $activeorg : null}}">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-bold btn-pure btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-bold btn-pure btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{--Action Form--}}
            <div class="hidden" style="display: none">
                <form id="empActionForm" method="post" action="{{url('users/action')}}">
                    {{csrf_field()}}
                    <input type="hidden" id="emp-action-type" name="type">
                    <input type="hidden" id="emp-id" name="user_id">
                    <input type="submit" id="submitEmpAction" value="true">
                </form>
                <form id="depActionForm"  method="post" action="{{url('department/action')}}">
                    {{csrf_field()}}
                    <input type="hidden" id="dep-action-type" name="type">
                    <input type="hidden" id="dep-id" name="department_id">
                    <input type="submit" id="submitDepAction" value="true">
                </form>
                <form id="orgActionForm" method="post" action="{{url('organizations/action')}}">
                    {{csrf_field()}}
                    <input type="hidden" id="org-action-type" name="type">
                    <input type="hidden" id="org-id" name="organization_id">
                    <input type="submit" id="submitOrgAction" value="true">
                </form>
            </div>

            <script data-provide="sweetalert">
                window.onload=function(){
                    $('.deplist-container').on('click','.edit-department',function(){
                         var id=$(this).parent().data('id');
                         var name=$(this).parent().find('.nav-link').text();
                         $('#modal-department').find('.modal-title').html('Edit Department');
                         $('#modal-department').find('input[name="name"]').val(name).trigger('click');
                         $('#modal-department').find('#department-id').val(id);
                    })
                    $('.deplist-container').on('click','.new-department',function(){
                        $('#departmentForm')[0].reset();
                    })
                    $('.deplist-container').on('click','.delete-department',function(){

                        var $this=$(this);
                        swal({
                            title: 'Are you sure?',
                            text: "You won't be able to revert this!",
                            type: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, delete it!'
                        }).then(function() {
                            var id=$this.parent().data('id');
                            var $form=$('#depActionForm');
                            $form.find('#dep-id').val(id);
                            $form.find('#dep-action-type').val('delete');
                            $('#submitDepAction').trigger('click');
                        })
                    })
                    $('.user-container').on('click','.suspend-user',function(e){
                        e.preventDefault();
                        e.stopImmediatePropagation();
                        var $this=$(this);
                        swal({
                            title: 'Are you sure?',
                            text: "You can revert this later!",
                            type: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes'
                        }).then(function() {
                            var id=$this.parent().parent().data('id');
                            var $form=$('#empActionForm');
                            $form.find('#emp-id').val(id);
                            $form.find('#emp-action-type').val('archive');
                            $('#submitEmpAction').trigger('click');
                        })
                    })
                    $('.user-container').on('click','.restore-user',function(e){
                        e.preventDefault();
                        e.stopImmediatePropagation();
                        var $this=$(this);
                        swal({
                            title: 'Are you sure?',
                            text: "You can revert this later!",
                            type: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes'
                        }).then(function() {
                            var id=$this.parent().parent().data('id');
                            var $form=$('#empActionForm');
                            $form.find('#emp-id').val(id);
                            $form.find('#emp-action-type').val('restore');
                            $('#submitEmpAction').trigger('click');
                        })
                    })
                    $('.main-container').on('click','.delete-organization',function(){

                        var $this=$(this);
                        swal({
                            title: 'Are you sure?',
                            text: "You won't be able to revert this!",
                            type: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, delete it!'
                        }).then(function() {
                            var id=$this.data('id');
                            var $form=$('#orgActionForm');
                            $form.find('#org-id').val(id);
                            $form.find('#org-action-type').val('delete');
                            $('#submitOrgAction').trigger('click');
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
                var loadFile = function(event) {
                    var output = document.getElementById('organization-logo');
                    output.src = URL.createObjectURL(event.target.files[0]);
                }
            </script>
        </div>
@endsection