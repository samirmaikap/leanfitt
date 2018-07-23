<!-- Action Item modal -->
<div id="action-item-{{ $actionItem->id }}-modal" class="modal fade">
    <div class="modal-dialog modal-center">
        <div class="modal-content">

            <form id="action-item-{{ $actionItem->id }}-form" action="{{ url('action-items/' . $actionItem->id) }}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="position" value="{{ $actionItem->position }}">
                <input type="hidden" name="user_id" value="{{ $actionItem->user_id }}">

            <!-- Modal Header starts -->
            <div class="modal-header bg-primary">
                <h4 class="modal-title text-white">Edit Action Item</h4>
                <button type="button" class="modal-close-btn close" data-dismiss="modal"
                        aria-hidden="true">×
                </button>
            </div>
            <!-- Modal Header Ends -->

            <!-- Modal Body Starts -->
            <div class="modal-body" #style="height:400px; overflow-y: scroll">
                {{--<div class="card">--}}
                    {{--<div class="card-title">--}}
                        {{--<h5>On Progress</h5>--}}
                    {{--</div>--}}
                    {{--<div class="card-body">--}}
                        <div class="form-group">
                            <label class="col-form-label ">Title</label>
                            <br/>
                            <div class="">
                                <input type="text" class="form-control" name="title" value=""/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label ">Description</label>
                            <br/>
                            <div class="">
                                <textarea class="form-control" rows="3" name="description"></textarea>
                            </div>
                        </div>

                        {{--<hr/>--}}

                        <div class="form-group">
                            <label class="col-form-label">Assignees</label>
                            <select name="assignees[]" id="" class="form-control selectpicker" multiple>
                                <option value="">Debajyoti Das</option>
                                <option value="">Debajyoti Das</option>
                                <option value="">Debajyoti Das</option>
                                <option value="">Debajyoti Das</option>
                                <option value="">Debajyoti Das</option>
                                <option value="">Debajyoti Das</option>
                                <option value="">Debajyoti Das</option>
                                <option value="">Debajyoti Das</option>
                                <option value="">Debajyoti Das</option>
                                <option value="">Debajyoti Das</option>
                            </select>
                        </div>

                        {{--<hr/>--}}

                        <div class="form-group">
                            <label class="col-form-label">Attachments</label>
                            {{--<div class="dropzone1" data-provide="dropzone"--}}
                                 {{--data-url="{{ url('action-items') }}"--}}
                                 {{--data-error="dropzoneError()" --}}
                                 {{--data-params="{_token: {{ csrf_token() }}">--}}
                            {{--</div>--}}
                            <div id="dropzone" class="dropzone p-0">
                                <div class="dropzone-previews b-1"></div>
                            </div>
                        </div>

                        {{--<hr/>--}}

                        <div class="publisher publisher-multi b-1">
                            <textarea id="comment" name="comment" class="publisher-input" rows="3" placeholder="Add Comments"></textarea>
                            <div class="flexbox flex-row-reverse">
                                <button id="post-comment" class="btn btn-sm btn-bold btn-primary">Post</button>
                            </div>
                        </div>

                        <div class="media-list media-list-divided bg-lighter" style="border: 1px solid #ebebeb;">
                            <div class="media">
                                <a class="avatar" href="#">
                                    <img src="../assets/img/avatar/4.jpg" alt="...">
                                </a>
                                <div class="media-body">
                                    <p>
                                        <a href="#"><strong>Frank Camley</strong></a>
                                        <time class="float-right text-fade" datetime="2017-07-14 20:00">Just now
                                        </time>
                                    </p>
                                    <p>Uniquely enhance world-class channels with just in time schemas.</p>
                                </div>
                            </div>
                        </div>
                    {{--</div>--}}
                {{--</div>--}}
            </div>
            <!-- Modal Body Ends -->
            <div class="modal-footer">
                 {{--<a href="javascript:;" class="btn btn-block btn-primary" data-dismiss="modal">Submit</a>--}}
            </div>
            </form>
        </div>
    </div>
</div>
<!-- Action Item modal -->