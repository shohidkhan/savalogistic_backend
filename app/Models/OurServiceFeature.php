<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OurServiceFeature extends Model
{
    protected $guarded = [];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'id' => 'integer',
        'our_service_id' => 'integer',
    ];

    public function ourService()
    {
        return $this->belongsTo(OurService::class);
    }
}
