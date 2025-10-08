<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PickupCost extends Model
{
    protected $guarded =  [];

    public function ldm(){
        return $this->belongsTo(LDM::class,'ldm_id');
    }

    public function loadingZone()  {
        return $this->belongsTo(LoadingZone::class,'loading_zone_id');
    }
}
