<!-- Modal - Profile -->
<div id="profile-modal" class="modal modal-center fade" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
{{--            <form action="{{ url(config('app.url') . '/users/' . auth()->user()->id) }}" method="post">--}}
            <form action="{{ url('users/' . session()->get('user')->id) }}" method="post">
                {{ csrf_field() }}
                {{ method_field('put') }}
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white"> Profile</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="row" style="display: none">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <img class="avatar avatar-xl d-block m-auto" id="profile_img" src="../assets/img/avatar/2.jpg" alt="...">
                            <br>
                            <div class="file-group file-group-inline">
                                <button class="btn btn-sm btn-w-lg btn-outline btn-round btn-secondary file-browser"
                                        type="button">Change Picture
                                </button>
                                <input type="file" id="imgInp">
                            </div>

                            <a class="btn btn-sm btn-w-lg btn-outline btn-round btn-danger" href="#">
                                Delete Picture
                            </a>
                        </div>
                        <div class="col-md-2"></div>
                    </div>

                    {{--<hr>--}}

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>First Name</label>
                            <input class="form-control" type="text" name="first_name" value="{{ old('first_name', session()->get('user')->first_name) }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Last Name</label>
                            <input class="form-control" type="text" name="last_name" value="{{ old('last_name', session()->get('user')->last_name) }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Phone</label>
                        <input class="form-control" type="text" name="phone" value="{{ old('phone', session()->get('user')->phone) }}">
                    </div>
                    <div class="form-group">
                        <label>Email address</label>
                        <input class="form-control" type="text" name="email" value="{{ old('email', session()->get('user')->email) }}">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input class="form-control" type="password" name="password">
                    </div>
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input class="form-control" type="password" name="password_confirmation">
                    </div>
                </div>
                <div class="modal-footer">
                    {{--<button type="button" class="btn btn-bold btn-secondary" data-dismiss="modal">Close--}}
                    {{--</button>--}}
                    <button type="submit" class="btn btn-bold btn-block btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- END Modal - Profile -->