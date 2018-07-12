<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive admin dashboard and web application ui kit. ">
    <meta name="keywords" content="blank, starter">

    <title>Blank page &mdash; TheAdmin</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,300i" rel="stylesheet">

    <!-- Styles -->
    <link href="assets/css/core.min.css" rel="stylesheet">
    <link href="assets/css/app.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/plugins/dropzone/min/dropzone.min.css" rel="stylesheet" />

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="assets/img/apple-touch-icon.png">
    <link rel="icon" href="assets/img/favicon.png">
    <style type="text/css">
      
.min-width-350 {
  min-width: 350px;
}

.fixed-height-450 {
  height: 450px;
}

#wrapper {
    height: 500px;
    width: 100%;
    overflow-x:scroll;
    overflow-y:hidden; 
}

#container{
    width:200%;  
}

@media (min-width: 991px) and (max-width: 1329px) {

  #container{
      width: 300%;  
  }

}

#div2 :hover {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
  /*box-shadow: 0px 0px 8px 2px #CCCCCC inset;                 
    -moz-box-shadow: 0px 0px 8px 2px #CCCCCC inset;            
    -webkit-box-shadow: 0px 0px 8px 2px #CCCCCC inset;   */   
}

.inner-div-shadow-fix {
  box-shadow: none !important;
}

.card-style {
  padding: 3%;
  background-color: #E2E4E6;
  border-radius: 5px;
}

.cards-height-fix {
  max-height: 410px !important;
  overflow-y: scroll;
}

.rounded-image {
  height: 35px;
  border-radius: 25px;
}

.card-user-image-fix{
  float: right;
  padding-right: 8%;
}

.padding-3 {
  padding: 3%;
}

.height-500 {
  min-height: 500px;
}

.card-modal-fix {
  width: 150%;
  margin-left: -25%;
}

.display-block {
  display: block;
}

.display-flex {
  display: flex;
} 

.display-content {
  display: contents;
} 

.margin-left-0 {
  margin-left: 0% !important;
} 

.font-size-16 {
  font-size: 16px;
} 

.editor-fix {
  padding: 2%;
  background-color: white;
}

.fs-20 {
  font-size: 20px;
}

.fs-16 {
  font-size: 16px;
}

.fs-14 {
  font-size: 14px;
}

.fs-75 {
  font-size: 75px;
}

.ml-minus-30 {
  margin-left: -30px !important;
}

.ml-23-percent {
  margin-left: 23% !important;
}

.ml-47-percent {
  margin-left: 47% !important;
}

.ml-14 {
  margin-left: 14% !important;
}

.item-footer {
  display: flex;
  justify-content: space-between;
  margin: 0%;
}

.aside-dept-item-fix {
  min-height: 1.5rem !important;
  font-size: 16px;
}
.full-width {
  width: 100%;
}

.media-right > a, .text-uppercase > a, .aside-dept-item-fix > a {
  color: #707478;
}

.text-uppercase > a:hover, .aside-dept-item-fix a:hover{
  text-decoration: none !important;
  color: #242a30;
}

.mt-27 {
  margin-top: 27%;
}

.max-height-80 {
  max-height: 80px !important;
}

.margin-both-15 {
  margin-left: 15%;
  margin-right: 15%;
}


.department-list-scroll {
  height: 400px !important;
  overflow-y: scroll; 
}

.mr-2 {
  margin-right: 2% !important;
}

.margin-bottom-6 {
  margin-bottom: 6px;
}

.vl {
    border-left: 2px solid #A8A8A8;
    height: 128px;
    margin-left: 3%;
    margin-right: 3%;
}

::-webkit-scrollbar {
    width: 8px;
}

/* Track */
::-webkit-scrollbar-track {
    box-shadow: inset 0 0 5px grey; 
    border-radius: 10px;
}
 
/* Handle */
::-webkit-scrollbar-thumb {
    background: #A9A9A9; 
    border-radius: 10px;
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
    background: #A3A3A3; 
}

.file-preview-size {
  height: 75px !important;
  width: 75px !important;
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
      </div>

      <div class="topbar-right">
        <ul class="topbar-btns">

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

        </ul>

      </div>
    </header>
    <!-- END Topbar -->


    <!-- Main container -->
    <main>
      <div class="main-content">
        <div class="board-wrapper">
          <div class="board-scroller">
            <div class="">
                <div class="card">
                  <h4 class="card-title">Divided and hoverable</h4>
    
                  <div id="first" class="media-list media-list-divided media-list-hover">
                    <div class="media media-single">
                      <img class="avatar avatar-sm" src="assets/img/avatar/1.jpg" alt="...">
                      <span>Maryam Amiri</span>
                    </div>
    
                    <div class="media media-single">
                      <img class="avatar avatar-sm" src="assets/img/avatar/2.jpg" alt="...">
                      <span>Hossein Shams</span>
                    </div>
    
                    <div class="media media-single">
                      <img class="avatar avatar-sm" src="assets/img/avatar/3.jpg" alt="...">
                      <span>Sarah Conner</span>
                    </div>
    
                    <div class="media media-single">
                      <img class="avatar avatar-sm" src="assets/img/avatar/4.jpg" alt="...">
                      <span>Tim Hank</span>
                    </div>
    
                    <div class="media media-single">
                      <img class="avatar avatar-sm" src="assets/img/avatar/5.jpg" alt="...">
                      <span>Frank Camly</span>
                    </div>
                  </div>
                </div>
            </div>
            <div class="">
              <div class="card">
                <h4 class="card-title">Divided and hoverable</h4>
  
                <div id="second" class="media-list media-list-divided media-list-hover">
                  <div class="media media-single">
                    <img class="avatar avatar-sm" src="assets/img/avatar/1.jpg" alt="...">
                    <span>Maryam Amiri</span>
                  </div>
  
                  <div class="media media-single">
                    <img class="avatar avatar-sm" src="assets/img/avatar/2.jpg" alt="...">
                    <span>Hossein Shams</span>
                  </div>
  
                  <div class="media media-single">
                    <img class="avatar avatar-sm" src="assets/img/avatar/3.jpg" alt="...">
                    <span>Sarah Conner</span>
                  </div>
  
                  <div class="media media-single">
                    <img class="avatar avatar-sm" src="assets/img/avatar/4.jpg" alt="...">
                    <span>Tim Hank</span>
                  </div>
  
                  <div class="media media-single">
                    <img class="avatar avatar-sm" src="assets/img/avatar/5.jpg" alt="...">
                    <span>Frank Camly</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="">
              <div class="card">
                <h4 class="card-title">Divided and hoverable</h4>
  
                <div id="third" class="media-list media-list-divided media-list-hover">
                  <div class="media media-single">
                    <img class="avatar avatar-sm" src="assets/img/avatar/1.jpg" alt="...">
                    <span>Maryam Amiri</span>
                  </div>
  
                  <div class="media media-single">
                    <img class="avatar avatar-sm" src="assets/img/avatar/2.jpg" alt="...">
                    <span>Hossein Shams</span>
                  </div>
  
                  <div class="media media-single">
                    <img class="avatar avatar-sm" src="assets/img/avatar/3.jpg" alt="...">
                    <span>Sarah Conner</span>
                  </div>
  
                  <div class="media media-single">
                    <img class="avatar avatar-sm" src="assets/img/avatar/4.jpg" alt="...">
                    <span>Tim Hank</span>
                  </div>
  
                  <div class="media media-single">
                    <img class="avatar avatar-sm" src="assets/img/avatar/5.jpg" alt="...">
                    <span>Frank Camly</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="">
                <div class="card">
                  <h4 class="card-title">Divided and hoverable</h4>
    
                  <div id="second" class="media-list media-list-divided media-list-hover">
                    <div class="media media-single">
                      <img class="avatar avatar-sm" src="assets/img/avatar/1.jpg" alt="...">
                      <span>Maryam Amiri</span>
                    </div>
    
                    <div class="media media-single">
                      <img class="avatar avatar-sm" src="assets/img/avatar/2.jpg" alt="...">
                      <span>Hossein Shams</span>
                    </div>
    
                    <div class="media media-single">
                      <img class="avatar avatar-sm" src="assets/img/avatar/3.jpg" alt="...">
                      <span>Sarah Conner</span>
                    </div>
    
                    <div class="media media-single">
                      <img class="avatar avatar-sm" src="assets/img/avatar/4.jpg" alt="...">
                      <span>Tim Hank</span>
                    </div>
    
                    <div class="media media-single">
                      <img class="avatar avatar-sm" src="assets/img/avatar/5.jpg" alt="...">
                      <span>Frank Camly</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="">
                <div class="card">
                  <h4 class="card-title">Divided and hoverable</h4>
    
                  <div id="third" class="media-list media-list-divided media-list-hover">
                    <div class="media media-single">
                      <img class="avatar avatar-sm" src="assets/img/avatar/1.jpg" alt="...">
                      <span>Maryam Amiri</span>
                    </div>
    
                    <div class="media media-single">
                      <img class="avatar avatar-sm" src="assets/img/avatar/2.jpg" alt="...">
                      <span>Hossein Shams</span>
                    </div>
    
                    <div class="media media-single">
                      <img class="avatar avatar-sm" src="assets/img/avatar/3.jpg" alt="...">
                      <span>Sarah Conner</span>
                    </div>
    
                    <div class="media media-single">
                      <img class="avatar avatar-sm" src="assets/img/avatar/4.jpg" alt="...">
                      <span>Tim Hank</span>
                    </div>
    
                    <div class="media media-single">
                      <img class="avatar avatar-sm" src="assets/img/avatar/5.jpg" alt="...">
                      <span>Frank Camly</span>
                    </div>
                  </div>
                </div>
              </div>
          </div>
        </div>
      </div><!--/.main-content -->



      <button id="btn1" class="btn" data-toggle="modal" data-target="#modal-large" onclick="modalOpen()">Modal</button>



      <!-- Card modal Content starts -->
      <div class="modal fade" id="modal-large">
        <div class="modal-dialog modal-lg">
          <div class="modal-content height-auto modal-back-color">
            <!-- Modal Header Ends -->
            <div class="modal-header display-block">
            <div class="col-md-12">
              <div class="row display-flex" >
                <div class="col-md-8">
                  <h4 class="modal-title">#1 Action Item Page - Drag & Drop UI View</h4>
                </div>
                <div class="col-md-4">
                  <button type="button" class="modal-close-btn close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
              </div>
            </div>
            </div>
            <!-- Modal Header Ends -->
              
              
            
            <!-- Modal Body Starts -->
            <div class="modal-body font-size-16">

              <div class="col-md-12 display-flex">
                <div class="col-md-9">

                  <div class="form-group">
                    <label class="col-form-label ">Title</label>
                    <br/>
                    <div class="">
                      <input type="text" class="form-control" value="Action Item Page - Drag & Drop UI View" />
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-form-label ">Description</label>
                    <br/>
                    <div class="">
                      <textarea class="form-control" rows="3"></textarea>
                    </div>
                  </div>

                  <hr/>

                  <div class="row display-content">
                    <h5>in List <u>On Progress</u></h5>
                  </div>

                  <div class="row display-content">
                    <h5>Members</h5>
                  </div>

                  <div class="row margin-left-0">
                    
                      <div class="image">
                        <img src="assets1/img/user/user-13.jpg" class="rounded-image" alt="" />
                      </div>
                      &nbsp;&nbsp;
                      <div class="image">
                        <img src="assets1/img/user/user-13.jpg" class="rounded-image" alt="" />
                      </div>
                    
                  </div>

                  <hr/>

                  <div class="form-group">
                    <label class="col-form-label">Attachments</label>
                    <!-- <div id="dropzone"> -->
                    <form action="https://seantheme.com/upload" class="dropzone needsclick" id="demo-upload">
                        <div class="dz-message needsclick">
                          Drop files <b>here</b> or <b>click</b> to upload.<br />
                            <span class="dz-note needsclick">
                                (This is just a demo dropzone. Selected files are <strong>not</strong> actually uploaded.)
                            </span>
                        </div>
                    </form>
                  </div>


                  <div class="card" style="border: 1px solid #ebebeb; background-color: #f9fafb;">
                    

                    <div class="media-list media-list-divided">
                      <div class="media media-single">
                        <div class="col-md-9">
                        <img class="avatar avatar-sm file-preview-size" src="../assets/img/avatar/1.jpg" alt="...">
                        <span> &nbsp;file1.jpg</span>
                        </div>
                        <div class="col-md-3">
                        <p class="gap-items">
                          <small>Size: 80kb</small>
                          <small>Type: jpg</small>
                        </p>
                        </div>
                      </div>

                      <div class="media media-single">
                        <div class="col-md-9">
                        <img class="avatar avatar-sm file-preview-size" src="../assets/img/avatar/2.jpg" alt="...">
                        <span> &nbsp;file2.jpg</span>
                        </div>
                        <div class="col-md-3">
                        <p class="gap-items">
                          <small>Size: 60kb</small>
                          <small>Type: jpg</small>
                        </p>
                        </div>
                      </div>                      
                     
                    </div>
                  </div>
                  

                  <!-- <div class="form-group">
                    <label class="col-form-label ">Ui element</label>
                    <br/>
                    <div>                     
                      <div class="progress">
                        <div id="progress_bar_1" class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" 
                        aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%"></div>
                      </div>
                    </div>
                    <div class="checkbox checkbox-css">
                        <input type="checkbox" class="chkbox" id="cssCheckbox1" value="1" checked />
                        <label for="cssCheckbox1">CSS Checkbox Label 1</label>
                    </div>
                    <div class="checkbox checkbox-css">
                        <input type="checkbox" class="chkbox" id="cssCheckbox2" value="2"/>
                        <label for="cssCheckbox2">CSS Checkbox Label 2</label>
                    </div>
                  </div> -->

                  <!-- <div class="form-group">
                    <label class="col-form-label ">Add comment</label>
                    <br/>
                    <form action="https://seantheme.com/" name="wysihtml5" method="POST" class="editor-fix">
                      <textarea class="textarea form-control" id="wysihtml5" placeholder="Enter text ..." rows="5"></textarea>
                    </form>
                  </div> -->

                  <!-- <div class="form-group">
                    <label class="col-form-label ">Add comment</label>
                    <br/>
                    <div class="">
                      <textarea data-provide="summernote" data-min-height="150"></textarea>
                    </div>
                  </div> -->

              <hr/>    
              <div class="code-preview">
                <div class="publisher publisher-multi">
                  <textarea class="publisher-input" rows="3" placeholder="Add Comments"></textarea>
                  <div class="flexbox">
                    <div class="gap-items">
                      <span class="publisher-btn file-group">
                        <i class="fa fa-paperclip file-browser"></i>
                        <input type="file">
                      </span>
                      <a class="publisher-btn" href="#"><i class="fa fa-map-marker"></i></a>
                      <a class="publisher-btn" href="#"><i class="fa fa-smile-o"></i></a>
                    </div>

                    <button class="btn btn-sm btn-bold btn-primary">Post</button>
                  </div>
                </div>
              </div>

              <div class="media-list media-list-divided bg-lighter" style="border: 1px solid #ebebeb;">
                <div class="media">
                  <a class="avatar" href="#">
                    <img src="../assets/img/avatar/4.jpg" alt="...">
                  </a>
                  <div class="media-body">
                    <p>
                      <a href="#"><strong>Frank Camley</strong></a>
                      <time class="float-right text-fade" datetime="2017-07-14 20:00">Just now</time>
                    </p>
                    <p>Uniquely enhance world-class channels with just in time schemas.</p>                    
                  </div>
                </div>

                <div class="media">
                  <a class="avatar" href="#">
                    <img src="../assets/img/avatar/5.jpg" alt="...">
                  </a>
                  <div class="media-body">
                    <p>
                      <a href="#"><strong>Tim Hank</strong></a>
                      <time class="float-right text-fade" datetime="2017-07-14 20:00">2 hours ago</time>
                    </p>
                    <p>Continually drive user friendly solutions through performance based infomediaries.</p>
                  </div>
                </div>
              </div>

                
                </div>
                <div class="col-md-3">

                  <div class="col-md-12 margin-bottom-6">
                    <label class="col-form-label ">Add</label>
                  </div>
                  <div class="col-md-12 margin-bottom-6">
                    <a href="javascript:;" class="btn btn-primary btn-block m-b-5">Members</a>
                  </div>
                  <div class="col-md-12 margin-bottom-6">
                    <a href="javascript:;" class="btn btn-primary btn-block m-b-5">Labels</a>
                  </div>                  
                  <div class="col-md-12">
                    <a href="javascript:;" class="btn btn-primary btn-block m-b-5">Attachment</a>
                  </div>

                  <br/>
                  
                  <div class="col-md-12">
                    <label class="col-form-label ">Actions</label>
                  </div>
                  <div class="col-md-12 margin-bottom-6">
                    <a href="javascript:;" class="btn btn-primary btn-block m-b-5">Move</a>
                  </div>
                  <div class="col-md-12 margin-bottom-6">
                    <a href="javascript:;" class="btn btn-primary btn-block m-b-5">Copy</a>
                  </div>
                  <div class="col-md-12 margin-bottom-6">
                    <a href="javascript:;" class="btn btn-primary btn-block m-b-5">Watch</a>
                  </div>
                  

                </div>
              </div>
              
              
            </div>
            <!-- Modal Body Ends -->
            <div class="modal-footer">
              <a href="javascript:;" class="btn btn-white modal-close-btn" data-dismiss="modal">Close</a>
              <a href="javascript:;" class="btn btn-danger" data-dismiss="modal">Action</a>
            </div>
          </div>
        </div>
      </div>
                        <!-- Card modal Content starts -->



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
    <div id="qv-global" class="quickview" data-url="assets/data/quickview-global.html">
      <div class="spinner-linear">
        <div class="line"></div>
      </div>
    </div>
    <!-- END Global quickview -->



    <!-- Scripts -->
    <script src="assets/js/core.min.js"></script>
    <script src="assets/js/app.min.js"></script>
    <script src="assets/js/script.min.js"></script>
    <script src="assets/plugins/dropzone/min/dropzone.min.js"></script>

    <!-- Dragula dependencies -->

    <link rel="stylesheet" href="assets/vendor/dragula/dragula.min.css">
    <script src="assets/vendor/dragula/dragula.min.js"></script>

    <script src="assets/vendor/dom-autoscroller/dom-autoscroller.min.js"></script>




  
  <!-- ================== END PAGE LEVEL JS ================== -->
  <script>
    $(document).ready(function() {
      // App.init();
      // Highlight.init();
      // FormWysihtml5.init();
      var ckbox = $('.chkbox');

      var totalCheckbox =$(".chkbox").length;
      var totalCheckedCheckbox =$(".chkbox:checked").length;
      console.log(totalCheckedCheckbox);
      console.log(totalCheckbox);
      var checkPercentage = (totalCheckedCheckbox * 100)/totalCheckbox;
      console.log(checkPercentage);
      // $('#progress_bar_1').removeAttr("aria-valuenow");
      //     $('#progress_bar_1').attr('aria-valuenow',checkPercentage);
      $('#progress_bar_1').removeAttr("style");
      $('#progress_bar_1').attr('style','width:'+checkPercentage+"% ;");

      $('.chkbox').on('click',function () {
        var numItems =$(".chkbox:checked").length;
        console.log(numItems);

        var totalCheckbox =$(".chkbox").length;
        var totalCheckedCheckbox =$(".chkbox:checked").length;
        console.log(totalCheckedCheckbox);
        console.log(totalCheckbox);
        var checkPercentage = (totalCheckedCheckbox * 100)/totalCheckbox;
        console.log(checkPercentage);

            if (ckbox.is(':checked')) {
                $('#progress_bar_1').removeAttr("style");
                $('#progress_bar_1').attr('style','width:'+checkPercentage+"% ;");
            } else {
              $('#progress_bar_1').removeAttr("style");
                $('#progress_bar_1').attr('style','width:'+checkPercentage+"% ;");
            }

        });

    });
  </script>
<script>
  

      jQuery(function($) {
        $('#card-style').hover(function() {
           //$(this).children('div').addClass(drop'inner-div-shadow-fix');
           $("div > div","#card-style").addClass('inner-div-shadow-fix');
           $(".shadow-fix").addClass('inner-div-shadow-fix');
           console.log("hello");
        },function() {
           $(this).children('div').removeClass('inner-div-shadow-fix');
        });
      });


    $( "#card-desc-modal" ).on('shown', function(){
        alert("I want this to appear after the modal has opened!");
    });
 
    function modalOpen()
    {
      Dropzone.autoDiscover = false;
      console.log("modal opened");
      $(".dropzone").dropzone({
        url: "https://seantheme.com/upload",
          init: function() {
              var $this = this;
              $(".modal-close-btn").click(function() { //button#clear-dropzone
                  $this.removeAllFiles(true);
              });
          },
      
      });

    }

    $(".modal-close-btn").on(click, function (e){
      Dropzone.removeFile(file);  
    }); 
    


</script>






    <!-- Demo dragula script-->
    <script>
      var drake = dragula(
        $('.board-scroller .media-list').get()
      );

      var scroll = autoScroll([
        document.querySelector('.board-wrapper')
    ],{
    direction: 'horizontal',
    margin: 20,
    pixels: 10,
    maxSpeed: 25,
    scrollWhenOutside: true,
    autoScroll: function(){
        return this.down && drake.dragging;
    }
});

    </script>

  </body>
</html>
