<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RomaniaPickupCost extends Model
{
    protected $guarded = [];

    public function ldm(){
        return $this->belongsTo(LDM::class, 'ldm_id');
    }
}
