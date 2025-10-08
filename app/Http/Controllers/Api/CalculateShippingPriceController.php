<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\ServiceException;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\LoadingArea;
use App\Models\PickupCost;
use App\Models\RomaniaPickupCost;
use App\Models\ShippingPrice;
use App\Models\UnloadingArea;
use App\Models\UnloadingPrice;
use App\Services\TransportCostService;
use App\Traits\ApiResponse;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;
class CalculateShippingPriceController extends Controller
{
     use ApiResponse;
    public function calculateShippingPrice(Request $request, TransportCostService $service){
        try{
             $validator = Validator::make($request->all(),[
                'loading_country_id' => 'required|exists:countries,id',
                'loading_postal_code' => 'required|min:2',
                'cargo_type' => 'required',
                'unloading_country_id' => 'required|exists:countries,id',
                'unloading_postal_code' => 'required|min:2',
                'gross_weight' => 'required|numeric|min:0',
                'ldm' => 'required|numeric|min:0',
                'shipping_date' => 'required|date|after_or_equal:today',
                'is_ard' => 'nullable|boolean',
        ],[
                'loading_country_id.required' => 'Loading country is required',
                'loading_postal_code.required' => 'Loading postal code is required',
                'cargo_type.required' => 'Cargo type is required',
                'unloading_country_id.required' => 'Unloading country is required',
                'unloading_postal_code.required' => 'Unloading postal code is required',
                'gross_weight.required' => 'Gross weight is required',
                'ldm.required' => 'Linear meters is required',
                'loading_country_id.exists' => 'Loading country does not exist',
                'unloading_country_id.exists' => 'Unloading country does not exist',
                'gross_weight.numeric' => 'Gross weight must be a number',
                'ldm.numeric' => 'Linear meters must be a number',
                'gross_weight.min' => 'Gross weight must be at least 0',
                'ldm.min' => 'Linear meters must be at least 0',
                'loading_postal_code.min' => 'Loading postal code must be at least 2 characters',
                'unloading_postal_code.min' => 'Unloading postal code must be at least 2 characters',
                'shipping_date.required' => 'Shipping date is required',
                'shipping_date.date' => 'Shipping date must be a valid date',
                'shipping_date.after_or_equal' => 'Shipping date must be today or a future date',
                'is_ard.boolean' => 'Is ARD must be true or false',
        ]);

        if($validator->fails()){
            return $this->error($validator->errors(),$validator->errors()->first(),422);
        }


        $totalCost = $service->calculate($request);


        return $this->success(['total_cost' => round($totalCost['total_cost']),'estimated_time' => $totalCost['estimated_time']], 'Shipping price calculated successfully',200);



        } catch (ServiceException $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], $e->getStatusCode());
        }
        catch(Exception $e){
            return $this->error([],$e->getMessage(),404);
        }
    }
}
