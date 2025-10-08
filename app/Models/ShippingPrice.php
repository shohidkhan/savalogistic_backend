<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingPrice extends Model
{
    protected $guarded = [];


    public function loadingArea(){
        return $this->belongsTo(LoadingArea::class, 'loading_area_id');
    }

    public function unloadingArea(){
        return $this->belongsTo(UnloadingArea::class, 'unloading_area_id');
    }

    public function loadingCountry(){
        return $this->belongsTo(Country::class, 'loading_country_id');
    }
    public function unloadingCountry(){
        return $this->belongsTo(Country::class, 'unloading_country_id');
    }

    public function loadingZone(){
        return $this->belongsTo(LoadingZone::class, 'loading_zone_id');
    }
    public function unloadingZone(){
        return $this->belongsTo(UnloadingZone::class, 'unloading_zone_id');
    }


}
