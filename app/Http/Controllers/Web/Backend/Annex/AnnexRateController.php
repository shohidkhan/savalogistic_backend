<?php

namespace App\Http\Controllers\Web\Backend\Annex;

use App\Http\Controllers\Controller;
use App\Models\AnnexRate;
use App\Models\Country;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AnnexRateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
         if ($request->ajax()) {
            $data = AnnexRate::with('country')->latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('country_id',function($data){
                    $country=$data->country->name;
                    return $country;
                })
                ->addColumn('segment',function($data){

                    return $data->segment ?? 'N/A';
                })
                ->addColumn('status', function ($data) {
                    $status = ' <div class="form-check form-switch">';
                    $status .= ' <input onclick="showStatusChangeAlert(' . $data->id . ')" type="checkbox" class="form-check-input" id="customSwitch' . $data->id . '" getAreaid="' . $data->id . '" name="status"';
                    if ($data->status == "active") {
                        $status .= "checked";
                    }
                    $status .= '><label for="customSwitch' . $data->id . '" class="form-check-label" for="customSwitch"></label></div>';

                    return $status;
                })
                ->addColumn('action', function ($data) {
                    return '<div class="text-center"><div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                              <a href="' . route('admin.annex_rate.edit', ['annex_rate' => $data->id]) . '" class="text-white btn btn-primary" title="Edit">
                              <i class="bi bi-pencil"></i>
                              </a>
                              <a href="#" onclick="showDeleteConfirm(' . $data->id . ')" type="button" class="text-white btn btn-danger" title="Delete">
                              <i class="bi bi-trash"></i>
                            </a>
                            </div></div>';
                })
                ->rawColumns(['action','status','country_id','segment'])
                ->make(true);
        }
        return view('backend.layouts.annex_rate.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countries = Country::all();

        return view('backend.layouts.annex_rate.create',compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){
        $request->validate([
            'country_id' => 'required|exists:countries,id',
            'segment' => 'nullable|in:FR,CH',
            'margin' => 'required|numeric',
            'price_per_km' => 'required|numeric',
            'week' => 'required|numeric',
        ]);

        $existCountryWeekWise = AnnexRate::where('country_id', $request->country_id)
            ->where('week', $request->week)
            ->exists();

        if ($existCountryWeekWise) {
            return redirect()->back()->with('t-error', 'Already Price set up for this country and week.');
        }

        AnnexRate::create([
            'country_id' => $request->country_id,
            'segment' => $request->segment,
            'margin' => $request->margin,
            'price_per_km' => $request->price_per_km,
            'week' => $request->week,
        ]);

        return to_route('admin.annex_rate.index')->with('t-success', 'Annex Rate created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = AnnexRate::findOrFail($id);
        $countries = Country::all();
        return view('backend.layouts.annex_rate.edit', compact('data','countries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id){
        $request->validate([
            'country_id' => 'required|exists:countries,id',
            'segment' => 'nullable|in:FR,CH',
            'margin' => 'required|numeric',
            'price_per_km' => 'required|numeric',
            'week' => 'required|numeric',
        ]);

        $annexRate = AnnexRate::findOrFail($id);

        // Check for existing record with same country_id and week but different ID
        $exists = AnnexRate::where('country_id', $request->country_id)
            ->where('week', $request->week)
            ->where('id', '!=', $id)
            ->exists();

        if ($exists) {
            return redirect()->back()->with('t-error', 'Another entry with the same country and week already exists.');
        }

        $annexRate->country_id = $request->country_id;
        $annexRate->segment = $request->segment;
        $annexRate->margin = $request->margin;
        $annexRate->price_per_km = $request->price_per_km;
        $annexRate->week = $request->week;
        $annexRate->save();

        return to_route('admin.annex_rate.index')->with('t-success', 'Annex updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $annex= AnnexRate::findOrFail($id);


        $annex->delete();
        return response()->json([
            'success' => true,
            'message' => 'Annex deleted successfully.',
        ]);
    }

    public function  status($id){

        $data = AnnexRate::findOrFail($id);

         if ($data->status == 'inactive') {

            // return $data;
            $data->status = 'active';
            $data->save();

            return response()->json([
                'success' => true,
                'message' => 'Published Successfully.',
                'data'    => $data,
            ]);
        } else {
            $data->status = 'inactive';
            $data->save();

            return response()->json([
                'success' => false,
                'message' => 'Unpublished Successfully.',
                'data'    => $data,
            ]);
        }
    }
}
