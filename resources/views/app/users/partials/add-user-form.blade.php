<form id="add-user-form">

    {{--<div class="flexbox gap-items-4">--}}
        {{--<img class="avatar avatar-xl" src="../../assets/img/avatar/2.jpg" alt="...">--}}
        {{--<div class="flex-grow">--}}
            {{--<h5>Hossein Shams</h5>--}}
            {{--<div class="d-flex flex-column flex-sm-row gap-items-2 gap-y mt-16">--}}
                {{--<div class="file-group file-group-inline">--}}
                    {{--<button class="btn btn-sm btn-w-lg btn-outline btn-round btn-secondary file-browser" type="button">--}}
                        {{--Change Picture--}}
                    {{--</button>--}}
                    {{--<input type="file">--}}
                {{--</div>--}}

                {{--<a class="btn btn-sm btn-w-lg btn-outline btn-round btn-danger" href="#">Delete Picture</a>--}}
            {{--</div>--}}

        {{--</div>--}}
    {{--</div>--}}
    {{--<hr>--}}

    <div class="row">
        <div class="form-group col-md-6">
            <label class="text-fader">First name</label>
            <input class="form-control" type="text">
        </div>

        <div class="form-group col-md-6">
            <label class="text-fader">Last name</label>
            <input class="form-control" type="text">
        </div>
    </div>

    <div class="form-group">
        <label class="text-fader">Email</label>
        <input class="form-control" type="text">
    </div>

    <div class="row">
        <div class="form-group col-md-6">
            <label class="text-fader">Department</label>
            <div class="btn-group bootstrap-select form-control">
                <select class="form-control" title="&nbsp;" data-provide="selectpicker" tabindex="-98">
                    <option class="bs-title-option" value="">&nbsp;</option>
                    <option>United States</option>
                    <option>Canada</option>
                    <option>Mexico</option>
                    <option>United Kingdom</option>
                </select></div>
        </div>

        <div class="form-group col-md-6">
            <label class="text-fader">Phone</label>
            <input class="form-control" type="text">
        </div>
    </div>
</form>