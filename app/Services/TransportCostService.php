<?php

namespace App\Services;

use App\Exceptions\ServiceException;
use App\Models\{
    LoadingArea,
    UnloadingArea,
    PickupCost,
    UnloadingPrice,
    RomaniaPickupCost,
    Country,
    ShippingPrice
};
use App\Traits\ApiResponse;
use Exception;

class TransportCostService
{
    use ApiResponse;
    public function calculate($request)
    {
        // try{
            $ldm = $request->ldm;
            $grossWeight = $request->gross_weight;
            $grossWeightToldm = round($grossWeight / 1750, 2);
            $useValue = max($ldm, $grossWeightToldm);

            $loadingArea = LoadingArea::whereHas('loadingZone', function ($query) use ($request) {
                $query->where('country_id', $request->loading_country_id);
            })->where('postal_code', 'LIKE', $request->loading_postal_code . '%')->first();



             if (!$loadingArea) {
                throw new ServiceException("Loading area not found for the given postal code and country", 404);
            }

            $loadingPickCosts = PickupCost::with('ldm')->where('loading_zone_id', $loadingArea->loading_zone_id)->get();


            if ($loadingPickCosts->isEmpty()) {
                throw new ServiceException("No pickup costs found for the loading area", 404);
            }


            $unloadingArea = UnloadingArea::with('unloadingZone')->whereHas('unloadingZone', function ($query) use ($request) {
                $query->where('country_id', $request->unloading_country_id);
            })->where('postal_code', 'LIKE', $request->unloading_postal_code . '%')->first();


            if (!$unloadingArea) {
                throw new ServiceException("Unloading area not found for the given postal code and country", 404);
            }

            $deliverCosts = UnloadingPrice::with('ldm')->where('unloading_zone_id', $unloadingArea->unloading_zone_id)->get();


            if ($deliverCosts->isEmpty()) {
                throw new ServiceException("No unloading costs found for the unloading area", 404);
            }

            $unLoadCountry = Country::find($request->unloading_country_id);


            $existsPrice =  ShippingPrice::where('unloading_country_id',$request->unloading_country_id)
                ->where('unloading_area_id', $unloadingArea->id)
                ->where('loading_country_id', $request->loading_country_id)
                ->where('loading_area_id', $loadingArea->id)
                ->where('shipping_date', $request->shipping_date)
                ->exists();

            // if ($existsPrice) {
            //     return $this->error([], 'Shipping price already exists for this route and date', 422);
            // }

            if ($unLoadCountry->code === 'RO') {
                $romaniaTransportCosts = RomaniaPickupCost::with('ldm')->get();
                $matchedRomaniaPickUpCost = $this->matchLDM($romaniaTransportCosts, $useValue);
                $matchedPickUpCost = $this->matchLDM($loadingPickCosts, $useValue);
                $matchedDeliverCost = $this->matchLDM($deliverCosts, $useValue);

                $totalCost = $matchedRomaniaPickUpCost->cost + $matchedPickUpCost->cost + $matchedDeliverCost->cost;
            } else {
                $matchedPickUpCost = $this->matchLDM($loadingPickCosts, $useValue);
                $matchedDeliverCost = $this->matchLDM($deliverCosts, $useValue);

                $totalCost = $matchedPickUpCost->cost + $matchedDeliverCost->cost;
            }

            if ($request->is_ard) {
                $adr_fee = round($totalCost * 0.20,2); // 20% ADR fee
                $totalCost += ($totalCost * 0.20);
            }

            //  dd($totalCost);

            // return $loadingArea->id;
            ShippingPrice::create([
                'loading_country_id' => $request->loading_country_id,
                'unloading_country_id' => $request->unloading_country_id,
                'loading_zone_id' => $loadingArea->loading_zone_id,
                'loading_area_id' => $loadingArea->id,
                'unloading_zone_id' => $unloadingArea->unloading_zone_id,
                'unloading_area_id' => $unloadingArea->id,
                'gross_weight' => $request->gross_weight,
                'ldm' => $request->ldm,
                'cargo_type' => $request->cargo_type,
                'shipping_date' => $request->shipping_date,
                'total_price' => round($totalCost, 2),
                'adr_fee' => $adr_fee ?? 0,
            ]);

            $unloadingZone = $unloadingArea->unloadingZone;

        return [
            'total_cost' => round($totalCost, 2),
            'estimated_time' => $unloadingZone->time,
        ];
        // }catch(Exception $e){
        //     return $this->error([],  $e->getMessage(), 500);
        // }
    }

    private function matchLDM($costCollection, $value)
    {
        foreach ($costCollection as $cost) {
            if ($cost->ldm->ldm >= $value) {
                return $cost;
            }
        }

        return $costCollection->last(); // fallback if no match
    }
}
