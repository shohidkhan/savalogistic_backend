<?php

namespace App\Http\Controllers\Web\Backend\LoadingArea;

use App\Http\Controllers\Controller;
use App\Models\LoadingArea;
use App\Models\LoadingZone;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class LoadingAreaController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
         if ($request->ajax()) {
            $data = LoadingArea::with('loadingZone')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('loading_area_id',function($data){
                    $zone=$data->loadingZone->name;
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
                              <a href="' . route('admin.loading_area.edit', ['loading_area' => $data->id]) . '" class="text-white btn btn-primary" title="Edit">
                              <i class="bi bi-pencil"></i>
                              </a>
                              <a href="#" onclick="showDeleteConfirm(' . $data->id . ')" type="button" class="text-white btn btn-danger" title="Delete">
                              <i class="bi bi-trash"></i>
                            </a>
                            </div></div>';
                })
                ->rawColumns(['action','status','loading_area_id'])
                ->make(true);
        }
        return view('backend.layouts.loading_area.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $zones = LoadingZone::all();

        return view('backend.layouts.loading_area.create',compact('zones'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){
        $request->validate([
            'loading_zone_id' => 'required|exists:loading_zones,id',
            'area_name' => 'required|string',
            'postal_code' => 'required|string',
        ]);

        LoadingArea::create([
            'loading_zone_id' => $request->input('loading_zone_id'),
            'postal_code' => $request->input('postal_code'),
            'area_name' => $request->input('area_name'),
        ]);

        return to_route('admin.loading_area.index')->with('t-success', 'Annex Rate created successfully.');
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
        $data = LoadingArea::findOrFail($id);
         $zones = LoadingZone::all();
        return view('backend.layouts.loading_area.edit', compact('data','zones'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id){
        $request->validate([
            'loading_zone_id' => 'required|exists:loading_zones,id',
            'area_name' => 'required|string',
            'postal_code' => 'required|string',
        ]);

        $LoadingArea = LoadingArea::findOrFail($id);

        $LoadingArea->loading_zone_id = $request->input('loading_zone_id');
        $LoadingArea->area_name = $request->input('area_name');
        $LoadingArea->postal_code = $request->input('postal_code');
        $LoadingArea->save();

        return to_route('admin.loading_area.index')->with('t-success', 'Annex updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $annex= LoadingArea::findOrFail($id);


        $annex->delete();
        return response()->json([
            'success' => true,
            'message' => 'Annex deleted successfully.',
        ]);
    }

    public function  status($id){

        $data = LoadingArea::findOrFail($id);

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
