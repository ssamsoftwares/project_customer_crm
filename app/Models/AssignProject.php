<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignProject extends Model
{
    use HasFactory;

    protected $fillable = [
        'assign_by','customer_id','project_id'
    ];

    public function assignby(){
        return $this->belongsTo(User::class,'assign_by');
    }

    public function customer(){
        return $this->belongsTo(User::class,'customer_id');
    }

    public function project(){
        return $this->belongsTo(Project::class,'project_id');
    }

}
