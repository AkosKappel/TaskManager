<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ['file', 'task_id'];

    public function task()
    {
        return $this->belongsTo('App\Task');
    }

}
