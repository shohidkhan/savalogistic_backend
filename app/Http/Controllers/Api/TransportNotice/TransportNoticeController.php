<?php

namespace App\Http\Controllers\Api\TransportNotice;

use App\Http\Controllers\Controller;
use App\Models\TransportNotice;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransportNoticeController extends Controller
{
    use ApiResponse;

    public function index(){
       $data = TransportNotice::select('id','title','sub_title','code','file','date')
                            ->latest()
                            ->get();

        if($data->isEmpty()){
            return $this->error([],'No data found.',422);
        }
        return $this->success($data,'Transport Notice data',200);
    }
}
