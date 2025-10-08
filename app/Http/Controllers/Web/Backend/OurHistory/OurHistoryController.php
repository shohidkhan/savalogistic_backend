<?php

namespace App\Http\Controllers\Web\Backend\OurHistory;

use App\Http\Controllers\Controller;
use App\Models\OurHistory;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class OurHistoryController extends Controller
{
       /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
         if ($request->ajax()) {
            $data = OurHistory::latest()->get();
            if (!empty($request->input('search.value'))) {
                $searchTerm = $request->input('search.value');
                $data->where('name', 'LIKE', "%$searchTerm%");
            }
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
                ->addColumn('description',function($data){
                    $des=$data->description;
                    $desContent=strlen($des) > 80 ? substr($des,0,80).'...' :  $des;
                    return '<p>'. $desContent.'</p>';
                })
                ->addColumn('date',function($data){
                    $date=$data->date;
                    $formattedDate = \Carbon\Carbon::parse($date)->format('M Y');
                    return '<p>'. $formattedDate.'</p>';
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
                              <a href="' . route('admin.our_history.edit', ['our_history' => $data->id]) . '" class="text-white btn btn-primary" title="Edit">
                              <i class="bi bi-pencil"></i>
                              </a>
                              <a href="#" onclick="showDeleteConfirm(' . $data->id . ')" type="button" class="text-white btn btn-danger" title="Delete">
                              <i class="bi bi-trash"></i>
                            </a>
                            </div></div>';
                })
                ->rawColumns(['action', 'title','description','status','date','image'])
                ->make(true);
        }
        return view('backend.layouts.our_history.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.layouts.our_history.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required|string|max:255',
            'image'=>'nullable|image|mimes:jpeg,png,jpg,gif',
            'description'=>'nullable|string',
            'type'=>'required|string',
            'date'=>'required|date',
        ]);

        if($request->hasFile('image')){
            $image = $request->file('image');
            $imageName = uploadImage($image, 'our_history');
        }


        OurHistory::create([
            'title' => $request->title,
            'image' => $request->file('image') ? $imageName : null,
            'description' => $request->description,
            'date' => $request->date,
            'type' => $request->type,
        ]);
        return to_route('admin.our_history.index')->with('t-success', 'our history  created successfully.');
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
        $data = OurHistory::findOrFail($id);
        return view('backend.layouts.our_history.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $request->validate([
            'title'=>'required|string|max:255',
            'image'=>'nullable|image|mimes:jpeg,png,jpg,gif',
            'description'=>'nullable|string',
            'type'=>'required|string',
            'date'=>'required|date',
        ]);

        $our_history = OurHistory::findOrFail($id);
         if($request->hasFile('image')){
            if($our_history && $our_history->image != null){
               $previousImagePath = public_path($our_history->image);
                if (file_exists($previousImagePath)) {
                    unlink($previousImagePath);
                }
            }
            $image = $request->file('image');
            $imageName = uploadImage($image, 'our_history');
        }else {
            $imageName = $our_history->image; // Keep the existing image if no new image is uploaded
        }

        // return $request->all();

        $our_history->update([
            'title' => $request->title,
            'image' => $imageName,
            'description' => $request->description,
            'date' => $request->date,
            'type' => $request->type,
        ]);
        return to_route('admin.our_history.index')->with('t-success', 'our history  updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $our_history= OurHistory::findOrFail($id);

        if($our_history && $our_history->image != null){
            $previousImagePath = public_path($our_history->image);
            if (file_exists($previousImagePath)) {
                unlink($previousImagePath);
            }
        }
        $our_history->delete();
        return response()->json([
            'success' => true,
            'message' => 'History deleted successfully.',
        ]);
    }

    public function  status($id){

        $data = OurHistory::findOrFail($id);

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
