<?php

namespace App\Http\Controllers\Web\Backend\Award;

use App\Http\Controllers\Controller;
use App\Models\Award;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AwardController extends Controller
{
    public function index(Request $request)
    {
         if ($request->ajax()) {
            $data = Award::latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('image', function ($data) {
                    $url = asset($data->image);
                    if(empty($data->image)){
                        $url = asset('backend/images/placeholder/image_placeholder.png');
                    }
                    return '<img src="' . $url . '" width="50" height="50" class="rounded-circle" alt="image">';
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
                              <a href="' . route('admin.awards.edit', ['award' => $data->id]) . '" class="text-white btn btn-primary" title="Edit">
                              <i class="bi bi-pencil"></i>
                              </a>
                              <a href="#" onclick="showDeleteConfirm(' . $data->id . ')" type="button" class="text-white btn btn-danger" title="Delete">
                              <i class="bi bi-trash"></i>
                            </a>
                            </div></div>';
                })
                ->rawColumns(['action','status','image'])
                ->make(true);
        }
        return view('backend.layouts.awards.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.layouts.awards.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
         // Validate the request data
        $request->validate([
            'name'=>'required|string|max:255',
            'award_subject'=>'required|string',
            'image'=>'nullable|image|mimes:jpeg,png,jpg,gif',
            'year'=>'required',
        ]);

        if($request->hasFile('image')){
            $image = $request->file('image');
            $imageName = uploadImage($image, 'awards');
        }


        Award::create([
            'name' => $request->name,
            'image' => $request->file('image') ? $imageName : null,
            'award_subject' => $request->award_subject,
            'year' => $request->year,
        ]);
        return to_route('admin.awards.index')->with('t-success', 'awards  created successfully.');
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
        $data = Award::findOrFail($id);
        return view('backend.layouts.awards.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $request->validate([
            'name'=>'required|string|max:255',
            'award_subject'=>'required|string',
            'image'=>'nullable|image|mimes:jpeg,png,jpg,gif',
            'year'=>'required',
        ]);

        $awards = Award::findOrFail($id);
         if($request->hasFile('image')){
            if($awards && $awards->image != null){
               $previousImagePath = public_path($awards->image);
                if (file_exists($previousImagePath)) {
                    unlink($previousImagePath);
                }
            }
            $image = $request->file('image');
            $imageName = uploadImage($image, 'awards');
        }else {
            $imageName = $awards->image; // Keep the existing image if no new image is uploaded
        }

        // return $request->all();

        $awards->update([
            'name' => $request->name,
            'image' =>  $imageName ,
            'award_subject' => $request->award_subject,
            'year' => $request->year,
        ]);
        return to_route('admin.awards.index')->with('t-success', 'awards  updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $awards= Award::findOrFail($id);

        if($awards && $awards->image != null){
            $previousImagePath = public_path($awards->image);
            if (file_exists($previousImagePath)) {
                unlink($previousImagePath);
            }
        }
        $awards->delete();
        return response()->json([
            'success' => true,
            'message' => 'awards deleted successfully.',
        ]);
    }

    public function  status($id){

        $data = Award::findOrFail($id);

        // dd($data);

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
