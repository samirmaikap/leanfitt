<?php

namespace App\Listeners;

use App\Events\ProjectCreated;
use App\Services\BoardService;
use App\Services\ProcessService;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SetupDefaultBoard
{
    public $boardService;
    public $processService;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(BoardService $boardService, ProcessService $processService)
    {
        $this->boardService = $boardService;
        $this->processService = $processService;
    }

    /**
     * Handle the event.
     *
     * @param  ProjectCreated  $event
     * @return void
     */
    public function handle(ProjectCreated $event)
    {
        $project = $event->project;

        // Create a default board for the project
        $boardData = [
            'project_id' => $project->id,
            'name' => 'Main Board',
        ];

        $board = $this->boardService->create($boardData);


        $defaultProcess = [
            'Backlog',
            'To Do',
            'In Progress',
            'In Review',
            'Done',
        ];


        foreach ($defaultProcess as $process)
        {
            $processData = [
                'board_id' => $board->id,
                'name' => $process
            ];
            $this->processService->addProcess($processData);
        }

    }
}
