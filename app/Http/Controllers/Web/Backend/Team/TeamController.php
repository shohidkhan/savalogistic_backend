<?php

namespace App\Http\Controllers\Web\Backend\Team;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
         if ($request->ajax()) {
            $data = Team::latest()->get();
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
                ->addColumn('twitter',function($data){
                    return $data->twitter ? '<a href="' . $data->twitter . '" target="_blank" class="text-decoration-none">' . $data->twitter . '</a>' : 'N/A';
                })
                ->addColumn('linkedin',function($data){
                    return $data->linkedin ? '<a href="' . $data->linkedin . '" target="_blank" class="text-decoration-none">' . $data->linkedin . '</a>' : 'N/A';
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
                              <a href="' . route('admin.teams.edit', ['team' => $data->id]) . '" class="text-white btn btn-primary" title="Edit">
                              <i class="bi bi-pencil"></i>
                              </a>
                              <a href="#" onclick="showDeleteConfirm(' . $data->id . ')" type="button" class="text-white btn btn-danger" title="Delete">
                              <i class="bi bi-trash"></i>
                            </a>
                            </div></div>';
                })
                ->rawColumns(['action', 'linkedin','twitter','status', 'image'])
                ->make(true);
        }
        return view('backend.layouts.team.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.layouts.team.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|string|max:255',
            'position'=>'required|string|max:255',
            'image'=>'nullable|image|mimes:jpeg,png,jpg,gif',
            'bio'=>'nullable|string',
            'twitter'=>'nullable|url',
            'linkedin'=>'nullable|url',
            'instagram'=>'nullable|url',
        ]);

        if($request->hasFile('image')){
            $image = $request->file('image');
            $imageName = uploadImage($image, 'teams');
        }


        Team::create([
            'name' => $request->name,
            'position' => $request->position,
            'image' => $request->file('image') ? $imageName : null,
            'bio' => $request->bio,
            'twitter' => $request->twitter,
            'linkedin' => $request->linkedin,
            'instagram' => $request->instagram,
        ]);
        return to_route('admin.teams.index')->with('t-success', 'Team member created successfully.');
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
        $data = Team::findOrFail($id);
        return view('backend.layouts.team.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $request->validate([
            'name'=>'required|string|max:255',
            'position'=>'required|string|max:255',
            'image'=>'nullable|image|mimes:jpeg,png,jpg,gif',
            'bio'=>'nullable|string',
            'twitter'=>'nullable|url',
            'linkedin'=>'nullable|url',
            'instagram'=>'nullable|url',
        ]);
        $team = Team::findOrFail($id);
         if($request->hasFile('image')){
            if($team && $team->image != null){
               $previousImagePath = public_path($team->image);
                if (file_exists($previousImagePath)) {
                    unlink($previousImagePath);
                }
            }
            $image = $request->file('image');
            $imageName = uploadImage($image, 'teams');
        }else {
            $imageName = $team->image; // Keep the existing image if no new image is uploaded
        }

        // return $request->all();

        $team->update([
            'name' => $request->name,
            'position' => $request->position,
            'image' => $request->file('image') ? $imageName : $team->image,
            'bio' => $request->bio,
            'twitter' => $request->twitter,
            'linkedin' => $request->linkedin,
            'instagram' => $request->instagram,
        ]);
        return to_route('admin.teams.index')->with('t-success', 'Team member updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $team= Team::findOrFail($id);

        if($team && $team->image != null){
            $previousImagePath = public_path($team->image);
            if (file_exists($previousImagePath)) {
                unlink($previousImagePath);
            }
        }
        $team->delete();
        return response()->json([
            'success' => true,
            'message' => 'Member deleted successfully.',
        ]);
    }

    public function  status($id){

        $data = Team::findOrFail($id);

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
