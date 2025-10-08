<?php

namespace App\Http\Controllers\Web\Backend\Sector;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Sector;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class SectorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = Sector::latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()

                ->addColumn('icon', function ($data) {
                    $url = $data->icon;
                    if (! $url) {
                        return '<img class="img-fluid" src="' . asset('backend/images/placeholder/image_placeholder.png') . '" width="50" height="50">';
                    }
                    return '<img class="img-fluid" src="' . asset($url) . '" width="50" height="50" style="border-radius: 20%; background-color: #000; padding: 5px">';
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
                              <a href="' . route('admin.sector.edit', ['sector' => $data->id]) . '" class="text-white btn btn-primary" title="Edit">
                              <i class="bi bi-pencil"></i>
                              </a>
                              <a href="#" onclick="showDeleteConfirm(' . $data->id . ')" type="button" class="text-white btn btn-danger" title="Delete">
                              <i class="bi bi-trash"></i>
                            </a>
                            </div></div>';
                })
                ->rawColumns(['description', 'icon', 'action', 'status'])
                ->make(true);
        }
        return view('backend.layouts.sector.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.layouts.sector.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
            'title'=>'required|string|max:255',
            'sub_title'=>'required|string|max:255',
            'icon'=>'required|image|mimes:jpeg,png,jpg,gif',
            'logo'=>'array',
            'logo.*'=>'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);


        DB::beginTransaction();
        try{
            if($request->hasFile('icon')){
                $icon=$request->file('icon');
                $iconName=uploadImage($icon,'sector_icon');
            }

            $sector=Sector::create([
                'title'=>$request->title,
                'sub_title'=>$request->sub_title,
                'icon'=>$request->file('icon') ? $iconName : null,
            ]);

            if ($request->hasFile('logo') && is_array($request->file('logo'))) {
                foreach ($request->file('logo') as $companyLogo) {
                    if ($companyLogo->isValid()) {
                        $companyLogoName=uploadImage($companyLogo,'company_logo');

                        Company::create([
                            'sector_id'=>$sector->id,
                            'logo'=>$companyLogoName,
                        ]);
                    }
                }
            }

             DB::commit();
            return redirect()->route('admin.sector.index')->with('t-success', 'Service created successfully.');
        }catch(Exception $e){
            DB::rollBack();
            return redirect()->back()->with('t-error', $e->getMessage());
        }
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
        $serviceSector=Sector::with('companies')->findOrFail($id);
        // $companies=Company::where('sector_id',$serviceSector->id)->get();
        return view('backend.layouts.sector.edit',compact('serviceSector'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //   dd($request->hasFile('icon'));
        $request->validate([
            'title' => ['required', 'regex:/^[a-zA-Z0-9\s]+$/'],
            'sub_title'=>'required|string|max:255',
            'icon'=>'nullable|image|mimes:jpeg,png,jpg,gif',
            'logo'=>'array|nullable',
            'logo.*'=>'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ],[
            'title.regex' => 'The title may only contain letters, numbers, and spaces.',
        ]);




        DB::beginTransaction();
        try{

            $sector= Sector::findOrFail($id);


            if ($request->hasFile('icon')) {
                 $previousImagePath = public_path($sector->icon);
                    if (file_exists($previousImagePath)) {
                        unlink($previousImagePath);
                    }
                $image     = $request->file('icon');
                $imageName = uploadImage($image, 'sector_icon');
            } else {
                $imageName = $sector->icon;
            }




            $sector->title= $request->title;
            $sector->sub_title= $request->sub_title;
            $sector->icon= $imageName;
            $sector->save();

            if ($request->hasFile('logo') && is_array($request->file('logo'))) {
                foreach ($request->file('logo') as $companyLogo) {
                    if ($companyLogo->isValid()) {
                        $companyLogoName=uploadImage($companyLogo,'company_logo');
                        Company::create([
                            'sector_id'=>$sector->id,
                            'logo'=>$companyLogoName,
                        ]);
                    }
                }
            }

             DB::commit();
            return redirect()->route('admin.sector.index')->with('t-success', 'Service created successfully.');
        }catch(Exception $e){
            DB::rollBack();
            return redirect()->back()->with('t-error', $e->getMessage());
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data=Sector::with('companies')->findOrFail($id);
        if($data && $data->icon != null){
            $previousImagePath = public_path($data->icon);
            if (file_exists($previousImagePath)) {
                unlink($previousImagePath);
            }
        }

        $companies=$data->companies()->get();

        foreach($companies as $company){
            if ($company->logo) {
                unlink($company->logo);
            }
            $company->delete();
        }
        $data->delete();


        return response()->json([
            'success' => true,
            'message'   => 'Deleted successfully.',
        ]);
    }


    public function companyDelete($id){
        $company=Company::findOrFail($id);

          if($company && $company->logo != null){
            $previousImagePath = public_path($company->logo);
            if (file_exists($previousImagePath)) {
                unlink($previousImagePath);
            }
        }
        $company->delete();
         return redirect()->back()->with('t-success', 'Company deleted successfully.');
    }

    public function companyEdit($id){
        $data=Company::findOrFail($id);
        $sector=Sector::findOrFail($data->sector_id);
        return view('backend.layouts.sector.edit-company',compact('data','sector'));
    }


    public function companyUpdate(Request $request,$id){
        $request->validate([
            'logo'=>'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);
        $data=Company::findOrFail($id);
        if($request->hasFile('logo')){
            if( $data->logo){
               $previousImagePath = public_path($data->logo);
                if (file_exists($previousImagePath)) {
                    unlink($previousImagePath);
                }
            }
            $image = $request->file('logo');
            $imageName = uploadImage($image, 'company_logo');
        }else {
            $imageName = $data->logo; // Keep the existing image if no new image is uploaded
        }

        $data->logo = $imageName;
        $data->save();

        return redirect()->route('admin.sector.edit',['sector'=>$data->sector_id])->with('t-success','Company logo updated.');
    }

    public function  status($id){

        $data = Sector::findOrFail($id);

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
