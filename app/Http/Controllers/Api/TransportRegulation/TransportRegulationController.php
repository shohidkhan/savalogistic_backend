<?php

namespace App\Http\Controllers\Api\TransportRegulation;

use App\Http\Controllers\Controller;
use App\Models\Compliance;
use App\Models\TransportRegulation;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class TransportRegulationController extends Controller
{
    use ApiResponse;

    public function getTransportRegulationData(){
        $getTransportRegulationData=TransportRegulation::select('id','description')->latest()->get();
        $compliances=Compliance::select('title','description')->latest()->get();
        $data=[
            'getTransportRegulationData'=>$getTransportRegulationData,
            'compliances'=>$compliances,
        ];

        return $this->success($data,'Transport Regulation data',200);

    }
}
