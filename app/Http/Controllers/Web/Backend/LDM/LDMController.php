<?php

namespace App\Http\Controllers\Web\Backend\LDM;

use App\Http\Controllers\Controller;
use App\Models\LDM;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class LDMController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
         if ($request->ajax()) {
            $data = LDM::all();

            return DataTables::of($data)
                ->addIndexColumn()
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
                              <a href="' . route('admin.ldm.edit', ['ldm' => $data->id]) . '" class="text-white btn btn-primary" title="Edit">
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
        return view('backend.layouts.ldm.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('backend.layouts.ldm.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){
        $request->validate([
            'ldm' => 'required|numeric',
        ]);


        LDM::create([
            'ldm' => $request->input('ldm'),
        ]);

        return to_route('admin.ldm.index')->with('t-success', 'LDM created successfully.');
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
        $data = LDM::findOrFail($id);
        return view('backend.layouts.ldm.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id){
         $request->validate([
            'ldm' => 'required|numeric',
        ]);


        $LDM = LDM::findOrFail($id);



        $LDM->ldm = $request->input('ldm');
        $LDM->save();

        return to_route('admin.ldm.index')->with('t-success', 'LDM updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ldm= LDM::findOrFail($id);


        $ldm->delete();
        return response()->json([
            'success' => true,
            'message' => 'LDM deleted successfully.',
        ]);
    }

    public function  status($id){

        $data = LDM::findOrFail($id);

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
