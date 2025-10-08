<?php

namespace App\Http\Controllers\Web\Backend\PickupCost;

use App\Http\Controllers\Controller;
use App\Models\LDM;
use App\Models\LoadingZone;
use App\Models\PickupCost;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PickupCostController extends Controller
{
   /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
         if ($request->ajax()) {
            $data = PickupCost::with('loadingZone','ldm')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('loading_zone_id',function($data){
                    $zone=$data->loadingZone->name;
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
                              <a href="' . route('admin.pickup_cost.edit', ['pickup_cost' => $data->id]) . '" class="text-white btn btn-primary" title="Edit">
                              <i class="bi bi-pencil"></i>
                              </a>
                              <a href="#" onclick="showDeleteConfirm(' . $data->id . ')" type="button" class="text-white btn btn-danger" title="Delete">
                              <i class="bi bi-trash"></i>
                            </a>
                            </div></div>';
                })
                ->rawColumns(['action','status','pickup_cost_id','ldm_id'])
                ->make(true);
        }
        return view('backend.layouts.pickup_cost.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $zones = LoadingZone::all();
        $ldms = LDM::all();

        return view('backend.layouts.pickup_cost.create',compact('zones','ldms'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){
        $request->validate([
            'loading_zone_id' => 'required|exists:loading_zones,id',
            'cost' => 'required|numeric',
            'ldm_id' => 'required|exists:l_d_m_s,id',
        ]);

        PickupCost::create([
            'loading_zone_id' => $request->input('loading_zone_id'),
            'cost' => $request->input('cost'),
            'ldm_id' => $request->input('ldm_id'),
        ]);

        return to_route('admin.pickup_cost.index')->with('t-success', 'Recogida  created successfully.');
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
        $data = PickupCost::findOrFail($id);
        $zones = LoadingZone::all();
        $ldms = LDM::all();
        return view('backend.layouts.pickup_cost.edit', compact('data','zones','ldms'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id){
        $request->validate([
            'loading_zone_id' => 'required|exists:loading_zones,id',
            'cost' => 'required|numeric',
            'ldm_id' => 'required|exists:l_d_m_s,id',
        ]);

        $PickupCost = PickupCost::findOrFail($id);

        $PickupCost->loading_zone_id = $request->input('loading_zone_id');
        $PickupCost->cost = $request->input('cost');
        $PickupCost->ldm_id = $request->input('ldm_id');
        $PickupCost->save();

        return to_route('admin.pickup_cost.index')->with('t-success', 'Recogida updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $annex= PickupCost::findOrFail($id);


        $annex->delete();
        return response()->json([
            'success' => true,
            'message' => 'Recogida deleted successfully.',
        ]);
    }

    public function  status($id){

        $data = PickupCost::findOrFail($id);

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
