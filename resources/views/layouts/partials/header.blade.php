<!-- Topbar -->
<nav class="topbar #topbar-expand-lg topbar-inverse bg-primary" id="app-topbar">
    <div class="topbar-left">
        {{--<span class="topbar-btn topbar-menu-toggler"><i>&#9776;</i></span>--}}
        @if(session()->get('user')->is_superadmin==1)
            <span class="topbar-btn sidebar-toggler #sidebar-toggle-fold"><i>&#9776;</i></span>
        @else
            @if(session()->get('user') && !empty(pluckOrganization('id')))
                <span class="topbar-btn sidebar-toggler #sidebar-toggle-fold"><i>&#9776;</i></span>
            @endif
        @endif
        <span class="topbar-brand">
            <img src="https://preview.ibb.co/cf8Ugd/logopng_2_white.png" alt="LeanFITT" width="150">
        </span>

        <div class="topbar-divider d-none d-xl-block"></div>

        {{--<nav class="topbar-navigation">--}}
            {{--<marquee style="width: calc(100vw - 400px)" direction="left"> Daily motivational quotes for your organization.</marquee>--}}
        {{--</nav>--}}

    </div>

    <div class="topbar-right">

        <ul class="topbar-btns">
            <li class="dropdown">
                <span class="topbar-btn" data-toggle="dropdown">
                    @php
                        if(isSuperadmin()){
                        $user_role='SuperAdmin';
                        }
                        else{
                        $crole=session()->get('currentRole');
                        $user_role=isset($crole) ? $crole->name : 'User';
                        }
                    @endphp
                    <img class="avatar" src="{{ session()->get('user')->avatar }}" alt="{{ session()->get('user')->initials }}">
                    <span class="ml-1 fs-14">Welcome, {{ucfirst($user_role)}}</span>
                </span>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item text-truncate w-180px" href="{{url('users')}}/{{session()->get('user')->id}}/profile"><i class="ti-user"></i> {{session()->get('user')->full_name}}</a>
                    @if(!isSuperadmin())
                    @permission('update.organization')
                    <a class="dropdown-item" href="{{url('organizations')}}/{{pluckOrganization('id')}}/view"><i class="ti-briefcase"></i> My Organization</a>
                    @endpermission
                    @endif
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ env('APP_URL').'/logout' }}"><i class="ti-power-off"></i> Logout</a>
                </div>
            </li>
        </ul>
        <div class="topbar-divider d-none d-md-block"></div>
    </div>
</nav>
<!-- END Topbar -->