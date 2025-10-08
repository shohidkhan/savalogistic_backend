<?php

namespace App\Http\Controllers\Api\CMS;

use App\Enums\PageEnum;
use App\Enums\SectionEnum;
use App\Http\Controllers\Controller;
use App\Models\CMS;
use App\Models\OurHistory;
use App\Models\Team;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    use ApiResponse;

    public function getAbout(){
        $about=CMS::select(['image_url','description'])->where('page_name',PageEnum::ABOUT)->where('section_name',SectionEnum::ABOUT)->first();
        $teams=Team::select('name','image','bio','twitter','instagram','linkedin','position')->latest()->get();
        $savaOperation=CMS::select('offices','countries','employees')->where('page_name',PageEnum::ABOUT)->where('section_name',SectionEnum::ABOUT_SAVA)->first();
        $histories=OurHistory::select('type','date','image','description','title')->latest()->get();
        $aboutPageData=[
            'aboutSection'=>$about,
            'teams'=>$teams,
            'savaOperation'=>$savaOperation,
            'histories'=>$histories,
        ];
        return $this->success($aboutPageData,'About page Data',200);
    }
}
