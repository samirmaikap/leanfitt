@extends('layouts.app')
@section('content')
    <main>
        @include('app.projects.partials.header')
        <div class="main-content">

            <canvas id="canvas"></canvas>

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
                                        $kpiSet[$index]->project_start = $project->start_date;
                                        $kpiSet[$index]->project_end = $project->end_date;
                                        $kpiSet[$index]->dataset = [
                                            'x_value' => $kpi->data->pluck('x_value')->toArray(),
                                            'y_value' => $kpi->data->pluck('y_value')->toArray(),
                                            'timestamp' => $kpi->data->pluck('created_at')->toArray(),
                                        ];
                                        $kpiSet[$index]->timestamp = $kpi->data->pluck('created_at')->toArray();
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
                <h3 class="text-dark d-block text-center py-20">No KPI available</h3>
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

    <!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-annotation/0.5.7/chartjs-plugin-annotation.min.js"></script> -->
    <script>

        function injectScript( src,callback) {
          var s = document.createElement( 'script' );
          s.setAttribute( 'src', src );
          s.onload=callback;
          document.body.appendChild( s );
        }

        window.onload = function () {

            // injectScript("https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.js");
            // injectScript("https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-annotation/0.5.7/chartjs-plugin-annotation.min.js");

            var jsonString = '{!! json_encode($kpiSet) !!}';
            // console.log(jsonString);
            var kpiSet = JSON.parse(jsonString);
            console.log(kpiSet);

            // var xAxisLabelIndex = 0;


            $.each(kpiSet, function (index, kpi) {


                if(kpi.data.length == 0)
                    return;


                kpi.dataset2 = {
                    x_value: [],
                    y_value: new Array(kpi.data.length).fill(kpi.target)
                };

                var projectStart = moment(kpi.project_start);
                var projectEnd = moment(kpi.project_end);

                var kpiStart = moment(kpi.start_date);
                var kpiEnd = moment(kpi.end_date);


                var projectStartFlag = false;
                var projectEndFlag = false;
                var kpiStartFlag = false;
                var kpiEndFlag = false;

                if(kpiStart.isSameOrAfter(projectStart)){
                    projectStartFlag = true;
                    kpi.dataset2.x_value.push("Project Start - " + projectStart.format('MM/DD/YYYY'));
                    
                }else{
                    kpiStartFlag = true;
                    kpi.dataset2.x_value.push("KPI Start - " + kpiStart.format('MM/DD/YYYY'));
                }

                $.each(kpi.dataset.timestamp, function(index, timestamp){
                    // console.log("before", index, timestamp);
                    // timestamp = moment(timestamp.format('MM/DD/YYYY'));
                    timestamp = moment(timestamp.date.substr(0,10));
                    var nextTimestamp = typeof kpi.dataset.timestamp[index +1] != "undefined" ? moment(kpi.dataset.timestamp[index +1].date.substr(0,10)) : null;
                    // console.log("after", index, timestamp);

                    // Project Start Date
                    if(!projectStartFlag){


                        if(projectStart.isSameOrAfter(timestamp)){
                            kpi.dataset2.x_value.push(timestamp.format('MM/DD/YYYY'));

                        }else if(projectStart.isSameOrBefore(nextTimestamp)){

                            if(projectStart.isSameOrBefore(kpiStart)) {
                                kpi.dataset2.x_value.push("Project Start - " + projectStart.format('MM/DD/YYYY'));
                                projectStartFlag = true;
                            }else if(!kpiStartFlag){
                                kpi.dataset2.x_value.push("KPI Start - " + kpiStart.format('MM/DD/YYYY'));
                                kpiStartFlag = true;
                            }else {
                                console.log("else 1");
                            }
                    
                        }
                    }


                    // KPI Start Date
                    if(!kpiStartFlag){

                        if(kpiStart.isSameOrAfter(timestamp)){
                            kpi.dataset2.x_value.push(timestamp.format('MM/DD/YYYY'));
                        }else if(kpiStart.isSameOrBefore(nextTimestamp)){

                            if(kpiStart.isSameOrBefore(projectStart)) {
                                kpi.dataset2.x_value.push("KPI Start - " + kpiStart.format('MM/DD/YYYY'));
                                kpiStartFlag = true;
                            }else if(!projectStartFlag){
                                  kpi.dataset2.x_value.push("Project Start - " + projectStart.format('MM/DD/YYYY'));
                                projectStartFlag = true;
                            }else {
                                console.log("else 2");
                            }
                            
                        }
                    }


                    // Project End Date
                    if(projectStart && !projectEndFlag){

                        if(projectEnd.isSameOrAfter(timestamp)){
                            kpi.dataset2.x_value.push(timestamp.format('MM/DD/YYYY'));
                        }else if(projectEnd.isSameOrBefore(nextTimestamp)){
                            kpi.dataset2.x_value.push("Project End - " + projectEnd.format('MM/DD/YYYY'));
                            projectEndFlag = true;
                        }
                    }


                    // KPI End Date
                    if(kpiStartFlag && !kpiEndFlag){

                        if(kpiEnd.isSameOrAfter(timestamp)){
                            kpi.dataset2.x_value.push(timestamp.format('MM/DD/YYYY'));
                        }else if(kpiEnd.isSameOrBefore(nextTimestamp)){
                            kpi.dataset2.x_value.push("KPI End - " + kpiEnd.format('MM/DD/YYYY'));
                            kpiEndFlag = true;
                        }
                    }


                    // if(projectEnd.isSameOrAfter(timestamp) && projectEndFlag != true){
                    //     kpi.dataset2.x_value.push(timestamp.format('MM/DD/YYYY'));
                        
                    // }else{
                    //     projectEndFlag = true;
                    //     kpi.dataset2.x_value.push("Project End - " + projectEnd.format('MM/DD/YYYY'));
                    // }


                    // if(kpiEnd.diff(timestamp) >= 0 && kpiStartFlag == true && kpiEndFlag != true){
                    //     kpi.dataset2.x_value.push(timestamp.format('MM/DD/YYYY'));
                        
                    // }else{
                    //     kpiEndFlag = true;
                    //     kpi.dataset2.x_value.push("KPI End - " + kpiEnd.format('MM/DD/YYYY'));
                    // }

                });


                console.log(kpi);
                return;



                kpi.dataset.x_value.unshift("") ;
                kpi.dataset.x_value.push("") ;

                kpi.dataset.y_value.unshift(null) ;
                kpi.dataset.y_value.push(null) ;

                // ==============================================
                // Line chart
                //

                var ctx = document.getElementById("kpi-" + kpi.id + "-chart").getContext("2d");
                Chart.Line(ctx, {
                // new Chart($("#kpi-" + kpi.id + "-chart"), {
                
                    type: 'line',
//                responsive: true,
//                maintainAspectRatio: true,
                    // Data
                    //
                    data: {
                        // labels: ["A", "January", "February", "March", "April", "B"],
                        labels: kpi.dataset.x_value, //["January", "February", "March", "April"],
                        datasets: [
                            {
                                // xAxisID:'xAxis1',
                                // yAxisID: 'A',
                                label: kpi.title, //"Revenue",
                                fill: true,
                                borderWidth: 3,
                                pointRadius: 5,
                                borderColor: "#9966ff",
                                pointBackgroundColor: "#9966ff",
                                pointBorderColor: "#9966ff",
                                pointHoverBackgroundColor: "#fff",
                                pointHoverBorderColor: "#9966ff",
                                data: kpi.dataset.y_value, //[30, 25, 35, 23]
                                // data: [null, 30, 25, 35, 23, null]
                            },
                            {
                                xAxisID:'xAxis1',
                                yAxisID: 'A',
                                label: "Target", //"Revenue",
                                fill: false,
                                borderWidth: 3,
                                pointRadius: 5,
                                borderColor: "#00FF53",
                                pointBackgroundColor: "#00FF53",
                                pointBorderColor: "#00FF53",
                                pointHoverBackgroundColor: "#fff",
                                pointHoverBorderColor: "#00FF53",
                                data: kpi.dataset2,
                                // data: new Array(6).fill(kpi.target), //[30, 25, 35, 23]
                            }
                        ]
                    },

                    // Options
                    //
                    options: {
                        responsive: true,
                       maintainAspectRatio: true,
                        legend: {
                            display: true
                        },
                        tooltips: {
                          mode: 'index',
                          intersect: true
                        },
                        annotation: {
                          annotations: [{
                            drawTime: 'afterDraw',
                            type: 'line',
                            mode: 'horizontal',
                            scaleID: 'A',
                            value: kpi.target,
                            borderColor: 'rgb(75, 192, 192)',
                            borderWidth: 4,
                            label: {
                              enabled: false,
                              content: 'Test label'
                            }
                          }]
                        },
                        scales: {
                            yAxes: [{
                                id: 'A',
                                type: 'linear',
                                position: 'left',
                                scaleLabel: {
                                    display: true,
                                    labelString: kpi.y_label //+  ( kpi.y_unit || "")
                                },
                                ticks: {
                                    // padding: 50,
                                    suggestedMin: 0,    // minimum will be 0, unless there is a lower value.
                                    // OR //
                                    beginAtZero: true   // minimum value will be 0.
                                    // max : 1,
                                    // min : -1
                                }
                            }],
                            xAxes: [{
                                id:'xAxis1',
                                type:"category",
                                scaleLabel: {
                                    display: false,
                                    labelString: kpi.x_label
                                },
                                ticks:{
                                    padding: 50
                                }
                            },
                            {
                                id:'xAxis2',
                                type:"category",
                                scaleLabel: {
                                    display: false,
                                    labelString: "Timestamp"
                                },
                                ticks:{
                                    minRotation: 45,
                                    padding: 50,
                                    callback:function(label, index, labelSet){
                                        
                                        console.log(label, index, labelSet);
                                        console.log(kpi.data[index]);
                                      
                                        var timestamp = "";

                                        if(typeof kpi.data[index] != "undefined") {
                                            timestamp  = moment(kpi.data[index].created_at).format('MM/DD/YYYY');
                                        }

                                        kpi.dataset['x2_value'] = [];

                                        var projectStart = moment(kpi.project_start);
                                        var projectEnd = moment(kpi.project_start);

                                        var kpiStart = moment(kpi.start_date);
                                        var kpiEnd = moment(kpi.end_date);


                                        if(kpiStart.diff(projectStart) >0){
                                            kpi.dataset['x2_value'].push("KPI Start");
                                        }else{

                                        }

                                        console.log(timestamp);

                                        return timestamp;
                                    }
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

    <script type="text/javascript">
        
        function testChart(){
            window.chartColors = {
  red: 'rgb(255, 99, 132)',
  orange: 'rgb(255, 159, 64)',
  yellow: 'rgb(255, 205, 86)',
  green: 'rgb(75, 192, 192)',
  blue: 'rgb(54, 162, 235)',
  purple: 'rgb(153, 102, 255)',
  grey: 'rgb(231,233,237)'
};

var ctx = document.getElementById("canvas").getContext("2d");

var myChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: ["January", "February"],
    datasets: [{
      label: 'Dataset 1',
      borderColor: window.chartColors.blue,
      borderWidth: 2,
      fill: false,
      data: [2, 10]
    }]
  },
  options: {
    responsive: true,
    title: {
      display: true,
      text: 'Chart.js Drsw Line on Chart'
    },
    tooltips: {
      mode: 'index',
      intersect: true
    },
    annotation: {
      annotations: [{
        type: 'line',
        mode: 'horizontal',
        scaleID: 'y-axis-0',
        value: 5,
        borderColor: 'rgb(75, 192, 192)',
        borderWidth: 4,
        label: {
          enabled: false,
          content: 'Test label'
        }
      }]
    }
  }
});
        }
    </script>

@endsection