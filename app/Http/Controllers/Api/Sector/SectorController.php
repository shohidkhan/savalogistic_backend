<?php

namespace App\Http\Controllers\Api\Sector;

use App\Http\Controllers\Controller;
use App\Models\Sector;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class SectorController extends Controller
{
    use ApiResponse;

    public function getAllSectors(){
        $sectors=Sector::select('id','title','sub_title','icon')->latest()->get();

        if($sectors->isEmpty()){
            return $this->error([],'Service Sectors not found',422);
        }

        return $this->success($sectors,'Service Sectors',200);
    }

    public function getCompanies($id){
        $sector=Sector::findOrFail($id);
        if(!$sector){
            return $this->error([],'Service Sector not found',422);
        }

        $companies = $sector->companies()->select('id', 'sector_id', 'logo')->get();

        if($companies->isEmpty()){
            return $this->error([],'This Service Sector has no company',422);
        }
        return $this->success($companies,'Service Sectors',200);
    }
}
