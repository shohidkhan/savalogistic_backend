<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UnloadingPrice extends Model
{
    protected $guarded =  [];

    public function ldm()
    {
        return $this->belongsTo(LDM::class);
    }

    public function unloadingZone()
    {
        return $this->belongsTo(UnloadingZone::class);
    }
}
