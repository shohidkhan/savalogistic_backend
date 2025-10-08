<?php

namespace App\Http\Controllers\Api\Certification;

use App\Http\Controllers\Controller;
use App\Models\Award;
use App\Models\Certificate;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class CertificationController extends Controller
{
    use ApiResponse;

    public function getCertificationPageData(){
        $certificates=Certificate::select('id','title','issued_by','image','is_verified')->latest()->get();
        $awards=Award::select('id','name','award_subject','image','year')->latest()->get();

        $certificationsData=[
            'certificates'=>$certificates,
            'awards'=>$awards,
        ];

        return $this->success($certificationsData,'certificate page data',200);
    }

    public function certificateView($id){
        $certificate=Certificate::findOrFail($id);

        if(!$certificate->image){
            return $this->error([],'Certificate view not found',200);
        }

        $certificateImage=$certificate->image;

        return $this->success($certificateImage,'Get certificate view',200);
    }
    public function awardView($id){
        $award=Award::findOrFail($id);

        if(!$award->image){
            return $this->error([],'award view not found',200);
        }

        $awardImage=$award->image;

        return $this->success($awardImage,'Get award view',200);
    }
}
