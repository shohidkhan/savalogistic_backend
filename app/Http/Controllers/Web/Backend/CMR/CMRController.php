<?php

namespace App\Http\Controllers\Web\Backend\CMR;

use App\Http\Controllers\Controller;
use App\Models\CMR;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CMRController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = CMR::latest()->first();
        return view('backend.layouts.cmr.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.layouts.cmr.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required|string',
            'sub_title'=>'required|string',
            'description'=>'required|string',
            'icon'=>'nullable|image|mimes:jpeg,png,jpg,gif',
            'overview'=>'required|string',
            'sender_responsibilities'=>'required|string',
            'carrier_responsibilities'=>'required|string',
        ]);


        // dd($request->hasFile('icon'));

        $data = CMR::latest()->first();

        // dd($data);

        // Check if file was uploaded
        if ($request->hasFile('icon')) {
            if ($data && $data->icon) {
                $previousImagePath = public_path($data->icon);
                if (file_exists($previousImagePath)) {
                    unlink($previousImagePath);
                }
            }

            $image = $request->file('icon');
            $imageName = uploadImage($image, 'cmr');


        } else {
            $imageName = $data->icon ?? null;
        }


        //  dd($imageName);

        // Shared data array
        $cmrData = [
            'title' => $request->title,
            'sub_title' => $request->sub_title,
            'description' => $request->description,
            'overview' => $request->overview,
            'sender_responsibilities' => $request->sender_responsibilities,
            'carrier_responsibilities' => $request->carrier_responsibilities,
            'icon' => $imageName,
        ];

        if ($data) {
            // Update existing
            $data->update($cmrData);
        } else {
            // Create new
            CMR::create($cmrData);
        }
        return to_route('admin.cmr.index')->with('t-success', 'cmr  created successfully.');
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
        $data = CMR::findOrFail($id);
        return view('backend.layouts.cmr.edit', compact('data',));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title'=>'required|string',
            'sub_title'=>'required|string',
            'description'=>'required|string',
            'icon'=>'nullable|image|mimes:jpeg,png,jpg,gif',
            'overview'=>'required|string',
            'sender_responsibilities'=>'required|string',
            'carrier_responsibilities'=>'required|string',
        ]);

        $cmr=CMR::findOrFail($id);
            if ($request->hasFile('icon')) {
                 $previousImagePath = public_path($cmr->icon);
                    if (file_exists($previousImagePath)) {
                        unlink($previousImagePath);
                    }
                $image     = $request->file('icon');
                $imageName = uploadImage($image, 'cmr_icon');
            } else {
                $imageName = $cmr->icon;
            }


        $cmr->title=$request->title;
        $cmr->sub_title=$request->sub_title;
        $cmr->description=$request->description;
        $cmr->overview=$request->overview;
        $cmr->icon=$request->overview;
        $cmr->carrier_responsibilities=$request->carrier_responsibilities;
        $cmr->sender_responsibilities=$request->sender_responsibilities;
        $cmr->save();

        return to_route('admin.cmr.index')->with('t-success', 'cmr  updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cmr= CMR::findOrFail($id);

        if($cmr && $cmr->icon != null){
            $previousImagePath = public_path($cmr->icon);
            if (file_exists($previousImagePath)) {
                unlink($previousImagePath);
            }
        }

        $cmr->delete();
        return response()->json([
            'success' => true,
            'message' => 'cmr deleted successfully.',
        ]);
    }

    public function  status($id){

        $data = CMR::findOrFail($id);

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
