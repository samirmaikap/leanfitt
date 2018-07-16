<?php

namespace App\Repositories;

use App\Models\ActionItem;
use App\Models\ActionItemAssignee;
use App\Models\Project;
use App\Repositories\Contracts\ActionItemRepositoryInterface;
use Illuminate\Support\Collection;

class ActionItemRepository extends BaseRepository //implements ActionItemRepositoryInterface
{

    public  function  model()
    {
        return new ActionItem();
    }

    public function allItems($organization,$project,$board){
        $query=$this->model()->join('projects as pr','pr.id','=','action_items.project_id')
            ->leftJoin('action_item_assignees as ais','action_items.id','=','ais.action_item_id')
            ->where('pr.organization_id',empty($organization) ? '!=':'=',empty($organization) ? null : $organization)
            ->where('pr.id',empty($project) ? '!=':'=',empty($project) ? null : $project)
            ->where('action_items.board_id',empty($project) ? '!=':'=',empty($board) ? null : $board)
            ->select('action_items.*')
            ->withCount('comments')->withCount('assignees')->withCount('attachments')->get();
        return $query;
    }

    public function getItem($id)
    {
        $query=$this->model()->with(['assignor','board','assignees.user','comments.user','attachments'])->where('id',$id)->where('is_archived',0)->first();
        return $query;
    }
}