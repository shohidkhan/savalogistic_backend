<?php

namespace App\Http\Controllers\Web\Backend\Settings;

use App\Http\Controllers\Controller;
use App\Models\SocialMedia;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class SocialMediaController extends Controller {
    public function index(Request $request) {

        if($request->ajax()){
            $data = SocialMedia::latest('id')->get();
             return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('profile_link',function($data){
                    $link=$data->profile_link;
                    return '<a href="'.$link.'" target="_blank">'.$link.'</a>';
                })
                ->addColumn('social_media_icon',function($data){
                    $link=asset($data->social_media_icon);
                    return '<img src="'.$link.'" width="50" height="50" class="rounded-circle" alt="image">';
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
                              <a href="' . route('social.edit', ['id' => $data->id]) . '" class="text-white btn btn-primary" title="Edit">
                              <i class="bi bi-pencil"></i>
                              </a>
                              <a href="#" onclick="showDeleteConfirm(' . $data->id . ')" type="button" class="text-white btn btn-danger" title="Delete">
                              <i class="bi bi-trash"></i>
                            </a>
                            </div></div>';
                })
                ->rawColumns(['action','status','profile_link','social_media_icon'])
                ->make(true);
        }
        return view('backend.layouts.settings.social_media');
    }


    public function create(){
        return view('backend.layouts.settings.social_create');
    }

    public function store(Request $request){

        // dd($request->all());
        $request->validate([
            'social_media'=>'required|string',
            'profile_link'=>'required|url',
            'social_media_icon' => 'required|image|mimes:png,jpg,gif',
        ]);

        // $socialMedia=SocialMedia::where('social_media',$request->social_media)->exists();
        // if($socialMedia){
        //     return back()->with('t-error', 'Social media already taken.');
        // }

          if ($request->hasFile('social_media_icon')) {
            // $icon=$request->file('icon');
                $social_icon_name = uploadImage($request->file('social_media_icon'), 'social');
            }

        SocialMedia::create([
            'social_media'=>$request->social_media,
            'profile_link'=>$request->profile_link,
            'social_media_icon'=>$social_icon_name
        ]);

         return redirect()->route('social.index')->with('t-success', 'Social media links created successfully.');

    }

    public function edit($id){
        $data=SocialMedia::find($id);
        return view('backend.layouts.settings.social_edit',compact('data'));
    }

    public function update(Request $request,$id) {
        $request->validate([
            'social_media'=>'required|string',
            'profile_link'=>'required|url',
            'social_media_icon' => 'nullable|image|mimes:png,jpg,gif',
        ]);
        try {


            $data=SocialMedia::find($id);

            if($request->hasFile('social_media_icon')){
                if($data && $data->social_media_icon != null){
                $previousImagePath = public_path($data->social_media_icon);
                    if (file_exists($previousImagePath)) {
                        unlink($previousImagePath);
                    }
                }
                $image = $request->file('social_media_icon');
                $imageName = uploadImage($image, 'social');
            }else {
                $imageName = $data->social_media_icon; // Keep the existing image if no new image is uploaded
            }

            $data->social_media= $request->social_media;
            $data->profile_link= $request->profile_link;
            $data->social_media_icon= $imageName;

            $data->save();

            return redirect()->route('social.index')->with('t-success', 'Social media links updated successfully.');
        } catch (Exception) {
            return back()->with('t-error', 'Social media links failed update.');
        }
    }

    public function destroy($id) {
        try {
            $social=SocialMedia::find($id);

            if($social && $social->social_media_icon != null){
                $previousImagePath = public_path($social->social_media_icon);
                if (file_exists($previousImagePath)) {
                    unlink($previousImagePath);
                }
            }

            $social->delete();
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Social media link deleted successfully.',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete social media link.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }


     public function  status($id){

        $data = SocialMedia::findOrFail($id);

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
