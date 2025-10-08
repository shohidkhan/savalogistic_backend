<?php

namespace App\Http\Controllers\Web\Backend\UnloadingZone;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\UnloadingZone;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class UnloadingZoneController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
         if ($request->ajax()) {
            $data = UnloadingZone::with('country')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('country_id',function($data){
                    $country=$data->country->name;
                    return $country;
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
                              <a href="' . route('admin.unloading_zone.edit', ['unloading_zone' => $data->id]) . '" class="text-white btn btn-primary" title="Edit">
                              <i class="bi bi-pencil"></i>
                              </a>
                              <a href="#" onclick="showDeleteConfirm(' . $data->id . ')" type="button" class="text-white btn btn-danger" title="Delete">
                              <i class="bi bi-trash"></i>
                            </a>
                            </div></div>';
                })
                ->rawColumns(['action','status','country_id'])
                ->make(true);
        }
        return view('backend.layouts.unloading_zone.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countries = Country::all();

        return view('backend.layouts.unloading_zone.create',compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){
        $request->validate([
            'country_id' => 'required|exists:countries,id',
            'time' => 'required|string',
            'name' => 'required|string|unique:unloading_zones,name,id',
        ]);


        UnloadingZone::create([
            'country_id' => $request->input('country_id'),
            'time' => $request->input('time'),
            'name' => $request->input('name'),
        ]);

        return to_route('admin.unloading_zone.index')->with('t-success', 'Annex Rate created successfully.');
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
        $data = UnloadingZone::findOrFail($id);
        $countries = Country::all();
        return view('backend.layouts.unloading_zone.edit', compact('data','countries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id){
         $request->validate([
            'country_id' => 'required|exists:countries,id',
            'time' => 'required|string',
            'name' => 'required|string|unique:unloading_zones,name,'.$id,
        ]);


        $UnloadingZone = UnloadingZone::findOrFail($id);



        $UnloadingZone->country_id = $request->input('country_id');
        $UnloadingZone->time = $request->input('time');
        $UnloadingZone->name = $request->input('name');
        $UnloadingZone->save();

        return to_route('admin.unloading_zone.index')->with('t-success', 'Annex updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $annex= UnloadingZone::findOrFail($id);


        $annex->delete();
        return response()->json([
            'success' => true,
            'message' => 'Annex deleted successfully.',
        ]);
    }

    public function  status($id){

        $data = UnloadingZone::findOrFail($id);

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
