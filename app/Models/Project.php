<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'assign_by','form_name', 'project_name','project_desc','project_status','status'
    ];

    public function assignby(){
        return $this->belongsTo(User::class,'assign_by');
    }


    public function assignments()
    {
        return $this->hasMany(AssignProject::class, 'project_id');
    }


    public function projectComment()
    {
        return $this->hasMany(ProjectComment::class, 'project_id');
    }

    public function projectCommentBy(){
        return $this->belongsTo(User::class,'comment_by');
    }


}
