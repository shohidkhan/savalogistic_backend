<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnnexRate extends Model
{
    protected $guarded =  [];

    public function country(){
        return $this->belongsTo(Country::class,'country_id');
    }
}
