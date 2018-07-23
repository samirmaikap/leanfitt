{{--Assginee Modal--}}
<div class="modal modal-center fade" id="assignees-modal" tabindex="-1">
    <div class="modal-dialog mt-30 ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Member</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="{{url('projects/member')}}">
                {{csrf_field()}}
                <div class="modal-body">
                    <div class="form-group">
                        <p>Select an user</p>
                        <select name="user_id" data-provide="selectpicker" data-width="100%">
                            @if(isset($members) && count($members) > 0)
                                @foreach($members as $member)
                                    <option value="{{$member->id}}">{{$member->first_name}} {{$member->last_name}}</option>
                                @endforeach
                            @else
                                <option value="">None</option>
                            @endif
                        </select>
                    </div>
                    {{--<input type="hidden" name="project_id" value="{{$project->id}}">--}}
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>