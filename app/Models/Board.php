<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
   protected $fillable=[
       'project_id',
       'name',
   ];

   public function processes()
   {
       return $this->hasMany(Process::class);
   }

   public function actionItems(){
       return $this->hasManyThrough(ActionItem::class, Process::class);
   }

   public function project()
   {
       return $this->belongsTo(Project::class);
   }
}
