<?php
namespace App\Models;


use App\User;
use App\Models\Assignment;
use Illuminate\Database\Eloquent\Model;

class AssignmentUpload extends Model
{
    protected $guarded = [];

    public function course(){

        return $this->belongsTo(Assignment::class,'assignment_id','id');
    }

    public function user(){

        return $this->belongsTo(User::class,'user_id','id');
    }
}
