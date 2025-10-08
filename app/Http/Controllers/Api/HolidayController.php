<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class HolidayController extends Controller
{
    use ApiResponse;

    public function index(Request $request){
        $country = $request->country_code;
        $year = $request->year;
        $month = (int) $request->month;

        $params = [
            'api_key' => config('services.calendarific.api_key'),
            'country' => $country,
            'year' => $year,
        ];

        if ($month) {
            $params['month'] = $month;
        }

        $response = Http::get('https://calendarific.com/api/v2/holidays', $params);


        $data = json_decode($response->body(), true);
        // return $data;
         if ($response->failed() || isset($data['meta']['error_detail'])) {
            $errorMessage = $data['meta']['error_detail']
                ?? $data['meta']['error_type']
                ?? 'Unknown API error';

            return response()->json(['error' => $errorMessage], $response->status());
        }


        $holidaysRaw = $data['response']['holidays'] ?? [];
        $countryName = $holidaysRaw[0]['country']['name'] ?? null;
        $monthName = $month ? Carbon::create()->month($month)->format('F') : null;

        // Extract only name and date
        $holidays = collect($data['response']['holidays'] ?? [])->map(function ($holiday) {
            return [
                'name' => $holiday['name'],
                'date' => $holiday['date'],
            ];
        });

        // return response()->json($holidays->values());
        return $this->success($holidays->values(),"Holidays for the $monthName of the $countryName",200);
    }

}
