<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    protected $hidden=[
        'attachable_id',
        'attachable_type',
    ];

    protected $fillable=[
        'attachable_id',
        'attachable_type',
        'url',
        'path',
    ];

    public function attachable(){
        $this->morphTo();
    }
}
