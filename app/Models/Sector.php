<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    protected $guarded=[];


    public function companies(){
        return $this->hasMany(Company::class,'sector_id');
    }
}
