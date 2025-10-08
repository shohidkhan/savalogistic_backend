<?php

namespace App\Http\Controllers\Api\job;

use App\Http\Controllers\Controller;
use App\Models\ApplyJob;
use App\Models\JobPlacement;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JobController extends Controller
{
    use ApiResponse;

    public function getAllJobs(){
        $jobs=JobPlacement::select('id','title','department','deadline','location','career_level','employment_status','description')->latest()->get();

        if($jobs->isEmpty()){
            return $this->error([],'No Jobs found',422);
        }

        return $this->success($jobs,'All jobs',200);
    }
    public function jobDetails($id){
        $job=JobPlacement::select('id','title','department','deadline','location','career_level','employment_status','description')->findOrFail($id);

        if(!$job){
            return $this->error([],'Job details not found',422);
        }

        return $this->success($job,'Job Details',200);
    }



    public function applyJob(Request $request){
        $validator=Validator::make($request->all(),[
            'first_name'=>'required|string|max:255',
            'last_name'=>'required|string|max:255',
            'email'=>'required|email',
            'resume'=>'required|file|mimes:doc,docx,pdf|max:10240',
            'job_placement_id'=>'required|exists:job_placements,id',
            'position'=>'required|string',
            'agree_privacy_policy'=>'required|boolean',
        ]);

        if($validator->fails()){
            return $this->error($validator->errors(),$validator->errors()->first(),422);
        }

        $fileName=null;
        if($request->hasFile('resume')){
            $file=$request->file('resume');
            $fileName=uploadImage($file,'resume');
        }

        $user=auth()->user();

        ApplyJob::create([
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'email'=>$request->email,
            'job_placement_id'=>$request->job_placement_id,
            'user_id'=>$user->id,
            'resume'=>$fileName,
            'position'=>$request->position,
            'agree_privacy_policy'=>$request->agree_privacy_policy
        ]);
        return $this->success([],'Successfully submitted your resume. You will get update via email at any action.',200);
    }
}
