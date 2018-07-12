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

    <nav class="sidebar-navigation">
        @if(auth()->user() && auth()->user()->organizations()->count())
        <div class="sidebar-profile bg-pale-gray">
            <div class="dropdown">
                <span class="dropdown-toggle no-caret" data-toggle="dropdown">
                    <div class="profile-info">
                        <img class="avatar" src="https://ui-avatars.com/api/?name=Debajyoti%20Das" alt="...">
                        <h4 class="mb-0">
                            @php $defaultOrganization = session('organization')  @endphp
                            {{ $defaultOrganization->name }}
                            <i class="fa fa-caret-down"></i>
                        </h4>
                        <p>Admin, Lean Sensei, Manager</p>
                    </div>
                </span>
                <div class="dropdown-menu">
                    @foreach(session('relatedOrganizations') as $organization)
                    <a class="dropdown-item" href="{{ $organization->url . '/dashboard' }}">
                        <i class="ti-arrow-right"></i>
                        {{ $organization->name }}
                    @endforeach

                    <div class="dropdown-divider"></div>

                    <a class="dropdown-item" href="{{ url(config('app.url') . '/organizations/create' ) }}" target="_blank">
                        <i class="ti-plus"></i>
                        Create Organization
                    </a>
                </div>
            </div>
        </div>
        @endif
        <ul class="menu">
            {{--<li class="menu-category">Home</li>--}}
            <li class="menu-item active">
                <a class="menu-link" href="{{ url("dashboard") }}">
                    <span class="icon fa fa-home"></span>
                    <span class="title">Dashboard</span>
                </a>
            </li>

            {{--<li class="menu-category">Directory</li>--}}

            {{--<li class="menu-item">--}}
                {{--<a class="menu-link" href="{{ url('organizations') }}">--}}
                    {{--<span class="icon fa fa-building"></span>--}}
                    {{--<span class="title">Organizations</span>--}}
                    {{--<span class="arrow"></span>--}}
                {{--</a>--}}
            {{--</li>--}}

            <li class="menu-item">
                <a class="menu-link" href="{{ url('users') }}">
                    <span class="icon fa fa-users"></span>
                    <span class="title">Users</span>
                    {{--<span class="arrow"></span>--}}
                </a>
            </li>

            <li class="menu-item">
                <a class="menu-link" href="{{ url('departments') }}">
                    <span class="icon fa fa-users"></span>
                    <span class="title">Departments</span>
                    {{--<span class="arrow"></span>--}}
                </a>
            </li>
            <li class="menu-item">
                <a class="menu-link" href="{{ url('roles') }}">
                    <span class="icon fa fa-users"></span>
                    <span class="title">Roles</span>
                    {{--<span class="arrow"></span>--}}
                </a>
            </li>

            {{--<li class="menu-item">--}}
                {{--<a class="menu-link" href="{{ url('organizations') }}">--}}
                    {{--<span class="icon fa fa-address-card"></span>--}}
                    {{--<span class="title">Organizations</span>--}}
                {{--</a>--}}
            {{--</li>--}}

            {{--@if(empty(session('relatedOrganizations')))--}}
                {{--<li class="menu-item">--}}
                    {{--<a class="menu-link" href="{{ url('organizations') }}">--}}
                        {{--<span class="icon fa fa-address-card"></span>--}}
                        {{--<span class="title">Organizations</span>--}}
                    {{--</a>--}}
                {{--</li>--}}
            {{--@endif--}}
            {{--<li class="menu-item">--}}
                {{--<a class="menu-link" href="{{ url('departments') }}">--}}
                    {{--<span class="icon ti-layout-tab"></span>--}}
                    {{--<span class="title">Departments</span>--}}
                    {{--<span class="arrow"></span>--}}
                {{--</a>--}}
            {{--</li>--}}

            <li class="menu-category">LeanFITT</li>

            <li class="menu-item">
                <a class="menu-link" href="{{ url("lean-tools") }}">
                    <span class="icon fa fa-home"></span>
                    <span class="title">Lean Tools</span>
                </a>
            </li>
            <li class="menu-item">
                <a class="menu-link" href="{{ url("quizzes") }}">
                    <span class="icon fa fa-home"></span>
                    <span class="title">Quizzes</span>
                </a>
            </li>
            <li class="menu-item">
                <a class="menu-link" href="{{ url("assessment") }}">
                    <span class="icon fa fa-home"></span>
                    <span class="title">Assessments</span>
                </a>
            </li>

            <li class="menu-category">Project</li>

            <li class="menu-item">
                <a class="menu-link" href="{{ url("projects") }}">
                    <span class="icon fa fa-home"></span>
                    <span class="title">My Projects</span>
                </a>
            </li>
            <li class="menu-item">
                <a class="menu-link" href="{{ url("kpi") }}">
                    <span class="icon fa fa-home"></span>
                    <span class="title">KPI</span>
                </a>
            </li>
            <li class="menu-item">
                <a class="menu-link" href="{{ url("action-items") }}">
                    <span class="icon fa fa-home"></span>
                    <span class="title">Action Items</span>
                </a>
            </li>

            <li class="menu-item">
                <a class="menu-link" href="{{ url("reports") }}">
                    <span class="icon fa fa-home"></span>
                    <span class="title">Reports</span>
                </a>
            </li>

            {{--<li class="menu-category">Account</li>--}}

            {{--<li class="menu-item">--}}
                {{--<a class="menu-link" href="{{ url("dashboard") }}">--}}
                    {{--<span class="icon fa fa-home"></span>--}}
                    {{--<span class="title">Organization Profile</span>--}}
                {{--</a>--}}
            {{--</li>--}}
            {{--<li class="menu-item">--}}
                {{--<a class="menu-link" href="{{ url("dashboard") }}">--}}
                    {{--<span class="icon fa fa-home"></span>--}}
                    {{--<span class="title">Subscription</span>--}}
                {{--</a>--}}
            {{--</li>--}}
            {{--<li class="menu-item">--}}
                {{--<a class="menu-link" href="{{ url("dashboard") }}">--}}
                    {{--<span class="icon fa fa-home"></span>--}}
                    {{--<span class="title">Settings</span>--}}
                {{--</a>--}}
            {{--</li>--}}

        </ul>
    </nav>
</aside>
<!-- END Sidebar -->