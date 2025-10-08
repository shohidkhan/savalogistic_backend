<?php

namespace App\Http\Controllers\Web\Backend\RomaniaPickUpCost;

use App\Http\Controllers\Controller;
use App\Models\LDM;
use App\Models\RomaniaPickupCost;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class RomaniaPickUpCostController extends Controller
{
   /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
         if ($request->ajax()) {
            $data = RomaniaPickupCost::with('ldmValue')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('ldm_id',function($data){
                    return $data->ldmValue ? $data->ldmValue->ldm : '-';
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
                              <a href="' . route('admin.ro_pickup_cost.edit', ['ro_pickup_cost' => $data->id]) . '" class="text-white btn btn-primary" title="Edit">
                              <i class="bi bi-pencil"></i>
                              </a>
                              <a href="#" onclick="showDeleteConfirm(' . $data->id . ')" type="button" class="text-white btn btn-danger" title="Delete">
                              <i class="bi bi-trash"></i>
                            </a>
                            </div></div>';
                })
                ->rawColumns(['action','status','ldm_id'])
                ->make(true);
        }
        return view('backend.layouts.ro_pickup_cost.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $ldms = LDM::all();

        return view('backend.layouts.ro_pickup_cost.create',compact('ldms'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){
        $request->validate([
            'cost' => 'required|numeric',
            'ldm_id' => 'required|exists:l_d_m_s,id',
        ]);

        RomaniaPickupCost::create([
            'cost' => $request->input('cost'),
            'ldm_id' => $request->input('ldm_id'),
        ]);

        return to_route('admin.ro_pickup_cost.index')->with('t-success', 'Romania pickup cost created successfully.');
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
        $data = RomaniaPickupCost::findOrFail($id);
        // dd($data);
        $ldms = LDM::all();
        return view('backend.layouts.ro_pickup_cost.edit', compact('data','ldms'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id){
        $request->validate([
            'cost' => 'required|numeric',
            'ldm_id' => 'required|exists:l_d_m_s,id',
        ]);

        $PickupCost = RomaniaPickupCost::findOrFail($id);
        $PickupCost->cost = $request->input('cost');
        $PickupCost->ldm_id = $request->input('ldm_id');
        $PickupCost->save();

        return to_route('admin.ro_pickup_cost.index')->with('t-success', 'Romania pickup cost updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $annex= RomaniaPickupCost::findOrFail($id);


        $annex->delete();
        return response()->json([
            'success' => true,
            'message' => 'Recogida deleted successfully.',
        ]);
    }

    public function  status($id){

        $data = RomaniaPickupCost::findOrFail($id);

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
