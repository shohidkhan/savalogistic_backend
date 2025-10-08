<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OurService extends Model
{
    protected $guarded = [];

    protected $hidden = [
        'created_at',
        'updated_at',
        'status',
    ];

    protected $casts = [
        'id' => 'integer',
    ];

    public function OurServiceFeatures()
    {
        return $this->hasMany(OurServiceFeature::class);
    }
}
