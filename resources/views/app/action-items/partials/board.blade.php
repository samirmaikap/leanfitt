<div class="board-wrapper">
    <div class="board-scroller">

        @foreach($project->boards()->first()->processes as $process)
{{--            {{ dd(count($process->actionItems)) }}--}}
        <div class="">
            <div class="card">
                <h4 class="card-title">{{ $process->name }}</h4>
                <div class="card-body">
                    <div class="media-list media-list-hover media-list-divided" style="min-height: 100px">
                        @foreach($process->actionItems as $actionItem)
                        <a class="media media-single" href="#action-item-{{ $actionItem->id }}-modal" data-toggle="modal">
                            <div class="media-body">
                                <h6> {{ $actionItem->title }}</h6>
                                <small class="text-fader">Assignor: {{ $actionItem->assignor->full_name }}</small>
                            </div>

{{--                            @include('app.action-items.partials.action-item-modal', ['actionItem' => $actionItem])--}}
                        </a>
                            @include('app.action-items.partials.action-item-modal')
                        @endforeach
                    </div>
                </div>
                <div class="card-footer">
                    {{--<a href="#new-action-item-modal" data-toggle="modal">--}}
                        {{--+ New Action Item--}}
                    {{--</a>--}}

                    <form class="publisher" action="{{ url('action-items') }}" method="post">

                        {{ csrf_field() }}
                        <input type="hidden" name="process_id" value="{{ $process->id }}">
                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                        <input type="hidden" name="position" value="{{ count($process->actionItems) + 1 }}">
                        <input class="publisher-input" type="text" name="title" placeholder="Enter action item title">

                        <button class="publisher-btn btn" data-provide="tooltip" data-title="Add New Action Item" title="Add New Action Item">
                            <i class="fa fa-plus"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>