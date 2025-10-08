<?php

namespace App\Http\Controllers\Web\Backend\UnloadingArea;

use App\Http\Controllers\Controller;
use App\Models\UnloadingArea;
use App\Models\UnloadingZone;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class UnloadingAreaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
         if ($request->ajax()) {
            $data = UnloadingArea::with('unloadingZone')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('unloading_zone_id',function($data){
                    // dd($data);
                    $zone = $data->unloadingZone->name;
                    // dd($zone);
                    return $zone;
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
                              <a href="' . route('admin.unloading_area.edit', ['unloading_area' => $data->id]) . '" class="text-white btn btn-primary" title="Edit">
                              <i class="bi bi-pencil"></i>
                              </a>
                              <a href="#" onclick="showDeleteConfirm(' . $data->id . ')" type="button" class="text-white btn btn-danger" title="Delete">
                              <i class="bi bi-trash"></i>
                            </a>
                            </div></div>';
                })
                ->rawColumns(['action','status','unloading_area_id'])
                ->make(true);
        }
        return view('backend.layouts.unloading_area.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $zones = UnloadingZone::all();

        return view('backend.layouts.unloading_area.create',compact('zones'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){
        $request->validate([
            'unloading_zone_id' => 'required|exists:loading_zones,id',
            'area_name' => 'required|string',
            'postal_code' => 'required|string',
        ]);

        UnloadingArea::create([
            'unloading_zone_id' => $request->input('unloading_zone_id'),
            'postal_code' => $request->input('postal_code'),
            'area_name' => $request->input('area_name'),
        ]);

        return to_route('admin.unloading_area.index')->with('t-success', 'Annex Rate created successfully.');
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
        $data = UnloadingArea::findOrFail($id);
         $zones = UnloadingZone::all();
        return view('backend.layouts.unloading_area.edit', compact('data','zones'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id){
        $request->validate([
            'unloading_zone_id' => 'required|exists:loading_zones,id',
            'area_name' => 'required|string',
            'postal_code' => 'required|string',
        ]);

        $UnloadingArea = UnloadingArea::findOrFail($id);

        $UnloadingArea->unloading_zone_id = $request->input('unloading_zone_id');
        $UnloadingArea->area_name = $request->input('area_name');
        $UnloadingArea->postal_code = $request->input('postal_code');
        $UnloadingArea->save();

        return to_route('admin.unloading_area.index')->with('t-success', 'Annex updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $unloadingArea= UnloadingArea::findOrFail($id);


        $unloadingArea->delete();
        return response()->json([
            'success' => true,
            'message' => 'Annex deleted successfully.',
        ]);
    }

    public function  status($id){

        $data = UnloadingArea::find($id);
        // dd($data->status);
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
