@extends('layouts.app')
@section('content')
    <main class="main-container">
        <header class="header no-border">
            <div class="header-bar">
                <h4>Profile</h4>
                {{--<button class="btn btn-round btn-success">Profile</button>--}}
            </div>
        </header>
        <div class="main-content">
            <div class="row">
                <div class="col-lg-4 col-sm-12">
                    <div class="card">
                        <form method="post" action="{{url('users')}}/{{$user->id}}" enctype="multipart/form-data">
                            {{csrf_field()}}
                            {{method_field('put')}}
                            <div class="card-header pt-20 pb-20">
                                <div class="flexbox gap-items-4">
                                    <img class="avatar avatar-xl" id="user-avatar" src="{{empty($user->avatar) ? env('UI_AVATAR').$user->full_name : $user->avatar}}" alt="...">
                                    <div class="flex-grow">
                                        <h5>{{isset($user->full_name) ? $user->full_name : ''}}</h5>
                                        <div class="d-flex flex-column flex-sm-row gap-items-2 gap-y mt-16">
                                            <div class="file-group file-group-inline">
                                                <button class="btn btn-sm btn-w-lg btn-outline btn-round btn-secondary file-browser" type="button">Change Picture</button>
                                                <input type="file" name="image" id="imgInp" onchange="loadFile(event)">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="text-dark">First name</label>
                                        <input class="form-control" name="first_name" value="{{isset($user->first_name) ? ucfirst($user->first_name) : ''}}" type="text">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="text-dark">Last name</label>
                                        <input class="form-control" name="last_name" value="{{isset($user->last_name) ? $user->last_name : ''}}" type="text">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="text-dark">Email</label>
                                    <input class="form-control" type="text" value="{{isset($user->email) ? $user->email : ''}}" disabled="disabled">
                                </div>
                                <div class="form-group">
                                    <label class="text-dark">Phone</label>
                                    <input class="form-control" name="phone" value="{{isset($user->phone) ? $user->phone : ''}}" type="text">
                                </div>

                                @if(session()->get('user')->id==$user->id)
                                    <div class="form-group">
                                        <label class="text-dark">Password</label>
                                        <input class="form-control" name="password"  type="password">
                                    </div>
                                    <div class="form-group">
                                        <label class="text-dark">Password Confirmation</label>
                                        <input class="form-control" name="password_confirmation" type="password">
                                    </div>
                                @endif

                                @if(!isSuperadmin())
                                    @permission('update.user')
                                    <div class="form-group">
                                        <label class="d-block">Departments</label>
                                        <select class="disabled-picker" name="departments[]" id="" data-width="100%" data-provide="selectpicker" multiple >
                                            <option value="">None</option>
                                            @if($departments->count())
                                                @foreach($departments as $department)
                                                    <option class="options" value="{{ $department->id }}" {{ in_array($department->name, $user->departments->pluck('name')->toArray()) ? 'selected' : '' }} >
                                                        {{ $department->name }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="d-block">Roles</label>
                                        <select class="disabled-picker" name="roles[]" id="" data-width="100%" data-provide="selectpicker" multiple >
                                            @if(count($roles))
                                                @foreach($roles as $role)
                                                    <option class="options" value="{{ $role->id }}" {{ in_array($role->name, $user->roles->pluck('name')->toArray()) ? 'selected' : '' }} >
                                                        {{ $role->name }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    @endpermission
                                @endif

                            </div>
                            @if(session()->get('user')->id!=$user->id)
                                @permission('update.user')
                                <div class="card-footer pb-20 pt-20">
                                    <button class="btn btn-block btn-round btn-bold btn-primary" type="submit">Save</button>
                                </div>
                                @endpermission
                            @else
                                <div class="card-footer pb-20 pt-20">
                                    <button class="btn btn-block btn-round btn-bold btn-primary" type="submit">Save</button>
                                </div>
                            @endif

                        </form>
                    </div>
                </div>
                <div class="col-lg-8 col-sm-12">
                    <div class="card">
                        <h4 class="card-title py-20"><strong>Evaluation</strong></h4>
                        <form method="post" action="{{url('users/profile/evaluation')}}" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="card-body">
                                <table class="table table-separated">
                                    <tbody>
                                    <tr>
                                        <td class="w-180px align-middle">Communication</td>
                                        <td class="align-middle"><input class="evaluation-slider-0" type="text" name="communication" value="{{isset($evaluation->communication) ? $evaluation->communication : 1}}" /></td>
                                    </tr>
                                    <tr>
                                        <td class="w-180px align-middle">Entusiasm</td>
                                        <td class="align-middle"><input class="evaluation-slider-1" type="text" name="enthusiasm" value="{{isset($evaluation->enthusiasm) ? $evaluation->enthusiasm : 1}}" /></td>
                                    </tr>
                                    <tr>
                                        <td class="w-180px align-middle">Participation</td>
                                        <td class="align-middle"><input class="evaluation-slider-2" type="text" name="participation" value="{{isset($evaluation->participation) ? $evaluation->participation : 1}}" /></td>

                                    </tr>
                                    <tr>
                                        <td class="w-180px align-middle">Quality of Work</td>
                                        <td class="align-middle"><input class="evaluation-slider-3" type="text" name="quality_work" value="{{isset($evaluation->quality_work) ? $evaluation->quality_work : 1}}" /></td>
                                    </tr>
                                    <tr>
                                        <td class="w-180px align-middle">Dependability</td>
                                        <td class="align-middle"><input class="evaluation-slider-4" type="text" name="dependability" value="1" /></td>
                                    </tr>
                                    </tbody>
                                </table>
                                <div class="form-group">
                                    <label>Remark</label>
                                    <textarea class="form-control" name="remark" style="resize: none">{{isset($evaluation->remark) ? $evaluation->remark : ''}}</textarea>
                                </div>
                                <input type="hidden" name="user_id" value="{{$user->id}}">
                                <input type="hidden" name="organization_id" value="{{session()->get('organization')->id}}">
                                <input type="hidden" name="evaluated_by" value="{{session()->get('user')->id}}">
                                <input type="hidden" name="evaluation_id" value="{{isset($evaluation->id) ? $evaluation->id : ''}}">
                            </div>
                            <div class="card-body text-center py-20">
                                <button class="btn btn-success btn-round w-200px mb-20">Save</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        {{--{{dd(collect($evaluation)->except(['id','organization_user_id','remark','evaluated_by','created_at','updated_at'])->values()->toJson())}}--}}
        <script>
            window.onload=function(){
                $(function(){
                    var values=JSON.parse('{{collect($evaluation)->except(['id','organization_user_id','remark','evaluated_by','created_at','updated_at'])->values()->toJson()}}')
                    for(var i=0;i<values.length;i++){
                        $(".evaluation-slider-"+i).ionRangeSlider({
                            min: 1,
                            max: 10,
                            from:values[i]
                        });
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
                var output = document.getElementById('user-avatar');
                output.src = URL.createObjectURL(event.target.files[0]);
            }
        </script>
    </main>
@endsection