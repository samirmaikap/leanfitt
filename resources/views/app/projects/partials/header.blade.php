<!-- Project header -->
<header class="header mb-0 bg-ui-general">
    <div class="header-info mt-30 mb-0 center-vh">
        <div class="d-block text-center">
            {{--<img src="{{ asset('assets/img/header/projects.png') }}" alt="Graphics" width="200px" height="200px" style="margin: auto">--}}
            <h3 class="header-title">
                <strong>{{ $project["name"] ? $project["name"] : "Hi, Its me Saqueib Ansari, a web developer building cool things using PHP" }}</strong>
                {{--<small>{{ isset($project["description"]) ? $project["description"] : '' }}</small>--}}
            </h3>
        </div>
    </div>

    <div class="header-action center-h">
        <nav class="nav">
            <a class="nav-link @if(isset($page) && $page == 'details') {{ 'active' }} @endif" href="{{ url('projects/' . $project["id"] . '/details') }}">Details</a>
            <a class="nav-link @if(isset($page) && $page == 'members') {{ 'active' }} @endif" href="{{ url('projects/' . $project["id"] . '/members') }}">Members</a>
            <a class="nav-link @if(isset($page) && $page == 'kpi') {{ 'active' }} @endif" href="{{ url('projects/' . $project["id"] . '/kpi?project=' . $project["id"]) }}">KPI</a>
            <a class="nav-link @if(isset($page) && $page == 'action-items') {{ 'active' }} @endif" href="{{ url('projects/' . $project["id"] . '/action-items') }}">Action Items</a>
            <a class="nav-link @if(isset($page) && $page == 'reports') {{ 'active' }} @endif" href="{{ url('projects/' . $project["id"] . '/reports') }}">Reports</a>
        </nav>
    </div>
</header><!--/.header -->
<!-- END Project header -->


<div class="fab fab-fixed">
    <button class="btn btn-float btn-primary" data-toggle="button">
        <i class="fab-icon-default ti-settings"></i>
        <i class="fab-icon-active ti-close"></i>
    </button>

    <ul class="fab-buttons">
        <li>
            <a class="btn btn-float btn-sm btn-primary" href="#" title="Export PDF" data-toggle="tooltip">
                <i class="fa fa-file-pdf-o"></i>
            </a>
        </li>
        <li>
            <a class="btn btn-float btn-sm btn-primary" href="#" title="View Discussions" data-toggle="tooltip">
                <i class="fa fa-comment"></i>
            </a>
        </li>
    </ul>
</div>