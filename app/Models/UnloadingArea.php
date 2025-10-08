<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UnloadingArea extends Model
{
    protected $guarded = [];


    public function unloadingZone(){
        return $this->belongsTo(UnloadingZone::class,'unloading_zone_id');
    }
}
