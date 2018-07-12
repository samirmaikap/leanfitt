@extends('layouts.app')
@section('content')
    <main>
        @include('app.projects.partials.header')
        <div class="main-content">

            @foreach($kpiSet as $kpi)

                <div class="card">
                <h4 class="card-title fw-400 text-center">{{ $kpi->title }} </h4>
                <div class="card-body">
                    <div class="kpi-chart-container">
                        <canvas id="kpi-chart-{{ $kpi->id }}"></canvas>
                    </div>
                    <div class="accordion" id="accordion-{{ $kpi->id }}">
                        <div class="card">
                            <h5 class="card-title">
                                <a data-toggle="collapse" data-parent="#accordion-1" href="#collapse-1-1"
                                   aria-expanded="false" class="collapsed">
                                    KPI Details
                                </a>
                            </h5>

                            <div id="collapse-{{ $kpi->id }}-1" class="collapse" style="">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3"></div>
                                        <div class="col-md-6">
                                            <form id="update-kpi-form" action="{{ url("") }}" method="post">
                                                {{ csrf_field() }}
                                                {{ method_field('put') }}
                                                <input type="hidden" name="project_id" value="{{ $project["id"] }}">

                                                <div class="form-group">
                                                    <label>Title</label>
                                                    <input class="form-control" type="text" name="title" value="{{ $kpi->title }}">
                                                </div>

                                                <div class="form-group">
                                                    <label>Description</label>
                                                    <textarea class="form-control" type="text" name="description">

                                                    </textarea>
                                                </div>

                                                <hr>

                                                <div class="form-group">
                                                    <label>X-Axis Label</label>
                                                    <input class="form-control" type="text" name="x_label" value="{{ $kpi->x_label }}">
                                                </div>

                                                <div class="form-group">
                                                    <label>Y-Axis Label</label>
                                                    <input class="form-control" type="text" name="y_label" value="{{ $kpi->y_label }}">
                                                </div>

                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label>Start Date</label>
                                                            <input class="form-control" type="text" name="start_date" data-provide="datepicker" value="{{ date('m/d/Y', strtotime($kpi->start_date)) }}">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>End Date</label>
                                                            <input class="form-control" type="text" name="end_date" data-provide="datepicker"  value="{{ date('m/d/Y', strtotime($kpi->end_date)) }}">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <button class="btn btn-primary btn-block" type="submit">Save</button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-md-3"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <h5 class="card-title">
                                <a data-toggle="collapse" data-parent="#accordion-{{ $kpi->id }}" href="#collapse-1-2" class=""
                                   aria-expanded="true">
                                    KPI Data Points
                                </a>
                            </h5>

                            <div id="collapse-{{ $kpi->id }}-2" class="collapse show" style="">
                                <div class="card-body">
                                    <table id="kpi-data-points-table" class="table" cellspacing="0">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{ $kpi->x_label }}</th>
                                            <th>{{ $kpi->y_label }}</th>
                                            <th>Timestamp</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr class="editable">
                                            <form id="kpi-data-0" action="{{ url('kpi/'. $kpi["id"]) . '/data' }}" method="post">
                                                {{ method_field('post') }}
                                                {{ csrf_field() }}
                                                <input type="hidden" name="kpi_chart_id" value="{{ $kpi->id }}">
                                                <input type="hidden" name="created_by" value="{{ 1 }}">
                                                <td>1</td>
                                                <td>
                                                    <input type="text" name="x_value" value="">
                                                </td>
                                                <td>
                                                    <input type="text" name="y_value"  value="">
                                                </td>
                                                <td></td>
                                                <td>
                                                    <nav class="nav no-gutters">
                                                        <a class="nav-link hover-primary" href="#"
                                                           data-provide="tooltip" title=""
                                                           data-original-title="Save"
                                                           onclick="submitForm('#kpi-data-0', 'post')">
                                                            <i class="ti-save"></i>
                                                        </a>
                                                    </nav>
                                                </td>
                                            </form>
                                        </tr>
                                        <tr>
                                            <form id="kpi-data-{{ $kpi->id }}" action="{{ url('kpi/'. $kpi["id"] . '/data/') }}" method="post">
                                                {{ method_field('put') }}
                                                {{ csrf_field() }}
                                                <td>1</td>
                                                <td>
                                                    <input type="text" name="x_value" value="adad" readonly>
                                                </td>
                                                <td>
                                                    <input type="text" name="y_value"  value="a434" readonly>
                                                </td>
                                                <td>{{ date('m/d/Y h:i A', strtotime('07/12/2018')) }}</td>
                                                <td>
                                                    {{--<nav class="nav no-gutters primary-action-group">--}}
                                                        {{--<a class="nav-link hover-primary" href="#"--}}
                                                           {{--data-provide="tooltip" title="" data-original-title="Edit"--}}
                                                           {{--onclick="editDataPoint(this)">--}}
                                                            {{--<i class="ti-pencil"></i>--}}
                                                        {{--</a>--}}
                                                        {{--<a class="nav-link hover-danger" href="#"--}}
                                                           {{--data-provide="tooltip" title=""--}}
                                                           {{--data-original-title="Delete"--}}
                                                           {{--onclick="submitForm('#kpi-data-1', 'delete')">--}}
                                                            {{--<i class="ti-trash"></i>--}}
                                                        {{--</a>--}}
                                                    {{--</nav>--}}

                                                    {{--<nav class="nav no-gutters edit-action-group">--}}
                                                        {{--<a class="nav-link hover-primary" href="#"--}}
                                                           {{--data-provide="tooltip" title=""--}}
                                                           {{--data-original-title="Save"--}}
                                                           {{--onclick="submitForm('#kpi-data-2', 'put')">--}}
                                                            {{--<i class="ti-save"></i>--}}
                                                        {{--</a>--}}
                                                        {{--<a class="nav-link hover-gray" href="#" data-provide="tooltip"--}}
                                                           {{--title="" data-original-title="Cancel"--}}
                                                            {{--onclick="cancelEditingDataPoint(this)">--}}
                                                            {{--<i class="ti-close"></i>--}}
                                                        {{--</a>--}}
                                                    {{--</nav>--}}
                                                </td>
                                            </form>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @endforeach
        </div>
    </main>

    <div class="fab fab-fixed">
        <a class="btn btn-float btn-primary" href="#add-kpi-modal" title="Add New KPI"
           data-provide="tooltip" data-toggle="modal">
            <i class="ti-plus"></i>
        </a>
    </div>

    @include('app.projects.partials.add-kpi-modal')

    <script>
        window.onload = function () {

            // ==============================================
            // Line chart
            //
            new Chart($("#chart"), {
                type: 'line',
//                responsive: true,
//                maintainAspectRatio: true,
                // Data
                //
                data: {
                    labels: ["January", "February", "March", "April"],
                    datasets: [
                        {
                            label: "Revenue",
                            fill: false,
                            borderWidth: 3,
                            pointRadius: 5,
                            borderColor: "#9966ff",
                            pointBackgroundColor: "#9966ff",
                            pointBorderColor: "#9966ff",
                            pointHoverBackgroundColor: "#fff",
                            pointHoverBorderColor: "#9966ff",
                            data: [30, 25, 35, 23]
                        }
                    ]
                },

                // Options
                //
                options: {
                    legend: {
                        display: false
                    },
                }
            });
        };

        function editDataPoint(element) {
            console.log($(element).parents('tr'));
            $(element).parents('tr').addClass('editable').find('input').removeAttr('readonly');
            $(element).parents('tr').find()
        }

        function cancelEditingDataPoint(element) {
            console.log($(element).parents('tr'));
            $(element).parents('tr').removeClass('editable').find('input').attr('readonly', 'true');
        }
    </script>

@endsection