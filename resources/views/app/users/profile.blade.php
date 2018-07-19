@extends('layouts.app')
@section('content')
  <main>

    <!-- Project header -->
    <header class="header mb-0 bg-ui-general">


      <div class="header-action center-h">
        <nav class="nav">
          <a class="nav-link active" href="">Profile</a>
          <a class="nav-link" href="">Awards</a>
          <a class="nav-link" href="">Performance</a>
        </nav>
      </div>
    </header>
    <!--/.header -->



    <div class="main-content" >

      <div class="col-12">
        <div class="col-md-3"></div>
        <div class="col-md-6">
          <form class="card">
            <h4 class="card-title fw-400">Account Settings</h4>



            <div class="card-body">
              <button class="btn btn-block btn-round btn-bold btn-primary" type="submit">Save</button>
            </div>

          </form>
        </div><!-- End of col-md-6 -->
        <div class="col-md-3"></div>
      </div>


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
@endsection
