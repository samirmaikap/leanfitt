<!-- Sidebar -->
<aside class="sidebar sidebar-light sidebar-expand-md">
    <header class="sidebar-header bg-white">
        {{--<a class="logo-icon" href="/">--}}
            {{--<img src="https://image.ibb.co/dAqOjy/logopng_3.png" alt="LeanFITT" width="200">--}}
        {{--</a>--}}
        <span class="logo center-vh">
          <a href="/">
              <img src="https://preview.ibb.co/nnWvuy/logopng_2.png" alt="LeanFITT" width="150">
          </a>
        </span>
        {{--<span class="sidebar-toggle-fold"></span>--}}
    </header>

    @php $page=isset($page) ? $page : null; @endphp

    <nav class="sidebar-navigation">
        @if(auth()->user() && session()->get('user')->is_superadmin==0 && auth()->user()->organizations()->count())
        <div class="sidebar-profile bg-pale-gray">
            <div class="dropdown">
                <span class="dropdown-toggle no-caret" data-toggle="dropdown">
                    <div class="profile-info">
                        <img class="avatar" src="{{session()->get('user')->avatar}}" alt="...">
                        <h4 class="mb-0">
                            @php $defaultOrganization = session()->get('organization')  @endphp
                            {{ isset($defaultOrganization->name) ?$defaultOrganization->name : null }}
                            <i class="fa fa-caret-down"></i>
                        </h4>
                        <p>{{ isset(session('user')->roles) ? implode(', ',session('user')->roles->pluck('display_name')->toArray()) : '' }}</p>
                    </div>
                </span>
                <div class="dropdown-menu">
                    @php $relatedOrganization=session()->get('relatedOrganizations') @endphp
                    @if(count($relatedOrganization) > 0)
                    @foreach($relatedOrganization as $organization)
                        <a class="dropdown-item" href="{{ $organization->url . '/dashboard' }}">
                            <i class="ti-arrow-right"></i>
                            {{ $organization->name }}
                        </a>
                    @endforeach
                    @endif
                    <div class="dropdown-divider"></div>
                    @permission('create.organization')
                    <a class="dropdown-item" href="{{ url(config('app.url') . '/organizations/create' ) }}" target="_blank">
                        <i class="ti-plus"></i>
                        Create Organization
                    </a>
                    @endpermission
                </div>
            </div>
        </div>
        @endif
        <ul class="menu">
            <li class="menu-item {{$page=='dashboard' ? 'active' : ''}}">
                <a class="menu-link" href="{{ url("dashboard") }}">
                    <span class="icon fa fa-home"></span>
                    <span class="title">Dashboard</span>
                </a>
            </li>

            @if(auth()->user()->is_superadmin==1)
                <li class="menu-item {{$page=='organizations' ? 'active' : ''}}">
                    <a class="menu-link" href="{{ url('organizations') }}">
                        <span class="icon fa fa-building"></span>
                        <span class="title">Organizations</span>
                    </a>
                </li>
            @endif

            @permission('read.user')
                <li class="menu-item {{$page=='users' ? 'active' : ''}}">
                    <a class="menu-link" href="{{ url('users') }}">
                        <span class="icon fa fa-users"></span>
                        <span class="title">Users</span>
                    </a>
                </li>
                {{--<li class="menu-item">--}}
                    {{--<a class="menu-link" href="{{ url('departments') }}">--}}
                        {{--<span class="icon fa fa-users"></span>--}}
                        {{--<span class="title">Departments</span>--}}
                    {{--</a>--}}
                {{--</li>--}}

                {{--<li class="menu-item">--}}
                    {{--<a class="menu-link" href="{{ url('roles') }}">--}}
                        {{--<span class="icon fa fa-users"></span>--}}
                        {{--<span class="title">Roles</span>--}}
                    {{--</a>--}}
                {{--</li>--}}
            @endpermission

            @permission('index.project')
                <li class="menu-category">Project</li>

                <li class="menu-item {{$page=='projects' ? 'active' : ''}}">
                    <a class="menu-link" href="{{ url("projects") }}">
                        <span class="icon fa fa-home"></span>
                        <span class="title">Projects</span>
                    </a>
                </li>
            @endpermission

            <li class="menu-category">LeanFITT</li>

            <li class="menu-item {{$page=='lean-tools' ? 'active' : ''}}">
                <a class="menu-link" href="{{ url("lean-tools") }}">
                    <span class="icon fa fa-home"></span>
                    <span class="title">Lean Tools</span>
                </a>
            </li>
            <li class="menu-item {{$page=='quizzes' ? 'active' : ''}}">
                <a class="menu-link" href="{{ url("quizzes") }}">
                    <span class="icon fa fa-home"></span>
                    <span class="title">Quizzes</span>
                </a>
            </li>
            <li class="menu-item {{$page=='assessment' ? 'active' : ''}}">
                <a class="menu-link" href="{{ url("assessment") }}">
                    <span class="icon fa fa-home"></span>
                    <span class="title">Assessments</span>
                </a>
            </li>
            <li class="menu-item {{$page=='awards' ? 'active' : ''}}">
                <a class="menu-link" href="{{ url("awards") }}">
                    <span class="icon fa fa-home"></span>
                    <span class="title">Awards</span>
                </a>
            </li>
        </ul>
    </nav>
</aside>
<!-- END Sidebar -->