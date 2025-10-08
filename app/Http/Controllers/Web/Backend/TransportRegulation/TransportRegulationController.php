<?php

namespace App\Http\Controllers\Web\Backend\TransportRegulation;

use App\Http\Controllers\Controller;
use App\Models\TransportRegulation;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TransportRegulationController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
         if ($request->ajax()) {
            $data = TransportRegulation::latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()

                ->addColumn('description',function($data){
                    $short_desc=$data->description;

                    $short_desc_content = strlen($short_desc) > 60 ? substr($short_desc,0,50).'...':$short_desc;

                    return "$short_desc_content";
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
                              <a href="' . route('admin.transport-regulation.edit', ['transport_regulation' => $data->id]) . '" class="text-white btn btn-primary" title="Edit">
                              <i class="bi bi-pencil"></i>
                              </a>
                              <a href="#" onclick="showDeleteConfirm(' . $data->id . ')" type="button" class="text-white btn btn-danger" title="Delete">
                              <i class="bi bi-trash"></i>
                            </a>
                            </div></div>';
                })
                ->rawColumns(['action','status','description'])
                ->make(true);
        }
        return view('backend.layouts.transport-regulation.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.layouts.transport-regulation.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'description'=>'required|string',
        ]);


        TransportRegulation::create([
            'description'=>$request->description,
        ]);




        return to_route('admin.transport-regulation.index')->with('t-success', 'Transport regulation  created successfully.');
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
        $data = TransportRegulation::findOrFail($id);
        return view('backend.layouts.transport-regulation.edit', compact('data',));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $request->validate([
            'description'=>'required|string',
        ]);


        $TransportRegulation=TransportRegulation::findOrFail($id);
        $TransportRegulation->description=$request->description;
        $TransportRegulation->save();

        return to_route('admin.transport-regulation.index')->with('t-success', 'transport-regulation member updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $TransportRegulation= TransportRegulation::findOrFail($id);

        $TransportRegulation->delete();
        return response()->json([
            'success' => true,
            'message' => 'Regulation deleted successfully.',
        ]);
    }

    public function  status($id){

        $data = TransportRegulation::findOrFail($id);

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
