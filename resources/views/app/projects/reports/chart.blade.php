<div class="col-lg-12 charts d-none">
    <div class="card">
        <div class="card-body">
            <canvas id="line-chart" height="500"></canvas>
        </div>
    </div>
</div>

<div class="col-lg-12 charts d-none">
    <div class="card">
        <div class="card-body">
            <canvas id="pareto-chart" height="500"></canvas>
        </div>
    </div>
</div>

<div class="col-lg-12 charts d-none">
    <div class="card">
        <div class="card-body">
            <canvas id="bar-chart" height="500"></canvas>
        </div>
    </div>
</div>

<div class="col-lg-12 charts d-none">
    <div class="card">
        <div class="card-body">
            <canvas id="scatter-chart" height="500"></canvas>
        </div>
    </div>
</div>

<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <div class="pull-left"><h3>Datasets</h3></div>
            <div class="pull-right">
                <button class="btn btn-success btn-square btn-round new-chart-dataset" title="New Dataset" data-toggle="modal" data-target="#modal-chart"><i class="fe fe-plus"></i></button>
                <button class="btn btn-success btn-square btn-round" title="Change Axis" data-toggle="modal" data-target="#modal-chart-axis"><i class="fe fe-edit-2"></i></button>
            </div>

        </div>
        <table class="table table-hover dataset-table">
            <thead>
            <tr>
                <th>Label</th>
                <th>Value</th>
                <th class="w-80px text-center">Action</th>
            </tr>
            </thead>
            <tbody>
            @if(count($report_data) > 0)
                @foreach($report_data->chart as $chart)
                    <tr class="chart-dataset" data-id="{{$chart->chart_id}}">
                        <td class="chart-label">{{$chart->label}}</td>
                        <td class="chart-value">{{$chart->value}}</td>
                        <td>
                            <nav class="nav no-gutters gap-2 fs-16">
                                <span class="nav-link hover-primary cursor-pointer edit-chart-data" title="Edit"><i class="ti-pencil"></i></span>
                                <span class="nav-link hover-danger cursor-pointer remove-chart-data" title="Delete"><i class="ti-trash"></i></span>
                            </nav>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr><td></td><td>No data found</td><td></td></tr>
            @endif

            </tbody>
        </table>
    </div>
</div>

<div class="modal modal-center fade" id="modal-chart" tabindex="-1">
    <div class="modal-dialog mt-30 ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Data</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="chartModalForm" action="{{url('projects')}}/reports/charts" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="modal-body">
                    <div class="form-group">
                        <label>Label</label>
                        <input type="text" class="form-control" name="label">
                    </div>
                    <div class="form-group">
                        <label>Value</label>
                        <input type="text" class="form-control" name="value">
                    </div>
                    <input type="hidden" name="report_id" value="{{$report->id}}">
                    <input type="hidden" name="chart_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-bold btn-pure btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-bold btn-pure btn-primary">Save</button>
                </div>
            </form>

        </div>
    </div>
</div>

<div class="modal modal-center fade" id="modal-chart-axis" tabindex="-1">
    <div class="modal-dialog mt-30 ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Change chart axis</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="{{url('projects/reports')}}/{{$report->id}}/charts/axis" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="modal-body">
                    <div class="form-group">
                        <label>X Axis</label>
                        <input type="text" class="form-control" name="x_axis" value="{{isset($report_data->x_axis) ? $report_data->x_axis : ''}}">
                    </div>
                    <div class="form-group">
                        <label>Y Axis</label>
                        <input type="text" class="form-control" name="y_axis" value="{{isset($report_data->y_axis) ? $report_data->y_axis : ''}}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-bold btn-pure btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-bold btn-pure btn-primary">Save</button>
                </div>
            </form>

        </div>
    </div>
</div>

<div class="d-none">
    <form method="post" id="deleteChartDataForm" action="">
        {{csrf_field()}}
        {{method_field('delete')}}
        <button type="submit" id="deleteChartData"></button>
    </form>
</div>

