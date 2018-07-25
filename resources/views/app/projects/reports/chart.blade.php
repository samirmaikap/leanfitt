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
<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <div class="pull-left"><h3>Datasets</h3></div>
            <div class="pull-right">
                <button class="btn btn-success btn-square btn-round" title="New Dataset" data-toggle="modal" data-target="#modal-chart"><i class="fe fe-plus"></i></button>
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
            @if(count($report_data) > 0)
                @foreach($report_data->chart as $chart)
                    <tr>
                        <td>{{$chart->label}}</td>
                        <td>{{$chart->value}}</td>
                        <td>
                            <nav class="nav no-gutters gap-2 fs-16">
                                <a class="nav-link hover-primary" href="#" data-provide="tooltip" title="Edit"><i class="ti-pencil"></i></a>
                                <a class="nav-link hover-danger" href="#" data-provide="tooltip" title="Delete"><i class="ti-trash"></i></a>
                            </nav>
                        </td>
                    </tr>
                @endforeach
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
            <form method="post" action="{{url('projects')}}/reports/charts" enctype="multipart/form-data">
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
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-bold btn-pure btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-bold btn-pure btn-primary">Add</button>
                </div>
            </form>

        </div>
    </div>
</div>