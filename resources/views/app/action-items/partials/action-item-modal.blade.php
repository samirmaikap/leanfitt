<!-- Action Item modal -->
<div id="action-item-{{ $actionItem->id }}-modal" class="modal modal-center fade">
    <div class="modal-dialog modal-center modal-lg">
        <div class="modal-content">

            <!-- Modal Header starts -->
            <div class="modal-header bg-primary">
                <h4 class="modal-title text-white">Edit Action Item</h4>
                <button type="button" class="modal-close-btn close" data-dismiss="modal"
                        aria-hidden="true">×
                </button>
            </div>
            <!-- Modal Header Ends -->

            <!-- Modal Body Starts -->
            <div class="modal-body">

                <div class="row">
                    <div class="col-md-7"  style="height:400px; overflow-y: scroll">
                        <form id="action-item-{{ $actionItem->id }}-form" action="{{ url('action-items/' . $actionItem->id) }}"
                      class="action-item-form" method="post">

                            {{ csrf_field() }}
                            {{ method_field('put') }}

                            <input type="hidden" name="auth_user_id" value="{{ session()->get('user')->id }}">

                            <input type="hidden" name="id" value="{{ $actionItem->id }}">
                            <input type="hidden" name="user_id" value="{{ $actionItem->user_id }}">
                            <input type="hidden" name="process_id" value="{{ $process->id }}">
                            <input type="hidden" name="position" value="{{ $actionItem->position }}">

                            <div class="form-group">
                                <label class="col-form-label ">Title</label>
                                <br/>
                                <div class="">
                                    <input type="text" class="form-control" name="title" value="{{ $actionItem->title }}"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label ">Description</label>
                                <br/>
                                <div class="">
                                    <textarea class="form-control" rows="3" name="description">{{ $actionItem->description }}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label ">Due Date</label>
                                <br/>
                                <div class="">
                                    <input type="text" class="form-control" data-provide="datepicker" data-date-today-highlight="true" name="due_date" value="{{ empty($actionItem->due_date) ? old('due_date') : date('m/d/Y',strtotime($actionItem->due_date))  }}"/>
                                </div>
                            </div>

                            {{--<hr/>--}}

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="col-form-label">Assignor</label>
                                        <select class="form-control" disabled="">
                                            <option selected="">
                                                {{ $actionItem->assignor->full_name }}
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                         <label class="col-form-label">Assignees</label>
                                            <select name="assignees[]" class="form-control" data-provide="selectpicker" multiple>
{{--                                                @if(isset($project->members) && count($project->members))--}}
                                                {{--@if(!empty(session()->get('organization')) && count(session()->get('organization')->users))--}}
                                                    @foreach(session()->get('organization')->users as $user)
                                                        <option value="{{ $user->id }}" @if(in_array($user->id, $actionItem->assignees()->pluck('user_id')->toArray())) {{ 'selected' }} @endif>
                                                            {{ $user->full_name }}
                                                        </option>
                                                    @endforeach
                                                {{--@endif--}}
                                            </select>
                                    </div>        
                                </div>
                                
                               
                            </div>

                        </form>
                        {{--<hr/>--}}

                        <div class="form-group">
                            <label class="col-form-label">Attachments</label>
                            <div id="dropzone-{{ $actionItem->id }}" class="p-0"
                                 data-provide="dropzone"
                                 data-method="post"
                                 data-url="{{ url('api/attachments') }}"
                                 data-params='{"_token": "{{ csrf_token() }}", "type": "action_item", "action_item_id": "{{ $actionItem->id }}" }'
                                 data-test=demo>
                            </div>
                            <div class="b-1 border-light p-10">
                                @if(isset($actionItem->attachments) && count($actionItem->attachments) > 0)
                                    @foreach($actionItem->attachments as $key=>$attachment)
                                        @php $ext= empty($attachment->url) ? 'N/A' : pathinfo($attachment->url, PATHINFO_EXTENSION); @endphp
                                        <a class="avatar avatar-pill avatar-lg" style="overflow: hidden"
                                           href="{{$attachment->url}}" target="_blank">
                                            <img src="https://ui-avatars.com/api/?font-size=0.21&length=4&uppercase=false&name={{$ext}}"
                                                 alt="...">
                                            {{--<span class="text-truncate w-150px">Attachment {{$key+1}}</span>--}}
                                            <form class="attachmentRemoveForm" method="post"
                                                  action="{{url('projects')}}/{{$actionItem->id}}/attachment/{{$attachment->id}}/remove">
                                                {{csrf_field()}}
                                                {{method_field('delete')}}
                                                {{--<button type="submit" class="close cursor-pointer remove-attachment">&times;</button>--}}
                                            </form>
                                        </a>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5"  style="height:400px; overflow-y: scroll">
                        @if(!isSuperadmin())
                        <form class="comment-form publisher publisher-multi b-1" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" name="user_id" value="{{ session()->get('user')->id }}">
                            <input type="hidden" name="type" value="action_item">
                            <input type="hidden" name="action_item_id" value="{{ $actionItem->id }}">
                            <textarea name="comment" class="publisher-input comment" rows="3"
                                      placeholder="Add Comments"></textarea>
                            <div class="flexbox flex-row-reverse">
                                <button type="submit" class="btn btn-sm btn-bold btn-primary post-comment">Post</button>
                            </div>
                        </form>
                    @endif
                    <div class="comment-list media-list media-list-divided b-1 border-light">
                        @if(isset($actionItem->comments) && count($actionItem->comments))
                            @foreach($actionItem->comments->sortByDesc('created_at') as $comment)
                                <div class="media">
                                    <a class="avatar" href="#">
                                        <img src="https://ui-avatars.com/api/?name={{ $comment->user->full_name }}"
                                             alt="$comment->user->initials">
                                    </a>
                                    <div class="media-body">
                                        <p>
                                            <a href="#">
                                                <strong>{{ $comment->user->full_name }}</strong>
                                                <br>
                                                 <time class="#float-right text-fade" datetime="2017-07-14 20:00">
                                                    {{ $comment->created_at->format('m/d/Y h:i A') }}
                                                </time>
                                            </a>
                                        </p>
                                        <p class="">{{ $comment->comment }}</p>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    {{--</div>--}}
                    {{--</div>--}}
                </div>
                <!-- Modal Body Ends -->
                    </div>
                </div>

            @if(!isSuperadmin() || ($actionItem->aasignor_id == session('user')->id) || in_array(session('user')->id, $actionItem->assignees()->pluck('user_id')->toArray()) )
                <div class="modal-footer">
                    <button type="submit" class="update-action-item btn btn-block btn-primary">Update</button>
                </div>
            @endif
        </div>
    </div>
</div>
<!-- Action Item modal -->