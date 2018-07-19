@extends('layouts.app')
@section('content')
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
@endsection