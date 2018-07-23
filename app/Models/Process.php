<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Process extends Model
{
    protected $fillable = [
        'board_id',
        'name',
        'description',
    ];

    public function board()
    {
        return $this->belongsTo(Board::class);
    }

    public function actionItems()
    {
        return $this->hasMany(ActionItem::class);
    }
}
