@extends('layouts.app')
@section('content')
    <main class="main-container">
        <header class="header mb-0 bg-ui-general">

            <div class="header-bar center-h">
                <h4 class="text-dark">Projetc Nmae</h4>
            </div>
            <div class="header-action center-h">
                <nav class="nav">
                    <a class="nav-link active" href="">Details</a>
                    <a class="nav-link" href="">KPI</a>
                    <a class="nav-link" href="">Action Items</a>
                    <a class="nav-link" href="">Reports</a>
                </nav>
            </div>
        </header>
        <div class="main-content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row doc-btn-spacing">
                                <div class="col-md-12">
                                   <div class="media">
                                       <div class="media-body text-center">
                                           <h3><strong>Project Name</strong></h3>
                                           <p>Continually plagiarize efficient interfaces after bricks-and-clicks niches.</p>
                                           <p>Start Date: 01/01/2011</p>
                                           <p>End Date: 01/01/2011</p>
                                           <p>Report Date: 01/01/2011</p>
                                           <p>Status: <span class="text-success">Ongoing</span></p>
                                       </div>
                                   </div>
                                    <div class="media">
                                        <div class="media-body text-center">
                                            <button class="btn btn-w-md btn-primary">Edit</button>
                                            <button class="btn btn-w-lg btn-success">Mark Complete</button>
                                            <button class="btn btn-w-md btn-warning">Archive</button>
                                            <button class="btn btn-w-md btn-danger">Delete</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="divider fs-16">Members</div>
                                </div>
                                <div class="col-md-12 text-center">
                                    <a class="avatar avatar-xl status-success">
                                        <img src="../assets/img/avatar/1.jpg">
                                    </a>
                                    <a class="avatar avatar-xl status-warning">
                                        <img src="../assets/img/avatar/1.jpg">
                                    </a>
                                    <a class="avatar avatar-xl">
                                        <img src="../assets/img/avatar/1.jpg">
                                    </a>
                                    <a class="avatar avatar-xl">
                                        <img src="../assets/img/avatar/1.jpg">
                                    </a>
                                    <a class="avatar avatar-add avatar-xl" id="add-avatar-btn" href="#" data-provide="modaler" data-url="../assets/data/avatars-add-modal.html" data-is-modal="true" data-on-confirm="addAvatars"></a>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{--<div class="col-lg-4">--}}
                    {{--<div class="card">--}}
                        {{--<h5 class="card-title"><strong>Project activity</strong></h5>--}}

                        {{--<div class="media-list media-list-hover media-list-divided">--}}
                            {{--<div class="media">--}}
                                {{--<a class="align-self-center" href="#"><img class="avatar" src="../assets/img/avatar/1.jpg" alt="..."></a>--}}
                                {{--<div class="media-body">--}}
                                    {{--<p>--}}
                                        {{--<a class="hover-primary" href="#"><strong>Maryam Amiri</strong></a>--}}
                                        {{--<time class="float-right" datetime="2018-07-14 20:00">24 min ago</time>--}}
                                    {{--</p>--}}
                                    {{--<p>Updated his profile picture.</p>--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            {{--<div class="media">--}}
                                {{--<a class="align-self-center" href="#"><img class="avatar" src="../assets/img/avatar/2.jpg" alt="..."></a>--}}
                                {{--<div class="media-body">--}}
                                    {{--<p>--}}
                                        {{--<a class="hover-primary" href="#"><strong>Hossein Shams</strong></a>--}}
                                        {{--<time class="float-right" datetime="2018-07-14 20:00">2 hours ago</time>--}}
                                    {{--</p>--}}
                                    {{--<p>Joined a conference at San Francisco.</p>--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            {{--<div class="media">--}}
                                {{--<a class="align-self-center" href="#"><img class="avatar" src="../assets/img/avatar/3.jpg" alt="..."></a>--}}
                                {{--<div class="media-body">--}}
                                    {{--<p>--}}
                                        {{--<a class="hover-primary" href="#"><strong>Ashley Hank</strong></a>--}}
                                        {{--<time class="float-right" datetime="2018-07-14 20:00">5 hours ago</time>--}}
                                    {{--</p>--}}
                                    {{--<p>Created a <a href="#">changelog</a> page in the wiki.</p>--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            {{--<div class="media">--}}
                                {{--<a class="align-self-center" href="#"><img class="avatar" src="../assets/img/avatar/4.jpg" alt="..."></a>--}}
                                {{--<div class="media-body">--}}
                                    {{--<p>--}}
                                        {{--<a class="hover-primary" href="#"><strong>Frank Camly</strong></a>--}}
                                        {{--<time class="float-right" datetime="2018-07-14 20:00">Yesterday</time>--}}
                                    {{--</p>--}}
                                    {{--<p>Got a 3 hours off from work.</p>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            </div>
        </div>
    </main>
@endsection