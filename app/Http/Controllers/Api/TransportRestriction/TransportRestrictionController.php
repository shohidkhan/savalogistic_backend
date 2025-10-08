<?php

namespace App\Http\Controllers\Api\TransportRestriction;

use App\Http\Controllers\Controller;
use App\Models\TransportRestriction;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class TransportRestrictionController extends Controller
{
    use ApiResponse;

    public function getTransportRestrictionData(Request $request){
        $getTransportRestrictionData = TransportRestriction::select('id', 'country_id', 'description')->with('country:id,name')
        ->when($request->filled('country_id'), function ($query) use ($request) {
            $query->where('country_id', $request->country_id);
        })
        ->latest()
        ->get();

        if($getTransportRestrictionData->isEmpty()){
            return $this->error([],'No data found.',422);
        }

        return $this->success($getTransportRestrictionData,'transport restriction data.',200);
    }
}
