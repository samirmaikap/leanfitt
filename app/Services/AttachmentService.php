<?php

namespace App\Services;


use App\Repositories\Contracts\AttachmentRepository;
use App\Repositories\MediaRepository;
use App\Services\Contracts\AttachmentServiceInterface;
use App\Validators\AttachmentValidator;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Filesystem\FilesystemManager;
use Spatie\Backup\Helpers\File;

class AttachmentService //implements AttachmentServiceInterface
{
    protected $attachmentRepo;
    protected $mediaRepo;
    public function __construct(AttachmentRepository $attachmentRepository,
                                MediaRepository $mediaRepository)
    {
        $this->attachmentRepo=$attachmentRepository;
        $this->mediaRepo=$mediaRepository;
    }

    public function create($data,$file)
    {
        $fileSystem=new Filesystem();
        $validator=new AttachmentValidator($data,'create');
        if($validator->fails()){
            throw new \Exception($validator->messages()->first());
        }

        if(empty($file)){
            throw new \Exception('file is required');
        }

        if($data['type']=='project'){
            if(empty(arrayValue($data,'project_id'))){
                throw new \Exception('Project id field is required');
            }

            $data['attachable_type']='App\Models\Project';
            $data['attachable_id']=$data['project_id'];
        }
        else{
            if(empty(arrayValue($data,'action_item_id'))){
                throw new \Exception('Action item id field is required');
            }

            $data['attachable_type']='App\Models\ActionItem';
            $data['attachable_id']=$data['action_item_id'];
        }

        DB::beginTransaction();
        $filename=$file->getClientOriginalName();
        $exists=Storage::disk('local')->exists('public/attachments/'.$filename);
        if($exists){
            $filename=rand(000,999).$filename;
        }

        $data['path']=$path=Storage::putFileAs('public/attachments',$file,$filename);
        $data['url']=url(Storage::url($path));

        $attachment=$this->attachmentRepo->create($data);
        if($attachment){
            $media['mime_type']=$fileSystem->mimeType($file);
            $media['size']=$fileSystem->size($file);
            $media['file_name']=basename($path);
            $this->mediaRepo->create($media);

            DB::commit();
            return;
        }
        else{
            DB::rollBack();
            throw new \Exception(config("messages.common_error"));
        }
    }

    public function delete($attachment_id)
    {
        if(empty($attachment_id)){
            throw new \Exception("attachment_id is required");
        }

        $attachment=$this->attachmentRepo->find($attachment_id);
        if($attachment){
            $file_exists = Storage::disk('local')->exists($attachment->path);
            if(!$file_exists){
                throw new \Exception("Attachment not found");
            }

            DB::beginTransaction();
//            $file_delete=Storage::disk('local')->delete($attachment->path);
//            if($file_delete){
                $query=$this->attachmentRepo->deleteRecord($attachment);
                if($query){
                    DB::commit();
                    return "Attachment has been removed";
                }
                else{
                    DB::rollBack();
                    throw new \Exception(config('messages.common_error'));
                }
//            }
//            else{
//                DB::rollBack();
//                throw new \Exception("Something went wrong, try again later");
//            }
        }
        else{
            throw new \Exception("Attachment not found");
        }

    }
}