<!-- Modal - Add KPI -->
<div id="add-kpi-modal" class="modal modal-center fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white"> Add KPI</h5>
                    <button type="button" class="close text-white" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="add-kpi-form" action="" method="post">
                    {{ csrf_field() }}
                    {{ method_field('post') }}
                    <input type="hidden" name="project_id" value="{{ $project["id"] }}">

                    <div class="form-group">
                        <label>Title</label>
                        <input class="form-control" type="text" name="title">
                    </div>

                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" type="text" name="description"></textarea>
                    </div>

                    <hr>

                    <div class="form-group">
                        <label>X-Axis Label</label>
                        <input class="form-control" type="text" name="x_label">
                    </div>

                    <div class="form-group">
                        <label>Y-Axis Label</label>
                        <input class="form-control" type="text" name="y_label">
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label>Start Date</label>
                                <input class="form-control" type="text" name="start_date" data-provide="datepicker">
                            </div>
                            <div class="col-md-6">
                                <label>End Date</label>
                                <input class="form-control" type="text" name="end_date" data-provide="datepicker">
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-bold btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-bold btn-primary" onclick="submitForm('#add-kpi-form')">Add</button>
                </div>
        </div>
    </div>
</div>
<!-- END Modal - Add user -->