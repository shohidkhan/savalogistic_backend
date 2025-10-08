<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    use ApiResponse;

    public function index(){
        $countries=Country::select('id','name','code')->latest()->get();
        return $this->success($countries,'All EU Countries.',200);
    }
}
