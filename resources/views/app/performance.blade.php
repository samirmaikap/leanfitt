<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive admin dashboard and web application ui kit. Theadmin includes a powerful mobile-first grid system for building layouts of all shapes and sizes.">
    <meta name="keywords" content="grid, layout">

    <title>Bootstrap Grid &mdash; TheAdmin</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,300i" rel="stylesheet">

    <!-- Styles -->
    <link href="../assets/css/core.min.css" rel="stylesheet">
    <link href="../assets/css/app.min.css" rel="stylesheet">
    <link href="../assets/css/style.min.css" rel="stylesheet">
    <link href="../assets/plugins/ion_range_slider/css/ion.rangeSlider.css" rel="stylesheet">
    <link href="../assets/plugins/ion_range_slider/css/ion.rangeSlider.skinHTML5.css" rel="stylesheet">
    

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="../assets/img/apple-touch-icon.png">
    <link rel="icon" href="../assets/img/favicon.png">
    <style type="text/css">
      .width-60 {
        width: 60%;
      }

      .content-centered {
        text-align: -webkit-center;
      }


      .slidecontainer {
          width: 100%;
      }

      .slider {
          -webkit-appearance: none;
          width: 100%;
          height: 10px;
          border-radius: 5px;
          background: #d3d3d3;
          outline: none;
          opacity: 0.7;
          -webkit-transition: .2s;
          transition: opacity .2s;
      }

      .slider:hover {
          opacity: 1;
      }

      .slider::-webkit-slider-thumb {
          -webkit-appearance: none;
          appearance: none;
          width: 23px;
          height: 24px;
          border: 0;
          background: url('contrasticon.png');
          cursor: pointer;
      }

      .slider::-moz-range-thumb {
          width: 23px;
          height: 24px;
          border: 0;
          background: url('contrasticon.png');
          cursor: pointer;
      }

      .text-right {
        text-align: -webkit-right !important;
      }

      #slider label {
        position: absolute;
        width: 20px;
        margin-top: 20px;
        margin-left: -10px;
        text-align: center;
      }

    </style>
  </head>

  <body>

    <!-- Preloader -->
    <div class="preloader">
      <div class="spinner-dots">
        <span class="dot1"></span>
        <span class="dot2"></span>
        <span class="dot3"></span>
      </div>
    </div>


    <!-- Sidebar -->
    <aside class="sidebar sidebar-light sidebar-expand-md">
      <header class="sidebar-header">
        <a class="logo-icon" href="../index.html"><img src="assets/img/logo-icon-light.png" alt="logo icon"></a>
        <span class="logo">
          <a href="../index.html"><img src="assets/img/logo-light.png" alt="logo"></a>
        </span>
        <span class="sidebar-toggle-fold"></span>
      </header>

      <nav class="sidebar-navigation">

        <div class="sidebar-profile">
          <div class="dropdown">
            <span class="dropdown-toggle no-caret" data-toggle="dropdown"><img class="avatar" src="https://ui-avatars.com/api/?name=Debajyoti%20Das" alt="..."></span>
            <div class="dropdown-menu open-top-center">
              <a class="dropdown-item" href="#"><i class="ti-user"></i> Profile</a>
              <a class="dropdown-item" href="#"><i class="ti-settings"></i> Settings</a>
              <a class="dropdown-item" href="#"><i class="ti-help"></i> Help</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#"><i class="ti-power-off"></i> Logout</a>
            </div>
          </div>

          <div class="profile-info">
            <h4 class="mb-0">Debajyoti Das</h4>
            <p>Full Stack Developer</p>
          </div>
        </div>

        <ul class="menu">
          <li class="menu-category">Category 1</li>
          <li class="menu-item active">
            <a class="menu-link" href="../dashboard/general.html">
              <span class="icon fa fa-home"></span>
              <span class="title">Dashboard</span>
            </a>
          </li>

          <li class="menu-item">
            <a class="menu-link" href="#">
              <span class="icon fa fa-user"></span>
              <span class="title">Users</span>
              <span class="arrow"></span>
            </a>

            <ul class="menu-submenu">
              <li class="menu-item">
                <a class="menu-link" href="#">
                  <span class="dot"></span>
                  <span class="title">Moderators</span>
                </a>
              </li>

              <li class="menu-item">
                <a class="menu-link" href="#">
                  <span class="dot"></span>
                  <span class="title">Customers</span>
                </a>
              </li>
            </ul>
          </li>



          <li class="menu-category">Category 2</li>


          <li class="menu-item">
            <a class="menu-link" href="#">
              <span class="icon ti-layout"></span>
              <span class="title">Layout</span>
              <span class="arrow"></span>
            </a>

            <ul class="menu-submenu">
              <li class="menu-item">
                <a class="menu-link" href="#">
                  <span class="dot"></span>
                  <span class="title">Sidebar</span>
                </a>
              </li>

              <li class="menu-item">
                <a class="menu-link" href="#">
                  <span class="dot"></span>
                  <span class="title">Header</span>
                </a>
              </li>

              <li class="menu-item">
                <a class="menu-link" href="#">
                  <span class="dot"></span>
                  <span class="title">Footer</span>
                </a>
              </li>
            </ul>
          </li>

        </ul>
      </nav>

    </aside>
    <!-- END Sidebar -->


    <!-- Topbar -->
    <header class="topbar">
      <div class="topbar-left">
        <span class="topbar-btn sidebar-toggler"><i>&#9776;</i></span>

        <a class="topbar-btn d-none d-md-block" href="#" data-provide="fullscreen tooltip" title="Fullscreen">
          <i class="material-icons fullscreen-default">fullscreen</i>
          <i class="material-icons fullscreen-active">fullscreen_exit</i>
        </a>

        <div class="dropdown d-none d-md-block">
          <span class="topbar-btn" data-toggle="dropdown"><i class="ti-layout-grid3-alt"></i></span>
          <div class="dropdown-menu dropdown-grid">
            <a class="dropdown-item" href="../dashboard/general.html">
              <span data-i8-icon="home"></span>
              <span class="title">Dashboard</span>
            </a>
            <a class="dropdown-item" href="../page/gallery.html">
              <span data-i8-icon="stack_of_photos"></span>
              <span class="title">Gallery</span>
            </a>
            <a class="dropdown-item" href="../page/search.html">
              <span data-i8-icon="search"></span>
              <span class="title">Search</span>
            </a>
            <a class="dropdown-item" href="../page-app/calendar.html">
              <span data-i8-icon="calendar"></span>
              <span class="title">Calendar</span>
            </a>
            <a class="dropdown-item" href="../page-app/chat.html">
              <span data-i8-icon="sms"></span>
              <span class="title">Chat</span>
            </a>
            <a class="dropdown-item" href="../page-app/mailbox.html">
              <span data-i8-icon="invite"></span>
              <span class="title">Emails</span>
            </a>
            <a class="dropdown-item" href="../page-app/users.html">
              <span data-i8-icon="contacts"></span>
              <span class="title">Contacts</span>
            </a>
            <a class="dropdown-item" href="../widget/chart.html">
              <span data-i8-icon="bar_chart"></span>
              <span class="title">Charts</span>
            </a>
            <a class="dropdown-item" href="../page/profile.html">
              <span data-i8-icon="businessman"></span>
              <span class="title">Profile</span>
            </a>
          </div>
        </div>

        <div class="topbar-divider d-none d-md-block"></div>

        <div class="lookup d-none d-md-block topbar-search" id="theadmin-search">
          <input class="form-control w-300px" type="text">
          <div class="lookup-placeholder">
            <i class="ti-search"></i>
            <span><strong>Try</strong> button, slider, modal, etc.</span>
          </div>
        </div>
      </div>

      <div class="topbar-right">
        <a class="topbar-btn" href="#qv-global" data-toggle="quickview"><i class="ti-align-right"></i></a>

        <div class="topbar-divider"></div>

        <ul class="topbar-btns">
          <li class="dropdown">
            <span class="topbar-btn" data-toggle="dropdown"><img class="avatar" src="../assets/img/avatar/1.jpg" alt="..."></span>
            <div class="dropdown-menu dropdown-menu-right">
              <a class="dropdown-item" href="../page/profile.html"><i class="ti-user"></i> Profile</a>
              <a class="dropdown-item" href="../page-app/mailbox.html">
                <div class="flexbox">
                  <i class="ti-email"></i>
                  <span class="flex-grow">Inbox</span>
                  <span class="badge badge-pill badge-info">5</span>
                </div>
              </a>
              <a class="dropdown-item" href="#"><i class="ti-settings"></i> Settings</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="../page-extra/user-lock-1.html"><i class="ti-lock"></i> Lock</a>
              <a class="dropdown-item" href="../page-extra/user-login-3.html"><i class="ti-power-off"></i> Logout</a>
            </div>
          </li>

          <!-- Notifications -->
          <li class="dropdown d-none d-md-block">
            <span class="topbar-btn has-new" data-toggle="dropdown"><i class="ti-bell"></i></span>
            <div class="dropdown-menu dropdown-menu-right">

              <div class="media-list media-list-hover media-list-divided media-list-xs">
                <a class="media media-new" href="#">
                  <span class="avatar bg-success"><i class="ti-user"></i></span>
                  <div class="media-body">
                    <p>New user registered</p>
                    <time datetime="2017-07-14 20:00">Just now</time>
                  </div>
                </a>

                <a class="media" href="#">
                  <span class="avatar bg-info"><i class="ti-shopping-cart"></i></span>
                  <div class="media-body">
                    <p>New order received</p>
                    <time datetime="2017-07-14 20:00">2 min ago</time>
                  </div>
                </a>

                <a class="media" href="#">
                  <span class="avatar bg-warning"><i class="ti-face-sad"></i></span>
                  <div class="media-body">
                    <p>Refund request from <b>Ashlyn Culotta</b></p>
                    <time datetime="2017-07-14 20:00">24 min ago</time>
                  </div>
                </a>

                <a class="media" href="#">
                  <span class="avatar bg-primary"><i class="ti-money"></i></span>
                  <div class="media-body">
                    <p>New payment has made through PayPal</p>
                    <time datetime="2017-07-14 20:00">53 min ago</time>
                  </div>
                </a>
              </div>

              <div class="dropdown-footer">
                <div class="left">
                  <a href="#">Read all notifications</a>
                </div>

                <div class="right">
                  <a href="#" data-provide="tooltip" title="Mark all as read"><i class="fa fa-circle-o"></i></a>
                  <a href="#" data-provide="tooltip" title="Update"><i class="fa fa-repeat"></i></a>
                  <a href="#" data-provide="tooltip" title="Settings"><i class="fa fa-gear"></i></a>
                </div>
              </div>

            </div>
          </li>
          <!-- END Notifications -->

          <!-- Messages -->
          <li class="dropdown d-none d-md-block">
            <span class="topbar-btn" data-toggle="dropdown"><i class="ti-email"></i></span>
            <div class="dropdown-menu dropdown-menu-right">

              <div class="media-list media-list-divided media-list-hover media-list-xs scrollable" style="height: 290px">
                <a class="media media-new" href="../page-app/mailbox-single.html">
                  <span class="avatar status-success">
                    <img src="../assets/img/avatar/1.jpg" alt="...">
                  </span>

                  <div class="media-body">
                    <p><strong>Maryam Amiri</strong> <time class="float-right" datetime="2017-07-14 20:00">23 min ago</time></p>
                    <p class="text-truncate">Authoritatively exploit resource maximizing technologies before technically.</p>
                  </div>
                </a>

                <a class="media media-new" href="../page-app/mailbox-single.html">
                  <span class="avatar status-warning">
                    <img src="../assets/img/avatar/2.jpg" alt="...">
                  </span>

                  <div class="media-body">
                    <p><strong>Hossein Shams</strong> <time class="float-right" datetime="2017-07-14 20:00">48 min ago</time></p>
                    <p class="text-truncate">Continually plagiarize efficient interfaces after bricks-and-clicks niches.</p>
                  </div>
                </a>

                <a class="media" href="../page-app/mailbox-single.html">
                  <span class="avatar status-dark">
                    <img src="../assets/img/avatar/3.jpg" alt="...">
                  </span>

                  <div class="media-body">
                    <p><strong>Helen Bennett</strong> <time class="float-right" datetime="2017-07-14 20:00">3 hours ago</time></p>
                    <p class="text-truncate">Objectively underwhelm cross-unit web-readiness before sticky outsourcing.</p>
                  </div>
                </a>

                <a class="media" href="../page-app/mailbox-single.html">
                  <span class="avatar status-success bg-purple">FT</span>

                  <div class="media-body">
                    <p><strong>Fidel Tonn</strong> <time class="float-right" datetime="2017-07-14 20:00">21 hours ago</time></p>
                    <p class="text-truncate">Interactively innovate transparent relationships with holistic infrastructures.</p>
                  </div>
                </a>

                <a class="media" href="../page-app/mailbox-single.html">
                  <span class="avatar status-danger">
                    <img src="../assets/img/avatar/4.jpg" alt="...">
                  </span>

                  <div class="media-body">
                    <p><strong>Freddie Arends</strong> <time class="float-right" datetime="2017-07-14 20:00">Yesterday</time></p>
                    <p class="text-truncate">Collaboratively visualize corporate initiatives for web-enabled value.</p>
                  </div>
                </a>

                <a class="media" href="../page-app/mailbox-single.html">
                  <span class="avatar status-success">
                    <img src="../assets/img/avatar/5.jpg" alt="...">
                  </span>

                  <div class="media-body">
                    <p><strong>Freddie Arends</strong> <time class="float-right" datetime="2017-07-14 20:00">Yesterday</time></p>
                    <p class="text-truncate">Interactively reinvent standards compliant supply chains through next-generation bandwidth.</p>
                  </div>
                </a>
              </div>

              <div class="dropdown-footer">
                <div class="left">
                  <a href="#">Read all messages</a>
                </div>

                <div class="right">
                  <a href="#" data-provide="tooltip" title="Mark all as read"><i class="fa fa-circle-o"></i></a>
                  <a href="#" data-provide="tooltip" title="Settings"><i class="fa fa-gear"></i></a>
                </div>
              </div>

            </div>
          </li>
          <!-- END Messages -->

        </ul>

      </div>
    </header>
    <!-- END Topbar -->


    <!-- Main container -->
    <main>

      <!-- Project header -->
      <header class="header mb-0 bg-ui-general">
          

          <div class="header-action center-h">
              <nav class="nav">
                  <a class="nav-link" href="">Profile</a>
                  <a class="nav-link" href="">Awards</a>
                  <a class="nav-link active" href="">Performance</a>                 
              </nav>
          </div>
      </header>
      <!--/.header -->



      <div class="main-content">

        <div class="row form-type-material">
          <div class="col-md-4"></div>
          <div class="col-md-4 content-centered">
            <img class="avatar avatar-xl" id="profile_img" src="../assets/img/avatar/2.jpg" alt="...">
            <h5>Hossein Shams</h5>
            <br/>
          </div>  
          <div class="col-md-4 text-right">
            <div class="form-group width-60">
              <select class="form-control">
                <option>Hossein Shams</option>
                <option>Todd Sperl</option>
                <option>Example User 1</option>
                <option>Example User 2</option>
                <option>Example User 3</option>
              </select>
              <label class="label-floated">Choose User: </label>
            </div>
          </div>
        </div>


        <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
          
            <div class="card card-slided-up">
              <header class="card-header">
                <h4 class="card-title"><strong>Statistics</strong></h4>
                <ul class="card-controls">
                  <li><a class="card-btn-close" href="#"></a></li>
                  <li><a class="card-btn-slide" href="#"></a></li>
                  <li><a class="card-btn-fullscreen" href="#"></a></li>
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
          
        </div><!-- End of col-md-6 --> 
        <div class="col-md-3"></div>
        </div> <!-- End Of Row -->





        <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
          
            <div class="card card-slided-up">
              <header class="card-header">
                <h4 class="card-title"><strong>Evaluation: 12/31/15</strong></h4>
                <ul class="card-controls">
                  <li><a class="card-btn-close" href="#"></a></li>
                  <li><a class="card-btn-slide" href="#"></a></li>
                  <li><a class="card-btn-fullscreen" href="#"></a></li>
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
          
        </div><!-- End of col-md-6 --> 
        <div class="col-md-3"></div>
        </div> <!-- End Of Row -->




        <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
          
            <div class="card card-slided-up">
              <header class="card-header">
                <h4 class="card-title"><strong>Comments: </strong></h4>
                <ul class="card-controls">
                  <li><a class="card-btn-close" href="#"></a></li>
                  <li><a class="card-btn-slide" href="#"></a></li>
                  <li><a class="card-btn-fullscreen" href="#"></a></li>
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
          
        </div><!-- End of col-md-6 --> 
        <div class="col-md-3"></div>
        </div> <!-- End Of Row -->






      </div><!--/.main-content -->


      <!-- Footer -->
      <footer class="site-footer">
        <div class="row">
          <div class="col-md-6">
            <p class="text-center text-md-left">Copyright © 2017 <a href="http://thetheme.io/theadmin">TheAdmin</a>. All rights reserved.</p>
          </div>

          <div class="col-md-6">
            <ul class="nav nav-primary nav-dotted nav-dot-separated justify-content-center justify-content-md-end">
              <li class="nav-item">
                <a class="nav-link" href="../help/articles.html">Documentation</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../help/faq.html">FAQ</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="https://themeforest.net/item/theadmin-responsive-bootstrap-4-admin-dashboard-webapp-template/20475359?license=regular&amp;open_purchase_for_item_id=20475359&amp;purchasable=source&amp;ref=thethemeio">Purchase Now</a>
              </li>
            </ul>
          </div>
        </div>
      </footer>
      <!-- END Footer -->

    </main>
    <!-- END Main container -->



    <!-- Global quickview -->
    <div id="qv-global" class="quickview" data-url="../assets/data/quickview-global.html">
      <div class="spinner-linear">
        <div class="line"></div>
      </div>
    </div>
    <!-- END Global quickview -->



    <!-- Scripts -->
    <script src="../assets/js/core.min.js"></script>
    <script src="../assets/js/app.min.js"></script>
    <script src="../assets/js/script.min.js"></script>
    <script src="../assets/plugins/ion_range_slider/js/ion-rangeSlider/ion.rangeSlider.min.js"></script>   

    <script type="text/javascript">
      $("#enthu, #comm, #part, #quality, #depend").ionRangeSlider({
          type: "single",
          min: 0,
          max: 100,
          from: 50,
          keyboard: true,
          onStart: function (data) {
              console.log("onStart");
          },
          onChange: function (data) {
              console.log("onChange");
          },
          onFinish: function (data) {
              console.log("onFinish");
          },
          onUpdate: function (data) {
              console.log("onUpdate");
          }
      });
    </script>

  </body>
</html>
