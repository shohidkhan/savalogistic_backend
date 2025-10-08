<?php

namespace App\Http\Controllers\Web\Backend\TransportNotice;

use App\Http\Controllers\Controller;
use App\Models\TransportNotice;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TransportNoticeController extends Controller
{
   /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
         if ($request->ajax()) {
            $data = TransportNotice::latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()



                ->addColumn('title',function($data){
                    $title=$data->title;
                    $titleContent= strlen($data) > 30 ? substr($title,0,30).'...':$title;

                    return $titleContent;

                })
                ->addColumn('sub_title',function($data){
                    $sub_title=$data->sub_title;
                    $sub_titleContent= strlen($data) > 30 ? substr($sub_title,0,30).'...':$sub_title;

                    return $sub_titleContent;

                })
                 ->addColumn('file', function ($data) {
                    if ($data->file) {
                        $resumeUrl = asset($data->file);
                        return '<a href="' . $resumeUrl . '" target="_blank">'.$data->file.'</a>';
                    } else {
                        return 'No FIle';
                    }
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
                              <a href="' . route('admin.transport_notice.edit', ['transport_notice' => $data->id]) . '" class="text-white btn btn-primary" title="Edit">
                              <i class="bi bi-pencil"></i>
                              </a>
                              <a href="#" onclick="showDeleteConfirm(' . $data->id . ')" type="button" class="text-white btn btn-danger" title="Delete">
                              <i class="bi bi-trash"></i>
                            </a>
                            </div></div>';
                })
                ->rawColumns(['action','status','title','sub_title','file'])
                ->make(true);
        }
        return view('backend.layouts.transport_notice.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.layouts.transport_notice.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'sub_title' => 'required|string|max:255',
            'code' => 'required|unique:transport_notices,code',
            'file' => 'required|file|mimes:pdf',
        ]);


        if($request->hasFile('file')){
            $image = $request->file('file');
            $imageName = uploadImage($image, 'transport_notice');
        }

        $todayDate=Carbon::now()->format('Y-m-d');
        $t=TransportNotice::create([
            'title' => $request->title,
            'sub_title' => $request->sub_title,
            'file' => $request->file('file') ? $imageName : null,
            'code' => $request->code,
            'date'=>$todayDate,
        ]);
        return to_route('admin.transport_notice.index')->with('t-success', 'transport notice created successfully.');
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
        $data = TransportNotice::findOrFail($id);
        return view('backend.layouts.transport_notice.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $request->validate([
            'title'=>'required|string|max:255',
            'sub_title'=>'required|string|max:255',
            'code'=>'required',
            'file'=>'nullable|file|mimes:pdf',
        ]);
        $transport_notice = TransportNotice::findOrFail($id);
         if($request->hasFile('file')){
            if($transport_notice && $transport_notice->file != null){
               $previousImagePath = public_path($transport_notice->file);
                if (file_exists($previousImagePath)) {
                    unlink($previousImagePath);
                }
            }
            $image = $request->file('file');
            $imageName = uploadImage($image, 'transport_notice');
        }else {
            $imageName = $transport_notice->file; // Keep the existing image if no new image is uploaded
        }

        // return $request->all();

        $transport_notice->title = $request->title;
        $transport_notice->sub_title = $request->sub_title;
        $transport_notice->file = $imageName;
        $transport_notice->code = $request->code;
        $transport_notice->save();
        return to_route('admin.transport_notice.index')->with('t-success', 'transport notice updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $transport_notice= TransportNotice::findOrFail($id);

        if($transport_notice && $transport_notice->file != null){
            $previousImagePath = public_path($transport_notice->file);
            if (file_exists($previousImagePath)) {
                unlink($previousImagePath);
            }
        }
        $transport_notice->delete();
        return response()->json([
            'success' => true,
            'message' => 'Notice deleted successfully.',
        ]);
    }

    public function  status($id){

        $data = TransportNotice::findOrFail($id);

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
