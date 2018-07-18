<!-- Topbar -->
<nav class="topbar #topbar-expand-lg topbar-inverse bg-primary" id="app-topbar">
    <div class="topbar-left">
        {{--<span class="topbar-btn topbar-menu-toggler"><i>&#9776;</i></span>--}}
        @if(auth()->user())
        <span class="topbar-btn sidebar-toggler #sidebar-toggle-fold"><i>&#9776;</i></span>
        @endif
        <span class="topbar-brand">
            <img src="https://preview.ibb.co/cf8Ugd/logopng_2_white.png" alt="LeanFITT" width="150">
        </span>

        <div class="topbar-divider d-none d-xl-block"></div>

        <nav class="topbar-navigation">
            <marquee style="width: calc(100vw - 400px)" direction="left"> Daily motivational quotes for your organization.</marquee>
        </nav>

    </div>

    <div class="topbar-right">
        <ul class="topbar-btns">
            <li class="dropdown">
                <span class="topbar-btn" data-toggle="dropdown">
                    <img class="avatar" src="{{ auth()->user()->avatar }}" alt="{{ auth()->user()->initials }}">
                </span>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="#profile-modal" data-toggle="modal"><i class="ti-user"></i> Profile</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ env('APP_URL').'/logout' }}"><i class="ti-power-off"></i> Logout</a>
                </div>
            </li>
        </ul>
        <div class="topbar-divider d-none d-md-block"></div>
    </div>
</nav>
<!-- END Topbar -->