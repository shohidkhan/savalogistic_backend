<?php

namespace App\Http\Controllers\Web\Backend\ApplyJob;

use App\Http\Controllers\Controller;
use App\Models\ApplyJob;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ApplyJobController extends Controller
{

    public function index(Request $request)
    {
        // $data = ApplyJob::with('jobPlaceMent','user')->latest()->get();
        // return $data;
         if ($request->ajax()) {
            $data = ApplyJob::with('jobPlaceMent','user')->latest()->get();

            // dd($data);

            return DataTables::of($data)
                ->addIndexColumn()

                ->addColumn('job_placement_id',function($data){
                    $job=$data->jobPlaceMent->title;

                    return "$job";
                })
               ->addColumn('resume', function ($data) {
                    if ($data->resume) {
                        $resumeUrl = asset($data->resume);
                        return '<a href="' . $resumeUrl . '" target="_blank">View Resume</a>';
                    } else {
                        return 'No Resume';
                    }
                })
                ->addColumn('status',function($data){
                    $status=$data->status;
                    if($status=='pending'){
                        return '<span class="badge badge-warning">'.$status.'</span>';
                    }elseif($status=='reject'){
                        return '<span class="badge badge-danger">'.$status.'</span>';
                    }elseif($status == 'confirm'){
                       return '<span class="badge badge-success">'.$status.'</span>';
                    }elseif($status == 'shortlisted'){
                        return '<span class="badge badge-info">'.$status.'</span>';
                    }
                })
                ->addColumn('action', function ($data) {
                    return '<div class="text-center"><div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                              <a href="' . route('admin.apply_job.edit', ['id' => $data->id]) . '" class="text-white btn btn-primary" title="Edit">
                              <i class="fa-solid fa-eye"></i>
                              </a>
                              <a href="#" onclick="showDeleteConfirm(' . $data->id . ')" type="button" class="text-white btn btn-danger" title="Delete">
                              <i class="bi bi-trash"></i>
                            </a>
                            </div></div>';
                })
                ->rawColumns(['action','status','job_placement_id','resume'])
                ->make(true);
        }
        return view('backend.layouts.apply_job.index');
    }


    public function edit($id){
        $data=ApplyJob::with('jobPlaceMent','user')->find($id);

        return view('backend.layouts.apply_job.edit',compact('data'));
    }

    public function update(Request $request,$id){

        $applicant=ApplyJob::find($id);

        $applicant->status = $request->status;

        $applicant->save();

        return to_route('admin.apply_job.index')->with('t-success', 'updated successfully.');
    }

    public function destroy($id){
        $applicant=ApplyJob::find($id);


        if($applicant && $applicant->resume != null){
            $previousImagePath = public_path($applicant->resume);
            if (file_exists($previousImagePath)) {
                unlink($previousImagePath);
            }
        }

        $applicant->delete();
           return response()->json([
            'success' => true,
            'message' => 'awards deleted successfully.',
        ]);
    }
}
