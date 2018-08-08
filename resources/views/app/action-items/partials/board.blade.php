<div class="board-wrapper">
    <div class="board-scroller">

        @foreach($project->boards()->first()->processes as $process)
{{--            {{ dd(count($process->actionItems)) }}--}}
        <div class="process" data-id="{{ $process->id }}">
            <div class="card">
                <h4 class="card-title">{{ $process->name }}</h4>
                <div class="card-body bg-lighter">
                    <div class="media-list media-list-hover media-list-divided" style="min-height: 100px">
                        @foreach($process->actionItems as $actionItem)
                            @php
                                $isAssignor = (session('user')->id == $actionItem->assignor->id);
                                $isAssignee = in_array(session('user')->id, $actionItem->assignees()->pluck('user_id')->toArray());
                                $class = $isAssignee ? 'border-primary' : 'border-light' ;
                                $isDisabled = ( $isAssignor || $isAssignee ) ? 'false' : 'true';
                                if(($process->id == 4 || $process->id == 5) && !$isAssignor){
                                    $isDisabled = 'true';
                                }
                            @endphp
                            <div class="action-item {{ $class}} b-2 shadow-1 mb-20" data-id="{{ $actionItem->id }}" data-disabled="{{ $isDisabled }}">
                                <a class="media media-single" href="#action-item-{{ $actionItem->id }}-modal" data-toggle="modal">
                                    <div class="media-body">
                                        <h5 class="title" style="padding-bottom: 5px;border-bottom: 1px solid #efefef;margin-bottom: 5px;">
                                         {{ $actionItem->title }}
                                        </h5>
                                        <small class="text-fader">Assignor</small>
                                        <p>
                                            @php 
                                                $class = (session('user')->id == $actionItem->assignor->id)? 'border-primary' : 'border-light' ;
                                            @endphp
                                            <span class="avatar avatar-sm b-2 {{ $class }}" title="{{ $actionItem->assignor->initails }}" data-provide="tooltip" data-title="{{ $actionItem->assignor->initails }}">
                                                 <img src="https://ui-avatars.com/api/?name={{ $actionItem->assignor->full_name }}"
                                                     alt="{{ $actionItem->assignor->initails }}">
                                            </span>
                                        </p>
                                        @if(count($actionItem->assignees))
                                        <small class="text-fader">Assignees</small>
                                        <p class="assignees">
                                            @foreach($actionItem->assignees as $assignee)

                                            @php 
                                                $class = (session('user')->id == $assignee->id)? 'border-primary' : 'border-light' ;
                                            @endphp
                                             <span class="avatar avatar-sm b-2 {{ $class }}" >
                                                <img src="https://ui-avatars.com/api/?name={{ $assignee->full_name }}"
                                                     alt="{{ $assignee->initails }}">
                                            </span>
                                            @endforeach
                                        </p>
                                        @endif
                                    </div>
                                </a>
                                @include('app.action-items.partials.action-item-modal')
                            </div>
                        @endforeach
                    </div>
                </div>
                @if(!isSuperadmin() && in_array(session('user')->id, $project->members()->pluck('user_id')->toArray()))
                <div class="card-footer">
                    {{--<a href="#new-action-item-modal" data-toggle="modal">--}}
                        {{--+ New Action Item--}}
                    {{--</a>--}}

                    <form class="publisher" action="{{ url('action-items') }}" method="post">

                        {{ csrf_field() }}
                        <input type="hidden" name="process_id" value="{{ $process->id }}">
                        <input type="hidden" name="user_id" value="{{ session()->get('user')->id }}">
                        <input type="hidden" name="position" value="{{ count($process->actionItems) + 1 }}">
                        <input class="publisher-input" type="text" name="title" placeholder="Enter action item title" required>

                        <button class="publisher-btn btn" data-provide="tooltip" data-title="Add New Action Item" title="Add New Action Item">
                            <i class="fa fa-plus"></i>
                        </button>
                    </form>
                </div>
                @endif
            </div>
        </div>
        @endforeach
    </div>
</div>