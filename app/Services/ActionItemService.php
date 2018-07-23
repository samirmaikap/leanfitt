<?php

namespace App\Services;


use App\Repositories\ActionItemAssigneeRepository;
use App\Repositories\ActionItemAssignmentRepository;
use App\Repositories\ActionItemRepository;
use App\Repositories\CommentRepository;
use App\Repositories\Contracts\AttachmentRepository;
use App\Repositories\DeleteRepository;
use App\Repositories\DeleteService;
use App\Repositories\MediaRepository;
//use App\Services\Contracts\ActionItemServiceInterface;
use App\Validators\ActionItemAssigneeValidator;
use App\Validators\ActionItemValidator;
use App\Validators\CommentValidator;
use App\Validators\ItemAssignmentValidator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class ActionItemService //implements ActionItemServiceInterface
{
    protected $itemRepo;
    protected $assigneeRepo;
    protected $attachmentRepo;
    protected $mediaRepo;
    protected $commentRepo;
    protected $deleteRepo;
    protected $assignmentRepo;
    public function __construct(ActionItemAssigneeRepository $actionItemAssigneeRepository,
                                ActionItemRepository $actionItemRepository,
                                AttachmentRepository $attachmentRepository,
                                CommentRepository $commentRepository,
                                MediaRepository $mediaRepository,
                                DeleteRepository $deleteRepository,
                                ActionItemAssignmentRepository $itemAssignmentRepository)
    {
        $this->itemRepo=$actionItemRepository;
        $this->assigneeRepo=$actionItemAssigneeRepository;
        $this->attachmentRepo=$attachmentRepository;
        $this->commentRepo=$commentRepository;
        $this->mediaRepo=$mediaRepository;
        $this->deleteRepo=$deleteRepository;
        $this->assignmentRepo=$itemAssignmentRepository;
    }

    public function index($data)
    {
        $organization=arrayValue($data,'organization');
        $project=arrayValue($data,'project');
        $board=arrayValue($data,'board');

        $query=$this->itemRepo->allItems($organization,$project,$board);

        if(!$query){
            throw new \Exception('No result found');
        }

        return $query;
    }

    public function show($item_id)
    {
        $query=$this->itemRepo->getItem($item_id);

        if(!$query){
            throw new \Exception('No result found');
        }

        $data['id']=$query['id'];
        $data['name']=$query['name'];
        $data['board_id']=$query['board_id'];
        $data['board_name']=isset($query['board']['name']) ? $query['board']['name'] : null;
        $data['assignor_id']=isset($query['assignor']['id']) ? $query['assignor']['id'] :null;
        $data['assignor_name']=isset($query['assignor']['id']) ? $query['assignor']['first_name'].' '.$query['assignor']['last_name'] :null;
        $data['assignor_avatar']=isset($query['assignor']['id']) ? $query['assignor']['avatar'] :null;
        $data['members']=count($query['assignees']) > 0 ? $query['assignees']->map(function($member){
            if(isset($member['user'])){
                return ['id'=>$member['user']['id'],'first_name'=>$member['user']['first_name'],'last_name'=>$member['user']['last_name'],'avatar'=>$member['user']['avatar']];
            }
            else{
                return null;
            }

        }): null;
        $data['comments']=count($query['comments']) > 0 ? $query['comments']->map(function($comment){
            return [
                'id'=>$comment['id'],
                'comment'=>$comment['comment'],
                'commenter_id'=>isset($comment['user']['id']) ? $comment['user']['id'] : null,
                'commenter_name'=>isset($comment['user']['id']) ? $comment['user']['first_name'] .' '.$comment['user']['last_name'] : null,
                'commenter_avatar'=>isset($comment['user']['id']) ? $comment['user']['avatar'] : null,
                'created_at'=>Carbon::parse($comment['created_at'])->format('Y-m-d H:i:s')
            ];
        }) : null;
        $data['attachments']=isset($query['attachments']) ? $query['attachments'] : null;
        $data['created_at']=Carbon::parse($query['created_at'])->format('Y-m-d H:i:s');
        $data['position']=$query['position'];
        $data['due_date']=$query['due_date'];
        $data['description']=$query['description'];
        return renderCollection($data);
    }

    public function create($data)
    {
//        dd($data);
        $validator=new ActionItemValidator($data,'create');
        if($validator->fails()){
            throw new \Exception($validator->messages()->first());
        }

        DB::beginTransaction();
        $query=$this->itemRepo->create($data);
        if($query){
            DB::commit();
            return;
        }
        else{
            DB::rollBack();
            throw new \Exception(config('messages.common_error'));
        }
    }

    public function update($data, $item_id)
    {

        if(empty($item_id)){
            throw new \Exception('Item id field is required');
        }

        DB::beginTransaction();
        $query=$this->itemRepo->update($item_id,$data);
        if($query){
            DB::commit();
            return true;
        }
        else{
            DB::rollBack();
            throw new \Exception(config('messages.common_error'));
        }
    }

    public function addAssignee($data)
    {
        $validator=new ActionItemAssigneeValidator($data,'create');
        if($validator->fails()){
            throw new \Exception($validator->messages()->first());
        }

        DB::beginTransaction();
        $exist=$this->assigneeRepo->where('action_item_id',arrayValue($data,'action_item_id'))->where('user_id',arrayValue($data,'user_id'))->exists();

        if($exist){
            throw new \Exception('The user is already member of this action item');
        }
        else{
            $query=$this->assigneeRepo->create($data);
            if($query){
                DB::commit();
                return true;
            }
            else{
                DB::rollBack();
                throw new \Exception(config('messages.common_error'));
            }
        }
    }

    public function removeAssignee($item_id,$assignee_id)
    {

        DB::beginTransaction();
        $assignee=$this->assigneeRepo->where('user_id',$assignee_id)->where('action_item_id',$item_id)->first();
        if($assignee){
            $query=$this->assigneeRepo->deleteRecord($assignee);
            if($query){
                DB::commit();
                return true;
            }
            else{
                DB::rollBack();
                throw new \Exception(config('messages.common_error'));
            }
        }
        else{
            DB::rollBack();
            throw new \Exception("Assignee not found");
        }

    }

    /*Assignment Service*/

    public function getAssignment()
    {
        $query=$this->assignmentRepo->getAssignments();
        if(count($query) > 0){
            return $query;
        }
        else{
            throw new \Exception("No assignment found");
        }
    }

    public function addAssignment($data)
    {
        $validator=new ItemAssignmentValidator($data,'create');
        if($validator->fails()){
            throw new \Exception($validator->messages()->first());
        }

        DB::beginTransaction();
        $query=$this->assignmentRepo->create($data);
        if($query){
            DB::commit();
            return true;
        }
        else{
            DB::rollBack();
            throw new \Exception(config('messages.common_error'));
        }

    }

    public function updateAssignment($data, $assignment_id)
    {

        if(empty($assignment_id)){
            throw new \Exception("Assignment id field is required");
        }

        DB::beginTransaction();
        $query=$this->assignmentRepo->update($assignment_id,$data);
        if($query){
            DB::commit();
            return true;
        }
        else{
            DB::rollBack();
            throw new \Exception(config('messages.common_error'));
        }

    }

    public function removeAssignment($assignment_id)
    {
        if(empty($assignment_id)){
            throw new \Exception("Assignment id field is required");
        }

        DB::beginTransaction();
        $assignment=$this->assignmentRepo->find($assignment_id);
        if(count($assignment) > 0){
            $query=$this->assignmentRepo->deleteRecord($assignment);
            if($query){
                DB::commit();
                return true;
            }
            else{
                DB::rollBack();
                throw new \Exception(config('messages.common_error'));
            }
        }
        else{
            DB::rollBack();
            throw new \Exception("Assignment not found");
        }
    }

    public function archive($item_id)
    {
        if(empty($item_id)){
            throw new \Exception("Invalid action item selection");
        }

        DB::beginTransaction();
        $query=$this->itemRepo->restore($item_id);
        if($query){
            DB::commit();
            return true;
        }
        else{
            DB::rollBack();
            throw new \Exception(config('messages.common_error'));
        }

    }

    public function restore($item_id)
    {
        if(empty($item_id)){
            throw new \Exception("Invalid action item selection");
        }

        DB::beginTransaction();
        $query=$this->itemRepo->restore($item_id);
        if($query){
            DB::commit();
            return true;
        }
        else{
            DB::rollBack();
            throw new \Exception(config('messages.common_error'));
        }

    }

    public function delete($item_id)
    {
        if(empty($item_id)){
            throw new \Exception("item_id is required");
        }

        DB::beginTransaction();
        $item=$this->itemRepo->find($item_id);
        if($item){
            $query=$this->deleteRepo->deleteActionItems('self',$item->id);
            if($query){
                DB::commit();
                return true;
            }
            else{
                DB::rollBack();
                throw new \Exception(config('messages.common_error'));
            }
        }
        else{
            DB::rollBack();
            throw new \Exception("Comment not found");
        }

    }
}
