<!-- Modal - KPI -->
<div id="kpi-{{ isset($kpi) ? $kpi->id : 0 }}-modal" class="modal modal-center fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white"> {{ isset($kpi) ? 'Edit' : 'Add' }} KPI</h5>
                <button type="button" class="close text-white" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="kpi-{{ isset($kpi) ? $kpi->id : 0 }}-form" action="{{ isset($kpi) ? url('kpi/' . $kpi->id) : url('kpi') }}" method="post">
                    {{ csrf_field() }}
                    {{ isset($kpi) ? method_field('put') :  method_field('post') }}
                    <input type="hidden" name="project_id" value="{{ $project["id"] }}">

                    <div class="form-group">
                        <label>Title</label>
                        <input class="form-control" type="text" name="title" value="{{ old('title', isset($kpi) ? $kpi->title : '') }}">
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>X-Axis Label</label>
                                <input class="form-control" type="text" name="x_label" value="{{ old('x_label', isset($kpi) ? $kpi->x_label : '') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>X-Axis Unit</label>
                                <input class="form-control" type="text" name="x_unit" value="{{ old('x_unit', isset($kpi) ? $kpi->x_unit : '') }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Y-Axis Label</label>
                                <input class="form-control" type="text" name="y_label" value="{{ old('y_label', isset($kpi) ? $kpi->y_label : '') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Y-Axis Unit</label>
                                <input class="form-control" type="text" name="y_unit" value="{{ old('y_unit', isset($kpi) ? $kpi->y_unit : '') }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Target</label>
                                <input class="form-control" type="text" name="target" value="{{ old('target', isset($kpi) ? $kpi->target : '') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Trend</label>
                                <select class="form-control" name="trend">
                                    <option value="+" selected>Positive (+)</option>
                                    <option value="-">Negative (-)</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label>Start Date</label>
                                <input class="form-control" type="text" name="start_date"  value="{{ old('start_date', isset($kpi) ? date('m/d/Y', strtotime($kpi->start_date)) : '') }}" data-provide="datepicker">
                            </div>
                            <div class="col-md-6">
                                <label>End Date</label>
                                <input class="form-control" type="text" name="end_date"  value="{{ old('end_date', isset($kpi) ? date('m/d/Y', strtotime($kpi->end_date)) : '') }}" data-provide="datepicker">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                {{--<button type="button" class="btn btn-bold btn-secondary" data-dismiss="modal">Cancel</button>--}}
                <button type="submit" class="btn btn-block btn-bold btn-primary" onclick="submitForm('#kpi-{{ isset($kpi) ? $kpi->id : 0 }}-form')">
                    Submit
                </button>
            </div>
        </div>
    </div>
</div>
<!-- END Modal - Add user -->