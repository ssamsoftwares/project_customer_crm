<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectCommentNotification extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id','notification_msg','status'
    ];


    public function project(){
        return $this->belongsTo(Project::class,'project_id');
    }

    
}
