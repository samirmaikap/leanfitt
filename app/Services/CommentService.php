<?php


namespace App\Services;


use App\Repositories\CommentRepository;
//use App\Services\Contracts\CommentServiceInterface;
use App\Validators\CommentValidator;
use Illuminate\Support\Facades\DB;

class CommentService //implements CommentServiceInterface
{
   protected $commentRepo;
   public function __construct(CommentRepository $commentRepository)
   {
       $this->commentRepo=$commentRepository;
   }

   public function create($data)
   {
       $data['user_id']=auth()->user()->id;
       $validator=new CommentValidator($data,'create');
       if($validator->fails()){
           throw new \Exception($validator->messages()->first());
       }

       if($data['type']=='action_item'){
           if(empty(arrayValue($data,'action_item_id'))){
               throw new \Exception("action_item_id is required");
           }

           $data['commentable_type']='App\Models\ActionItem';
           $data['commentable_id']=$data['action_item_id'];
       }
       else{
           if(empty(arrayValue($data,'project_id'))){
               throw new \Exception("project_id is required");
           }

           $data['commentable_type']='App\Models\Project';
           $data['commentable_id']=$data['project_id'];
       }

       DB::beginTransaction();
       $query=$this->commentRepo->create($data);
       if($query){
           DB::commit();
           return;
       }
       else{
           DB::rollBack();
           throw new \Exception(config('messages.common_error'));
       }
   }

   public function update($data, $comment_id)
   {
       if(empty($comment_id)){
           throw new \Exception("Invalid comment selection");
       }

       DB::beginTransaction();
       $query=$this->commentRepo->update($comment_id,$data);
       if($query){
           DB::commit();
           return;
       }
       else{
           DB::rollBack();
           throw new \Exception("Something went wrong, try again later");
       }

   }

   public function delete($comment_id)
   {
       if(empty($comment_id)){
           throw new \Exception("Invalid comment selection");
       }

       DB::beginTransaction();
       $comment=$this->commentRepo->find($comment_id);
       if($comment){
           $query=$this->commentRepo->deleteRecord($comment);
           if($query){
               DB::commit();
               return;
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