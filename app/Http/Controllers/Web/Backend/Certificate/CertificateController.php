<?php

namespace App\Http\Controllers\Web\Backend\Certificate;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CertificateController extends Controller
{
     public function index(Request $request)
    {
         if ($request->ajax()) {
            $data = Certificate::latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('image', function ($data) {
                    $url = asset($data->image);
                    if(empty($data->image)){
                        $url = asset('backend/images/placeholder/image_placeholder.png');
                    }
                    return '<img src="' . $url . '" width="50" height="50" class="rounded-circle" alt="image">';
                })
                ->addColumn('title',function($data){
                    $title = $data->title;
                    $titleContent=strlen($title) > 50 ? substr($title,0,50).'...' :  $title;
                    return '<p>'. $titleContent.'</p>';
                })
                ->addColumn('is_verified', function ($data) {
                    $isVerified = $data->is_verified;
                    return $isVerified != null ? 'Verified' : 'N/A';
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
                              <a href="' . route('admin.certificates.edit', ['certificate' => $data->id]) . '" class="text-white btn btn-primary" title="Edit">
                              <i class="bi bi-pencil"></i>
                              </a>
                              <a href="#" onclick="showDeleteConfirm(' . $data->id . ')" type="button" class="text-white btn btn-danger" title="Delete">
                              <i class="bi bi-trash"></i>
                            </a>
                            </div></div>';
                })
                ->rawColumns(['action','title','status','image'])
                ->make(true);
        }
        return view('backend.layouts.certificate.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.layouts.certificate.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
         // Validate the request data
        $request->validate([
            'title'=>'required|string|max:255',
            'image'=>'nullable|image|mimes:jpeg,png,jpg,gif',
            'issued_by'=>'nullable|string',
            'is_verified'=>'boolean|nullable',
        ]);

        if($request->hasFile('image')){
            $image = $request->file('image');
            $imageName = uploadImage($image, 'certificate');
        }


        Certificate::create([
            'title' => $request->title,
            'image' => $request->file('image') ? $imageName : null,
            'issued_by' => $request->issued_by,
            'is_verified' => $request->is_verified ? true : false,
        ]);
        return to_route('admin.certificates.index')->with('t-success', 'Certificate  created successfully.');
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
        $data = Certificate::findOrFail($id);
        return view('backend.layouts.certificate.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
          $request->validate([
            'title'=>'required|string|max:255',
            'image'=>'nullable|image|mimes:jpeg,png,jpg,gif',
            'issued_by'=>'nullable|string',
            'is_verified'=>'boolean|nullable',
        ]);

        $certificate = Certificate::findOrFail($id);
         if($request->hasFile('image')){
            if($certificate && $certificate->image != null){
               $previousImagePath = public_path($certificate->image);
                if (file_exists($previousImagePath)) {
                    unlink($previousImagePath);
                }
            }
            $image = $request->file('image');
            $imageName = uploadImage($image, 'certificate');
        }else {
            $imageName = $certificate->image; // Keep the existing image if no new image is uploaded
        }

        // return $request->all();

        $certificate->update([
            'title' => $request->title,
            'image' =>  $imageName,
            'issued_by' => $request->issued_by,
            'is_verified' => $request->is_verified,
        ]);
        return to_route('admin.certificates.index')->with('t-success', 'Certificate  updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $certificate= Certificate::findOrFail($id);

        if($certificate && $certificate->image != null){
            $previousImagePath = public_path($certificate->image);
            if (file_exists($previousImagePath)) {
                unlink($previousImagePath);
            }
        }
        $certificate->delete();
        return response()->json([
            'success' => true,
            'message' => 'Certificate deleted successfully.',
        ]);
    }

    public function  status($id){

        $data = Certificate::findOrFail($id);

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
