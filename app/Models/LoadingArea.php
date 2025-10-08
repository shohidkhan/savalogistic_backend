<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoadingArea extends Model
{
    protected $guarded  = [];

    public function loadingZone(){
        return $this->belongsTo(LoadingZone::class,'loading_zone_id');
    }
}
