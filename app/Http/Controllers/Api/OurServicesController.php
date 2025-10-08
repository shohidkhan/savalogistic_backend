<?php

namespace App\Http\Controllers\Api;

use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\OurService;

class OurServicesController extends Controller
{
    use ApiResponse;
    
    public function getServices(Request $request)
    {
        $item = $request->item ?? 4;

        $data = OurService::where('status', 'active')->select('id', 'title', 'description', 'image')->take($item)->latest()->get();

        if ($data->isEmpty()) {
            return $this->error([], 'Services not found', 200);
        }

        return $this->success($data, 'Services fetch Successful!', 200);
    }

    public function getServicesFeature(Request $request, int $id)
    {
        $data = OurService::with('OurServiceFeatures')->where('id', $id)->first();

        if (!$data) {
            return $this->error([], 'Services not found', 200);
        }

        return $this->success($data, 'Services fetch Successful!', 200);
    }
        
}
