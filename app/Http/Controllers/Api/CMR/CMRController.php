<?php

namespace App\Http\Controllers\Api\CMR;

use App\Http\Controllers\Controller;
use App\Models\CMR;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class CMRController extends Controller
{
    use ApiResponse;

    public function index(){
        $cmr=CMR::latest()->first();

        if(!$cmr){
            return $this->error([],'CMR Data not found',422);
        }

        $cmr_main=[
            'title'=>$cmr->title,
            'sub_title'=>$cmr->sub_title,
            'description'=>$cmr->description,
            'data'=>
                         [
                            [ 'overview' => $cmr->overview,'type'=>'overview' ],
                            [ 'sender_responsibilities' => $cmr->sender_responsibilities,'type'=>'sender' ],
                            [ 'carrier_responsibilities' => $cmr->carrier_responsibilities,'type'=>'carrier' ],
                        ]

                ];

        return $this->success($cmr_main,'CMR convention data.',200);

    }
}
