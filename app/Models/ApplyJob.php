<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApplyJob extends Model
{
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function jobPlaceMent(){
        return $this->belongsTo(JobPlacement::class,'job_placement_id');
    }
}
