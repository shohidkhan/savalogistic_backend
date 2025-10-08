<?php

namespace App\Http\Controllers\web\Backend\Job;

use App\Http\Controllers\Controller;
use App\Models\JobPlacement;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class JobController extends Controller
{
      /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
         if ($request->ajax()) {
            $data = JobPlacement::latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()

                ->addColumn('description',function($data){
                    $short_desc=$data->description;

                    $short_desc_content = strlen($short_desc) > 60 ? substr($short_desc,0,60).'...':$short_desc;

                    return "$short_desc_content";
                })

                ->addColumn('title',function($data){
                    $title=$data->title;

                    $titleContent= strlen($data) > 30 ? substr($title,0,30).'...':$title;

                    return $titleContent;

                })

                ->addColumn('deadline',function($data){
                    $dateFormate=Carbon::parse($data->deadline)->format('d M Y');
                    return $dateFormate;
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
                              <a href="' . route('admin.job.edit', ['job' => $data->id]) . '" class="text-white btn btn-primary" title="Edit">
                              <i class="bi bi-pencil"></i>
                              </a>
                              <a href="#" onclick="showDeleteConfirm(' . $data->id . ')" type="button" class="text-white btn btn-danger" title="Delete">
                              <i class="bi bi-trash"></i>
                            </a>
                            </div></div>';
                })
                ->rawColumns(['action','status','deadline','description','title'])
                ->make(true);
        }
        return view('backend.layouts.job.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.layouts.job.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required|string|max:255',
            'location'=>'required|string',
            'department'=>'required|string',
            'career_level'=>'required|in:Academic,Professional,Graduate',
            'employment_status'=>'required|in:Full Time,Part Time',
            'deadline'=>'required|date',
            'description'=>'required|string',
        ]);



        // $publish_date=Carbon::now()->format('y-m-d');

        JobPlacement::create([
            'title' => $request->title,
            'department' => $request->department,
            'location' => $request->location,
            'career_level' => $request->career_level,
            'employment_status' => $request->employment_status,
            'deadline' => $request->deadline,
            'description' => $request->description,
        ]);
        return to_route('admin.job.index')->with('t-success', 'job  created successfully.');
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
        $data = JobPlacement::findOrFail($id);
        return view('backend.layouts.job.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title'=>'required|string|max:255',
            'location'=>'required|string',
            'department'=>'required|string',
            'career_level'=>'required|in:Academic,Professional,Graduate',
            'employment_status'=>'required|in:Full Time,Part Time',
            'deadline'=>'required|date',
            'description'=>'required|string',
        ]);
        $job = JobPlacement::findOrFail($id);

        // return $request->all();

        $job->title = $request->title;
        $job->department = $request->department;
        $job->location = $request->location;
        $job->career_level = $request->career_level;
        $job->employment_status = $request->employment_status;
        $job->deadline = $request->deadline;
        $job->description = $request->description;
        $job->save();
        return to_route('admin.job.index')->with('t-success', 'job  updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $job= JobPlacement::findOrFail($id);


        $job->delete();
        return response()->json([
            'success' => true,
            'message' => 'Job deleted successfully.',
        ]);
    }

    public function  status($id){

        $data = JobPlacement::findOrFail($id);

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
