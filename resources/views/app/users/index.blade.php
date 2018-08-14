@extends('layouts.app')
@section('content')
    <main class="main-container">
        <!-- Page aside -->
        <aside class="aside aside-expand-md">
            <div class="aside-body">
                @if(isSuperadmin())
                    <div class="aside-block mt-20">
                        <div class="flexbox mb-1">
                            <h6 class="aside-title">Organizations ({{count($orglist)}})</h6>
                        </div>

                        <ul class="nav nav-pills flex-column">
                            @if(count($orglist) > 0)
                                @foreach($orglist as $olist)
                                    <li class="nav-item {{$activeorg == $olist['id'] ? 'active' : ''}}">
                                        <a class="nav-link text-truncate w-160px" href="{{url('/users?organization=').$olist['id']}}" title="{{$olist['name']}}">{{$olist['name']}}</a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                    <hr>
                @endif
                <div class="aside-block deplist-container">
                    <div class="flexbox mb-1">
                        <h6 class="aside-title">Departments ({{count($deplist)}})</h6>
                    </div>

                    <ul class="nav nav-pills flex-column">
                        @if(count($deplist) > 0)
                            @foreach($deplist as $dlist)
                                <li data-id="{{$dlist->id}}" class="nav-item {{($activedep == $dlist->id) ? 'active' : '' }}">
                                    <a class="nav-link text-truncate w-100px" title="{{$dlist->name}}" href="{{url('/users?organization=').$activeorg}}&department={{$dlist->id}}">{{$dlist->name}}</a>
                                    @if(!isSuperadmin())
                                        @permission('update.department')
                                        <a class="nav-action hover-info edit-department" href="#" data-provide="tooltip" data-title="Edit" data-toggle="modal" data-target="#modal-department"><span class="ti-pencil"></span></a>
                                        @endpermission
                                        @permission('delete.department')
                                        <a class="nav-action hover-danger delete-department" href="#" data-provide="tooltip" data-title="Remove"><span class="ti-close"></span></a>
                                        @endpermission
                                    @endif
                                </li>
                                <form id="dep-delete-role{{ $dlist->id }}-form" action="{{ url("departments/". $dlist->id ) }}" method="post">
                                    {{ csrf_field() }}
                                    {{ method_field('delete') }}
                                </form>
                            @endforeach
                        @else
                            <li class="nav-item">
                                <span class="nav-link text-danger">No department found</span>
                            </li>
                        @endif
                        @if(!isSuperadmin())
                            @permission('create.department')
                            <li><a class="btn mt-20 mb-20 btn-round btn-outline text-success new-department" href="#" data-toggle="modal" data-target="#modal-department"><i class="fe fe-plus"></i></a></li>
                            @endpermission
                        @endif
                    </ul>
                </div>
                <hr>
                <div class="aside-block roles-container">
                    <div class="flexbox mb-1">
                        <h6 class="aside-title">Roles ({{count($rolelist)}})</h6>
                    </div>

                    <ul class="nav nav-pills flex-column">
                        @if(count($rolelist) > 0)
                            @foreach($rolelist as $rlist)
                                <li data-id="{{$rlist->id}}" class="nav-item {{($activerole == $rlist->id) ? 'active' : '' }}">
                                    <a class="nav-link text-truncate w-100px" href="{{url('/users?organization=').$activeorg}}&department={{$activedep}}&role={{$rlist->id}}" title="{{$rlist->name}}">{{$rlist->name}}</a>
                                    @if(!isSuperadmin())
                                        @permission('update.role')
                                        <a class="nav-action hover-info edit-department" href="#" data-provide="tooltip" data-title="Edit" data-toggle="modal" data-target="#edit-role{{ $rlist->id }}-modal"><span class="ti-pencil"></span></a>
                                        @endpermission
                                        @permission('delete.role')
                                        <a class="nav-action hover-danger delete-department" href="#" data-provide="tooltip" data-title="Remove" onclick="submitForm('#delete-role{{ $rlist->id }}-form')"><span class="ti-close"></span></a>
                                        @endpermission
                                    @endif
                                </li>


                                <form id="delete-role{{ $rlist->id }}-form" action="{{ url("roles/". $rlist->id ) }}" method="post">
                                    {{ csrf_field() }}
                                    {{ method_field('delete') }}
                                </form>

                            @endforeach
                        @else
                            <li class="nav-item">
                                <span class="nav-link text-danger">No roles found</span>
                            </li>
                        @endif
                        @if(!isSuperadmin())
                            @permission('create.role')
                            <li><a class="btn mt-20 mb-20 btn-round btn-outline text-success new-role" href="#" data-toggle="modal" data-target="#add-role-modal"><i class="fe fe-plus"></i></a></li>
                            @endpermission
                        @endif

                    </ul>
                </div>
            </div>

            <button class="aside-toggler"></button>
        </aside>
        <!-- END Page aside -->
        <header class="header no-border">
            <div class="header-bar">
                <h4>Users
                    @if(!isSuperadmin())
                        @if($activedep || $activerole)
                            <a href="{{url('users')}}" class="badge badge-danger badge-sm">Reset</a>
                        @endif
                    @endif
                </h4>
                @if(!isSuperadmin())
                    @permission('create.user')
                    <button class="btn btn-round btn-success" data-toggle="modal" data-target="#modal-invite">Invite</button>
                    @endpermission
                @endif
            </div>
        </header>

        <div class="main-content">
            <div class="row user-container">

                @if(count($users) > 0)
                    @foreach($users as $user)
                        {{dd($user)}}
                        <div class="col-md-6 col-lg-3">
                            <a href="{{url('users').'/'.$user->id.'/profile'}}{{isSuperadmin() ? '?organization='.$activeorg : ''}}" class="card" data-id="{{$user->id}}">
                                <div class="card-body text-center" style="height: 270px">
                                    <div>
                                        <img class="avatar avatar-xxl" src="{{empty($user->avatar) ? env('UI_AVATAR').$user->full_name : $user->avatar}}">
                                    </div>
                                    <h5 class="mt-3 mb-1 text-truncate">{{$user->full_name}}</h5>
                                    <span class="text-fade text-truncate d-block ">{{$user->email}}</span>
                                    <span class="text-fade d-block ">{{$user->phone}}</span>
                                    <span class="text-success d-block ">{{ $user->roles->count()}} Roles</span>
                                    <time>{{$user->is_invited==0 ? 'Joined' : 'Invited'}} {{\Illuminate\Support\Carbon::parse($user->created_at)->format('d F Y')}}</time>
                                </div>

                                @if(!isSuperadmin())
                                    @permission('update.user')
                                    <div class=" border-light py-12  text-center">
                                        @if($user->is_invited==1)
                                            <form method="get" action="{{url('users').'/'.$user->id.'/invitation/resend'}}">
                                                <button type="submit" class="mt-10 mb-10 btn btn-w-md btn-round btn-primary reinvite-user">Re Invite</button>
                                            </form>

                                        @else
                                            @if(session()->get('user')->id!=$user->id)
                                                @if($user->is_suspended==0)
                                                    <button class="mt-10 mb-10 btn btn-w-md btn-round btn-danger suspend-user">Suspend</button>
                                                @else
                                                    <button class="mt-10 mb-10 btn btn-w-md btn-round btn-success restore-user">Restore</button>
                                                @endif
                                            @else
                                                <button class="mt-10 mb-10 btn btn-w-md btn-round btn-default">Suspend</button>
                                            @endif
                                        @endif
                                    </div>
                                    @endpermission
                                @endif
                            </a>
                        </div>
                    @endforeach
            </div>
            @else
                <h3 class="p-20 text-danger">No users found</h3>
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
                                <select class="form-control" name="roles[]">
                                    @if(count($rolelist) > 0)
                                        @foreach($rolelist as $rlist)
                                            <option value="{{$rlist->id}}">{{$rlist->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <label class="label-floated">Role</label>
                            </div>
                            <input type="hidden" name="organization_id" value="{{pluckOrganization('id')}}">
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
                        <h5 class="modal-title">Add Department</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="departmentForm" method="post" action="{{url('departments')}}" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="modal-body form-type-material">
                            <div class="form-group">
                                <input type="text" class="form-control department-name" name="name">
                                <label>Department Name</label>
                            </div>
                            <input type="hidden" name="organization_id" value="{{pluckOrganization('id')}}">
                            <input type="hidden" id="department-id" name="department_id">
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

        {{--New role modal--}}
        <div id="add-role-modal" class="modal modal-center fade" tabindex="-1">
            <div class="modal-dialog">
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
                                <label class="custom-control float-right custom-control-primary custom-checkbox">
                                    <input type="checkbox" class="check-all-role custom-control-input">
                                    <span class="custom-control-indicator"></span>
                                    <span class="custom-control-description">Select All</span>
                                </label>
                            </div>

                            <div class="h-200px role-checkbox-container" style="overflow-x: hidden; overflow-y: scroll">
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

        {{--Edit Role modal--}}
        @if(count($rolelist))
            @foreach($rolelist as $rlist)
                <div id="edit-role{{ $rlist->id }}-modal" class="modal modal-center fade" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="{{ url('roles/' . $rlist->id) }}" method="post">
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
                                        <input class="form-control" type="text" name="name" value="{{ $rlist->name }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea name="description" rows="2" class="form-control">{{ $rlist->description }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Permissions</label>
                                        <label class="custom-control float-right custom-control-primary custom-checkbox">
                                            <input type="checkbox" class="check-all-role custom-control-input">
                                            <span class="custom-control-indicator"></span>
                                            <span class="custom-control-description">Select All</span>
                                        </label>
                                    </div>
                                    <div class="h-200px role-checkbox-container" style="overflow-x: hidden; overflow-y: scroll">
                                        @foreach (config('permission.models') as $model)
                                            <div class="form-group">
                                                <p>{{ ucfirst($model) }}</p>
                                                <div class="row">
                                                    <div class="col">
                                                        @foreach (config('permission.actions') as $action)
                                                            <label class="custom-control custom-control-primary custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" name="permissions[]" value="{{ $action . '.' . $model }}" @if($rlist->hasPermission($action . '.' . $model))  {{ 'checked' }} @endif>
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
            @endforeach
        @endif

        <script data-provide="sweetalert">
            window.onload=function(){
                $('.deplist-container').on('click','.edit-department',function(){
                    var id=$(this).parent().data('id');
                    var name=$(this).parent().find('.nav-link').text();
                    $('#modal-department').find('.modal-title').html('Edit Department');
                    $('#modal-department').find('input[name="name"]').val(name)
                    $('.department-name').trigger('change');
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
                        submitForm('#dep-delete-role'+id+'-form')
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
                        window.location.href="{{url('users')}}/"+id+"/suspend";
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
                        window.location.href="{{url('users')}}/"+id+"/restore";
                    })
                })

                $('.check-all-role').on('change',function(){
                    if($(this).is(':checked')){
                        $(this).parent().parent().parent().children('.role-checkbox-container').find('input[type="checkbox"]').attr('checked',true);
                    }
                    else{
                        $(this).parent().parent().parent().children('.role-checkbox-container').find('input[type="checkbox"]').attr('checked',false);
                    }
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
        </main>
@endsection
