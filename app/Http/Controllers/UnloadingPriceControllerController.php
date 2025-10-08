<?php

namespace App\Http\Controllers;

use App\Models\LDM;
use App\Models\UnloadingPrice;
use App\Models\UnloadingZone;
use App\Models\Web\Backend\UnloadingPrice\UnloadingPriceController;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class UnloadingPriceControllerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
         if ($request->ajax()) {
            $data = UnloadingPrice::with('unloadingZone','ldm')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('unloading_zone_id',function($data){
                    $zone=$data->unloadingZone->name;
                    return $zone;
                })
                ->addColumn('ldm_id',function($data){
                    $ldm=$data->ldm->ldm;
                    return $ldm;
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
                              <a href="' . route('admin.unloading_price.edit', ['unloading_price' => $data->id]) . '" class="text-white btn btn-primary" title="Edit">
                              <i class="bi bi-pencil"></i>
                              </a>
                              <a href="#" onclick="showDeleteConfirm(' . $data->id . ')" type="button" class="text-white btn btn-danger" title="Delete">
                              <i class="bi bi-trash"></i>
                            </a>
                            </div></div>';
                })
                ->rawColumns(['action','status','ununloading_zone_id','ldm_id'])
                ->make(true);
        }
        return view('backend.layouts.unloading_price.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $zones = UnloadingZone::all();
        $ldms = LDM::all();

        return view('backend.layouts.unloading_price.create',compact('zones','ldms'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){
        $request->validate([
            'unloading_zone_id' => 'required|exists:unloading_zones,id',
            'cost' => 'required|numeric',
            'ldm_id' => 'required|exists:l_d_m_s,id',
        ]);

        UnloadingPrice::create([
            'unloading_zone_id' => $request->input('unloading_zone_id'),
            'cost' => $request->input('cost'),
            'ldm_id' => $request->input('ldm_id'),
        ]);

        return to_route('admin.unloading_price.index')->with('t-success', 'Recogida  created successfully.');
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
        $data = UnloadingPrice::findOrFail($id);
        $zones = UnloadingZone::all();
        $ldms = LDM::all();
        return view('backend.layouts.unloading_price.edit', compact('data','zones','ldms'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id){
        $request->validate([
            'unloading_zone_id' => 'required|exists:loading_zones,id',
            'cost' => 'required|numeric',
            'ldm_id' => 'required|exists:l_d_m_s,id',
        ]);

        $UnloadingPrice = UnloadingPrice::findOrFail($id);

        $UnloadingPrice->unloading_zone_id = $request->input('unloading_zone_id');
        $UnloadingPrice->cost = $request->input('cost');
        $UnloadingPrice->ldm_id = $request->input('ldm_id');
        $UnloadingPrice->save();

        return to_route('admin.unloading_price.index')->with('t-success', 'Recogida updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $annex= UnloadingPrice::findOrFail($id);


        $annex->delete();
        return response()->json([
            'success' => true,
            'message' => 'Unloading price deleted successfully.',
        ]);
    }

    public function  status($id){

        $data = UnloadingPrice::findOrFail($id);

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
