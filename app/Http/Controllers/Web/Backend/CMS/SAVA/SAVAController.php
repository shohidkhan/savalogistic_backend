<?php

namespace App\Http\Controllers\Web\Backend\CMS\SAVA;

use App\Enums\PageEnum;
use App\Enums\SectionEnum;
use App\Http\Controllers\Controller;
use App\Models\CMS;
use Illuminate\Http\Request;

class SAVAController extends Controller
{
    public function index(){
        $data=CMS::where('page_name',PageEnum::ABOUT)->where('section_name',SectionEnum::ABOUT_SAVA)->first();
        return view('backend.layouts.cms.about.sava.index', compact('data'));
    }

    public function store(Request $request){
        $request->validate([
            'offices' => 'required|numeric',
            'countries' => 'required|numeric',
            'employees' => 'required|numeric',
        ]);

        $data = CMS::updateOrCreate(
            ['page_name' => PageEnum::ABOUT, 'section_name' => SectionEnum::ABOUT_SAVA],
            [
                'countries' => $request->countries,
                'offices' => $request->offices,
                'employees' => $request->employees,
            ]
        );

        $message = $data->wasRecentlyCreated ? 'SAVA data created successfully.' : 'SAVA data updated successfully.';
        return redirect()->back()->with('t-success', $message);
    }
}
