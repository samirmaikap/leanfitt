@extends('layouts.app')
@section('content')
    <main>
        <header class="header no-border">
            <div class="header-bar">
                <h4>Report Name</h4>
            </div>
        </header>
        <div class="main-content">
            <div class="row">
                {{--@include('app.projects.reports.chart')--}}
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="pull-left"><h3>Datasets</h3></div>
                            <div class="pull-right">
                                <button class="btn btn-success btn-square btn-round" title="New Dataset"><i class="fe fe-plus"></i></button>
                                <button class="btn btn-success btn-square btn-round" title="Change Axis"><i class="fe fe-edit-2"></i></button>
                            </div>

                        </div>
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>Label</th>
                                <th>Value</th>
                                <th class="w-80px text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Template PSD</td>
                                <td>45</td>
                                <td>
                                    <nav class="nav no-gutters gap-2 fs-16">
                                        <a class="nav-link hover-primary" href="#" data-provide="tooltip" title="Edit"><i class="ti-pencil"></i></a>
                                        <a class="nav-link hover-danger" href="#" data-provide="tooltip" title="Delete"><i class="ti-trash"></i></a>
                                    </nav>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection