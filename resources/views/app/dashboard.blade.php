@extends("layouts.app")

@section("content")

  <main>
    <div class="main-content">

      @if (Session::has('success'))
        <div class="callout callout-success" role="alert">
          <button type="button" class="close" data-dismiss="callout" aria-label="Close">
            <span>×</span>
          </button>
          <h5>Success</h5>
          <p>{{ Session::get('success') }}</p>
        </div>
      @endif

      <div class="row">

        <!-- <div class="col-6 col-lg-3">
          <div class="card card-body bg-purple">
            <div class="flexbox">
              <span class="ti-user fs-40"></span>
              <span class="fs-40 fw-100">6,568</span>
            </div>
            <div class="text-right">Users</div>
          </div>
        </div>



        <div class="col-6 col-lg-3">
          <div class="card card-body bg-danger">
            <div class="flexbox">
              <span class="ti-wallet fs-40"></span>
              <span class="fs-40">325</span>
            </div>
            <div class="text-right">Invoices</div>
          </div>
        </div>



        <div class="col-6 col-lg-3">
          <div class="card card-body">
            <div class="flexbox">
              <span class="ti-user text-purple fs-40"></span>
              <span class="fs-40 fw-100">6,568</span>
            </div>
            <div class="text-right">Users</div>
          </div>
        </div>



        <div class="col-6 col-lg-3">
          <div class="card card-body">
            <div class="flexbox">
              <span class="ti-wallet text-danger fs-40"></span>
              <span class="fs-40">325</span>
            </div>
            <div class="text-right">Invoices</div>
          </div>
        </div>


        <div class="col-12 h-50px"></div> -->

        <div class="col-12">
          <div class="divider fs-16">Users</div>
        </div>


        <div class="col-6 col-lg-3">
          <div class="card card-body">
            <div class="fs-16 flexbox align-items-center">
              <span>Total</span>
              <i class="fa fa-building-o" aria-hidden="true"></i>
            </div>

            <div class="progress mt-12 mb-0">
              <div class="progress-bar" role="progressbar" style="width: 35%; height: 4px;" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
            </div>

            <small class="flexbox">
              <strong>135</strong>
            </small>
          </div>
        </div>

        <div class="col-6 col-lg-3">
          <div class="card card-body">
            <div class="fs-16 flexbox align-items-center">
              <span>Active</span>
              <i class="ti-user"></i>
            </div>

            <div class="progress mt-12 mb-0">
              <div class="progress-bar" role="progressbar" style="width: 35%; height: 4px;" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
            </div>

            <small class="flexbox">
              <strong>135</strong>
            </small>
          </div>
        </div>

        <div class="col-6 col-lg-3">
          <div class="card card-body">
            <div class="fs-16 flexbox align-items-center">
              <span>Invited</span>
              <i class="ti-user"></i>
            </div>

            <div class="progress mt-12 mb-0">
              <div class="progress-bar" role="progressbar" style="width: 35%; height: 4px;" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
            </div>

            <small class="flexbox">
              <strong>135</strong>
            </small>
          </div>
        </div>

        <div class="col-6 col-lg-3">
          <div class="card card-body">
            <div class="fs-16 flexbox align-items-center">
              <span>Suspended</span>
              <i class="fa fa-newspaper-o" aria-hidden="true"></i>
            </div>

            <div class="progress mt-12 mb-0">
              <div class="progress-bar" role="progressbar" style="width: 35%; height: 4px;" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
            </div>

            <small class="flexbox">
              <strong>135</strong>
              <span class="fw-300"><i class="fa fa-sort-up text-success mr-1"></i> %6 up</span>
            </small>
          </div>
        </div>








        <!-- <div class="col-6 col-lg-3">
          <div class="card card-body">
            <div class="fs-16 flexbox align-items-center">
              <span>Active Employees</span>
              <span>6,568</span>
            </div>
            <div class="progress mt-4 mb-0">
              <div class="progress-bar" role="progressbar" style="width: 55%; height: 4px;" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
          </div>
        </div>



        <div class="col-6 col-lg-3">
          <div class="card card-body">
            <div class="fs-16 flexbox align-items-center">
              <h5>Invited Employees</h5>
              <span>6,568</span>
            </div>
            <div class="progress mt-4 mb-0">
              <div class="progress-bar" role="progressbar" style="width: 55%; height: 4px;" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <div class="text-right"><small class="fw-300"><i class="fa fa-sort-up text-success mr-1"></i> %6 up</small></div>
          </div>
        </div>



        <div class="col-6 col-lg-3">
          <div class="card card-body">
            <h5>Subscriptions</h5>
            <div class="progress mt-4 mb-0">
              <div class="progress-bar" role="progressbar" style="width: 55%; height: 4px;" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <small class="flexbox">
              <strong>135</strong>
              <span class="fw-300"><i class="fa fa-sort-up text-success mr-1"></i> %6 up</span>
            </small>
          </div>
        </div>
    -->

        <div class="col-12">
          <div class="divider fs-16">Action Items</div>
        </div>

        <div class="col-6 col-lg-3">
          <div class="card">
            <div class="card-body">
              <div class="flexbox">
                <h5>Total Action Items</h5>
                <div class="dropdown">
                  <span class="dropdown-toggle no-caret" data-toggle="dropdown"><i class="ti-more-alt rotate-90"></i></span>
                  <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="#"><i class="ion-android-list"></i> Details</a>
                    <a class="dropdown-item" href="#"><i class="ion-android-add"></i> Add new</a>
                    <a class="dropdown-item" href="#"><i class="ion-android-refresh"></i> Refresh</a>
                  </div>
                </div>
              </div>

              <div class="text-center my-2">
                <div class="fs-60 fw-400 text-info">34</div>
                <span class="fw-400 text-muted">Due Tasks</span>
              </div>
            </div>

            <div class="card-body bg-lighter fw-400 py-12">
              <span class="text-muted mr-1">Completed:</span>
              <span class="text-dark">16</span>
            </div>

            <div class="progress mb-0">
              <div class="progress-bar bg-info" role="progressbar" style="width: 45%; height: 3px;" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
          </div>
        </div>




        <div class="col-6 col-lg-3">
          <div class="card">
            <div class="card-body">
              <div class="flexbox">
                <h5>Active Action items</h5>
                <div class="dropdown">
                  <span class="dropdown-toggle no-caret" data-toggle="dropdown"><i class="ti-more-alt rotate-90"></i></span>
                  <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="#"><i class="ion-android-list"></i> Details</a>
                    <a class="dropdown-item" href="#"><i class="ion-android-add"></i> Add new</a>
                    <a class="dropdown-item" href="#"><i class="ion-android-refresh"></i> Refresh</a>
                  </div>
                </div>
              </div>

              <div class="text-center my-2">
                <div class="fs-60 fw-400 text-danger">15</div>
                <span class="fw-400 text-muted">Tasks</span>
              </div>
            </div>

            <div class="card-body bg-lighter fw-400 py-12">
              <span class="text-muted mr-1">Yesterday's overdue:</span>
              <span class="text-dark">9</span>
            </div>

            <div class="progress mb-0">
              <div class="progress-bar bg-danger" role="progressbar" style="width: 35%; height: 3px;" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
          </div>
        </div>



        <div class="col-6 col-lg-3">
          <div class="card">
            <div class="card-body">
              <div class="flexbox">
                <h5>Closed Action Items</h5>
                <div class="dropdown">
                  <span class="dropdown-toggle no-caret" data-toggle="dropdown"><i class="ti-more-alt rotate-90"></i></span>
                  <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="#"><i class="ion-android-list"></i> Details</a>
                    <a class="dropdown-item" href="#"><i class="ion-android-add"></i> Add new</a>
                    <a class="dropdown-item" href="#"><i class="ion-android-refresh"></i> Refresh</a>
                  </div>
                </div>
              </div>

              <div class="text-center my-2">
                <div class="fs-60 fw-400 text-primary">82</div>
                <span class="fw-400 text-muted">Open</span>
              </div>
            </div>

            <div class="card-body bg-lighter fw-400 py-12">
              <span class="text-muted mr-1">Closed today:</span>
              <span class="text-dark">28</span>
            </div>

            <div class="progress mb-0">
              <div class="progress-bar" role="progressbar" style="width: 30%; height: 3px;" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
          </div>
        </div>



        <div class="col-6 col-lg-3">
          <div class="card">
            <div class="card-body">
              <div class="flexbox">
                <h5>Archived Action Items</h5>
                <div class="dropdown">
                  <span class="dropdown-toggle no-caret" data-toggle="dropdown"><i class="ti-more-alt rotate-90"></i></span>
                  <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="#"><i class="ion-android-list"></i> Details</a>
                    <a class="dropdown-item" href="#"><i class="ion-android-add"></i> Add new</a>
                    <a class="dropdown-item" href="#"><i class="ion-android-refresh"></i> Refresh</a>
                  </div>
                </div>
              </div>

              <div class="text-center my-2">
                <div class="fs-60 fw-400 text-dark">39</div>
                <span class="fw-400 text-muted">Proposals</span>
              </div>
            </div>

            <div class="card-body bg-lighter fw-400 py-12">
              <span class="text-muted mr-1">Implemented:</span>
              <span class="text-dark">13</span>
            </div>

            <div class="progress mb-0">
              <div class="progress-bar bg-dark" role="progressbar" style="width: 60%; height: 3px;" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
          </div>
        </div>




        <div class="col-12">
          <div class="divider fs-16">Projects</div>
        </div>



        <div class="col-6 col-lg-3">
          <div class="card card-body">
            <h6>
              <span class="text-uppercase">Total Projects</span>
              <span class="float-right"><a class="btn btn-xs btn-primary" href="#">View</a></span>
            </h6>
            <br>
            <p class="fs-28 fw-100">$21,642</p>

            <div class="progress">
              <div class="progress-bar bg-danger" role="progressbar" style="width: 35%; height: 4px;" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <div class="text-gray fs-12"><i class="ti-stats-down text-success mr-1"></i> %18 decrease from last month</div>
          </div>
        </div>




        <div class="col-6 col-lg-3">
          <div class="card card-body">
            <h6>
              <span class="text-uppercase">Active Projects</span>
              <span class="float-right"><a class="btn btn-xs btn-primary" href="#">View</a></span>
            </h6>
            <br>
            <p class="fs-28 fw-100">2,354</p>
            <div class="progress">
              <div class="progress-bar" role="progressbar" style="width: 65%; height: 4px;" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <div class="text-gray fs-12"><i class="ti-stats-up text-success mr-1"></i> 324 more than last year</div>
          </div>
        </div>




        <div class="col-6 col-lg-3">
          <div class="card card-body">
            <h6>
              <span class="text-uppercase">Closed Projects</span>
              <span class="float-right"><a class="btn btn-xs btn-primary" href="#">View</a></span>
            </h6>
            <br>
            <p class="fs-28 fw-100">653</p>
            <div class="progress">
              <div class="progress-bar bg-warning" role="progressbar" style="width: 65%; height: 4px;" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <div class="text-gray fs-12"><i class="ti-arrow-down text-danger mr-1"></i> %32 down</div>
          </div>
        </div>




        <div class="col-6 col-lg-3">
          <div class="card card-body">
            <h6>
              <span class="text-uppercase">Archived Projects</span>
              <span class="float-right"><a class="btn btn-xs btn-primary" href="#">View</a></span>
            </h6>
            <br>
            <p class="fs-28 fw-100">18,964</p>
            <div class="progress">
              <div class="progress-bar bg-success" role="progressbar" style="width: 85%; height: 4px;" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <div class="flexbox text-gray fs-12">
              <span><i class="ti-arrow-up text-success mr-1"></i> %25 up</span>
              <span>+1000</span>
            </div>
          </div>
        </div>





        <div class="col-md-6 col-lg-12">
          <div class="card">
            <div class="card-header">
              <h5 class="card-title">Top Locations</h5>

              <ul class="card-controls">
                <li class="dropdown">
                  <a data-toggle="dropdown" href="#"><i class="ti-more-alt rotate-90"></i></a>
                  <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item active" href="#">Today</a>
                    <a class="dropdown-item" href="#">Yesterday</a>
                    <a class="dropdown-item" href="#">Last week</a>
                    <a class="dropdown-item" href="#">Last month</a>
                  </div>
                </li>
                <li><a class="card-btn-reload" href="../assets/data/general.html" title="Refresh" data-provide="tooltip"><i class="fa fa-circle-thin"></i></a></li>
              </ul>
            </div>

            <div class="card-body card-body">
              <div class="text-center py-20">
                <div data-provide="peity" data-type="pie" data-size="150" data-inner-radius="55" data-fill="#33cabb,#48b0f7,#fdd501">9,6,5</div>
              </div>

              <ul class="flexbox flex-justified text-center mt-30">
                <li class="br-1 botder-light">
                  <div class="fs-20 text-primary">953</div>
                  <small>New York</small>
                </li>

                <li class="br-1 botder-light">
                  <div class="fs-20 text-info">813</div>
                  <small>Los Angeles</small>
                </li>

                <li>
                  <div class="fs-20 text-yellow">369</div>
                  <small>Dallas</small>
                </li>
              </ul>
            </div>
          </div>
        </div>





        <div class="col-12 h-50px"></div>





        <div class="col-12">
          <div class="card">
            <div class="row no-gutters py-2">


              <div class="col-sm-6 col-lg-3">
                <div class="card-body br-1 border-light">
                  <div class="flexbox mb-1">
                      <span>
                        <i class="ti-user fs-20"></i><br>
                        New Users
                      </span>
                    <span class="text-primary fs-40">34</span>
                  </div>
                  <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: 35%; height: 4px;" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>


              <div class="col-sm-6 col-lg-3 hidden-down">
                <div class="card-body br-1 border-light">
                  <div class="flexbox mb-1">
                      <span>
                        <i class="ti-wallet fs-20"></i><br>
                        Today Invoices
                      </span>
                    <span class="text-info fs-40">18</span>
                  </div>
                  <div class="progress">
                    <div class="progress-bar bg-info" role="progressbar" style="width: 55%; height: 4px;" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>


              <div class="col-sm-6 col-lg-3 d-none d-lg-block">
                <div class="card-body br-1 border-light">
                  <div class="flexbox mb-1">
                      <span>
                        <i class="fa fa-bug fs-20"></i><br>
                        Open Issues
                      </span>
                    <span class="text-warning fs-40">46</span>
                  </div>
                  <div class="progress">
                    <div class="progress-bar bg-warning" role="progressbar" style="width: 65%; height: 4px;" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>


              <div class="col-sm-6 col-lg-3 d-none d-lg-block">
                <div class="card-body">
                  <div class="flexbox mb-1">
                      <span>
                        <i class="ti-folder fs-20"></i><br>
                        New Projects
                      </span>
                    <span class="text-danger fs-40">12</span>
                  </div>
                  <div class="progress">
                    <div class="progress-bar bg-danger" role="progressbar" style="width: 40%; height: 4px;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>


            </div>
          </div>
        </div>





        <div class="col-12 h-50px"></div>
















      </div>
    </div><!--/.main-content -->
  </main>
@endsection