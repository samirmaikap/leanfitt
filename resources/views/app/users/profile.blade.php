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
                  <img class="avatar avatar-xl" id="user-avatar" src="{{isset($user->avatar) ? $user->avatar : ''}}" alt="...">
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
                    <input class="form-control" name="first_name" value="{{isset($user->first_name) ? $user->first_name : ''}}" type="text">
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
                    <option value="">None</option>
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
              </div>
              @if(!isSuperadmin())
                @permission('update.user')
                <div class="card-footer pb-20 pt-20">
                  <button class="btn btn-block btn-round btn-bold btn-primary" type="submit">Save</button>
                </div>
                @endpermission
              @endif

            </form>
          </div>
        </div>
        <div class="col-lg-8 col-sm-12">
          <div class="card card-slided-down">
            <header class="card-header border-0">
              <h4 class="card-title"><strong>Statistics</strong></h4>
              <ul class="card-controls">
                <li><a class="card-btn-slide" href="#"></a></li>
              </ul>
            </header>

            <div class="card-content">

              <div class="card-body">

                <table class="table table-hover">
                  <thead>
                  <tr>
                    <th style="width: 60%";></th>
                    <th class="content-centered">User</th>
                    <th>Vs.</th>
                    <th class="content-centered">Company Avg.</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr>
                    <th scope="row"># of Action Items Completed:</th>
                    <td class="content-centered">20</td>
                    <td></td>
                    <td class="content-centered">15</td>
                  </tr>
                  <tr>
                    <th scope="row"># of Action Items Incomplete After Due Date:</th>
                    <td class="content-centered">3</td>
                    <td></td>
                    <td class="content-centered">8</td>
                  </tr>
                  <tr>
                    <th scope="row"># of Action Items Outstanding:</th>
                    <td class="content-centered">8</td>
                    <td></td>
                    <td class="content-centered">10</td>
                  </tr>
                  <tr>
                    <th scope="row">Team Member of_Projects:</th>
                    <td class="content-centered">4</td>
                    <td></td>
                    <td class="content-centered">5</td>
                  </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="card card-slided-up">
            <header class="card-header">
              <h4 class="card-title"><strong>Evaluation</strong></h4>
              <ul class="card-controls">
                <li><a class="card-btn-slide" href="#"></a></li>
              </ul>
            </header>

            <div class="card-content">

              <div class="card-body">

                <div class="row">
                  <div class="col-md-4">
                    <br/>
                    <h5>Enthusiasm</h5>
                  </div>
                  <div class="col-md-8">
                    <div id="enthu"></div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-4">
                    <br/>
                    <h5>Communication</h5>
                  </div>
                  <div class="col-md-8">
                    <div id="comm"></div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-4">
                    <br/>
                    <h5>Participation</h5>
                  </div>
                  <div class="col-md-8">
                    <div id="part"></div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-4">
                    <br/>
                    <h5>Quality of Work</h5>
                  </div>
                  <div class="col-md-8">
                    <div id="quality"></div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-4">
                    <br/>
                    <h5>Dependebility</h5>
                  </div>
                  <div class="col-md-8">
                    <div id="depend"></div>
                  </div>
                </div>

              </div>
            </div>
          </div>
          <div class="card card-slided-up">
            <header class="card-header">
              <h4 class="card-title"><strong>Comments: </strong></h4>
              <ul class="card-controls">
                <li><a class="card-btn-slide" href="#"></a></li>
              </ul>
            </header>

            <div class="card-content">

              <div class="card-body">

                <div class="col-md-12 form-type-material">
                  <div class="form-group">
                    <textarea class="form-control" rows="6"></textarea>
                    <label>Add a comment</label>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script>
        window.onload=function(){
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