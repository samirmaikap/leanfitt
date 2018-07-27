@extends('layouts.app')
@section('content')
    <main>
        @include('app.projects.partials.header')
        <div class="main-content">

            @if(count($kpiSet) > 0)
                @foreach($kpiSet as $index => $kpi)
                    @include('app.projects.partials.kpi-modal')
                    <div class="card">
                        <a href="#kpi-{{ $kpi->id }}-modal" data-toggle="modal">
                            <h4 class="card-title fw-400 text-center">
                                {{ $kpi->title }}
                            </h4>
                        </a>
                        <div class="card-body">
                            @if(count($kpi->data))
                                <div class="kpi-chart-container">
                                    <canvas id="kpi-{{ $kpi->id }}-chart"></canvas>

                                    @php
                                        $kpiSet[$index]->dataset = [
                                            'x_value' => $kpi->data->pluck('x_value')->toArray(),
                                            'y_value' => $kpi->data->pluck('y_value')->toArray()
                                        ];
                                    @endphp
                                </div>
                            @endif

                            <div class="panel">
                                <h5 class="panel-heading">
                                    KPI Data Points
                                </h5>

                                <div class="panel-body">
                                    <table id="kpi-{{ $kpi->id }}-data-table" class="table kpi-data-table" cellspacing="0">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{ $kpi->x_label }} </th>
                                            <th>{{ $kpi->y_label }}</th>
                                            <th>Timestamp</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr class="editable">
                                            <form id="kpi-{{ $kpi->id }}-data-0" action="{{ url('kpi/'. $kpi["id"]) . '/data' }}" method="post">
                                                {{ method_field('post') }}
                                                {{ csrf_field() }}
                                                <input type="hidden" name="kpi_chart_id" value="{{ $kpi->id }}">
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
                                                           onclick="submitForm('#kpi-{{ $kpi->id }}-data-0', 'post')">
                                                            <i class="ti-save"></i>
                                                        </a>
                                                    </nav>
                                                </td>
                                            </form>
                                        </tr>
                                        @if(isset($kpi->data) && count($kpi->data))
                                            @foreach($kpi->data as $data)
                                                <tr>
                                                    <form id="kpi-{{ $kpi->id }}-data-{{ $data->id }}" action="{{ url('kpi/'. $kpi["id"] . '/data/' . $data->id) }}" method="post">
                                                        {{ method_field('put') }}
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="kpi_chart_id" value="{{ $kpi->id }}">
                                                        <td>{{ $data->id }}</td>
                                                        <td>
                                                            <input type="text" name="x_value" value="{{ $data->x_value }}" readonly>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="y_value"  value="{{ $data->y_value }}" readonly>
                                                        </td>
                                                        <td>{{ date('m/d/Y h:i A', strtotime($data->created_at)) }}</td>
                                                        <td>
                                                            <nav class="nav no-gutters primary-action-group">
                                                                <a class="nav-link hover-primary" href="#"
                                                                   data-provide="tooltip" title="" data-original-title="Edit"
                                                                   onclick="editDataPoint(this)">
                                                                    <i class="ti-pencil"></i>
                                                                </a>
                                                                <a class="nav-link hover-danger" href="#"
                                                                   data-provide="tooltip" title=""
                                                                   data-original-title="Delete"
                                                                   onclick="submitForm('#kpi-{{ $kpi->id }}-data-{{ $data->id }}', 'delete')">
                                                                    <i class="ti-trash"></i>
                                                                </a>
                                                            </nav>

                                                            <nav class="nav no-gutters edit-action-group">
                                                                <a class="nav-link hover-primary" href="#"
                                                                   data-provide="tooltip" title=""
                                                                   data-original-title="Save"
                                                                   onclick="submitForm('#kpi-{{ $kpi->id }}-data-{{ $data->id }}', 'put')">
                                                                    <i class="ti-save"></i>
                                                                </a>
                                                                <a class="nav-link hover-gray" href="#" data-provide="tooltip"
                                                                   title="" data-original-title="Cancel"
                                                                   onclick="cancelEditingDataPoint(this)">
                                                                    <i class="ti-close"></i>
                                                                </a>
                                                            </nav>
                                                        </td>
                                                    </form>
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <h3 class="text-dark d-block text-center py-20">No kpi available</h3>
            @endif
        </div>
    </main>

    @if(!isSuperadmin())
        <div class="fab fab-fixed">
            <a class="btn btn-float btn-primary" href="#kpi-0-modal" title="Add New KPI"
               data-provide="tooltip" data-toggle="modal">
                <i class="ti-plus"></i>
            </a>
        </div>
    @endif

    @include('app.projects.partials.kpi-modal', ['kpi' => null])

    <script>
        window.onload = function () {

            var jsonString = '{!! json_encode($kpiSet) !!}';
            console.log(jsonString);
            var kpiSet = JSON.parse(jsonString);
            console.log(kpiSet);

            $.each(kpiSet, function (index, kpi) {

                if(kpi.data.length == 0)
                    return;

                // ==============================================
                // Line chart
                //
                new Chart($("#kpi-" + kpi.id + "-chart"), {
                    type: 'line',
//                responsive: true,
//                maintainAspectRatio: true,
                    // Data
                    //
                    data: {
                        labels: kpi.dataset.x_value, //["January", "February", "March", "April"],
                        datasets: [
                            {
                                label: kpi.title, //"Revenue",
                                fill: false,
                                borderWidth: 3,
                                pointRadius: 5,
                                borderColor: "#9966ff",
                                pointBackgroundColor: "#9966ff",
                                pointBorderColor: "#9966ff",
                                pointHoverBackgroundColor: "#fff",
                                pointHoverBorderColor: "#9966ff",
                                data: kpi.dataset.y_value, //[30, 25, 35, 23]
                            }
                        ]
                    },

                    // Options
                    //
                    options: {
                        legend: {
                            display: false
                        },
                        scales: {
                            yAxes: [{
                                scaleLabel: {
                                    display: true,
                                    labelString: kpi.y_label
                                }
                            }],
                            xAxes: [{
                                scaleLabel: {
                                    display: true,
                                    labelString: kpi.x_label
                                }
                            }]
                        }
                    }
                });
            });



            window.onscroll = function () {

                $('.accordion').each(function (index, element) {
                    var isElementInView = Utils.isElementInView(element, true);

                    if (isElementInView) {
                        console.log('in view');
                        Utils.scrollTo($(element).attr('id'));
                    } else {
                        console.log('out of view');
                    }
                });

            }
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

    <script>
        function Utils() {

        }

        Utils.prototype = {
            constructor: Utils,
            isElementInView: function (element, fullyInView) {
                var pageTop = $(window).scrollTop();
                var pageBottom = pageTop + $(window).height();
                var elementTop = $(element).offset().top;
                var elementBottom = elementTop + $(element).height();

                if (fullyInView === true) {
                    return ((pageTop < elementTop) && (pageBottom > elementBottom));
                } else {
                    return ((elementTop <= pageBottom) && (elementBottom >= pageTop));
                }
            },
            scrollTo: function (hash) {
                location.hash = "#" + hash;
            }
        };

        var Utils = new Utils();
    </script>

@endsection