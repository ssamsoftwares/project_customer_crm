<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id','comment_by','comment'
    ];


    public function project(){
        return $this->belongsTo(Project::class,'project_id');
    }

    public function commentBy(){
        return $this->belongsTo(User::class,'comment_by');
    }
}
