<?php

namespace App\Models;
use App\Models\Webinar;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    protected $guarded = [];


    public function course(){

        return $this->belongsTo(Webinar::class,'webinar_id','id');
    }
}
