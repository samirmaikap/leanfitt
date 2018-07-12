<!-- Modal - Add new department -->
<div class="modal modal-center fade" id="modal-center" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form action="" method="post">
                {{ csrf_field() }}
                {{ method_field('put') }}
                <div class="modal-header">
                    <h5 class="modal-title"> Add Department</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input class="form-control" type="text" name="name" placeholder="Department Name"/>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" name="description" rows="5" placeholder="Department Description"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    {{--<button type="button" class="btn btn-bold btn-secondary" data-dismiss="modal">Close--}}
                    {{--</button>--}}
                    <button type="button" class="btn btn-round btn-block btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- END Modal - Add new department -->