<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UnloadingZone extends Model
{
    protected $guarded =  [];

    public function country(){
        return $this->belongsTo(Country::class,'country_id');
    }
}
