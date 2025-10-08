<?php
namespace App\Http\Controllers\Web\Backend;

use App\Http\Controllers\Controller;
use App\Models\OurService;
use App\Models\OurServiceFeature;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class OurServiceController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = OurService::latest()->get();

            if (! empty($request->input('search.value'))) {
                $searchTerm = $request->input('search.value');
                $data->where('title', 'LIKE', "%$searchTerm%");
            }

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('description', function ($data) {
                    $page_content       = $data->description;
                    $short_page_content = strlen($page_content) > 60 ? substr($page_content, 0, 60) . '...' : $page_content;
                    return '<p>' . $short_page_content . '</p>';
                })
                ->editColumn('image', function ($data) {
                    $url = $data->image;
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
                              <a href="' . route('admin.services.edit', ['id' => $data->id]) . '" class="text-white btn btn-primary" title="Edit">
                              <i class="bi bi-pencil"></i>
                              </a>
                              <a href="#" onclick="showDeleteConfirm(' . $data->id . ')" type="button" class="text-white btn btn-danger" title="Delete">
                              <i class="bi bi-trash"></i>
                            </a>
                            </div></div>';
                })
                ->rawColumns(['description', 'image', 'action', 'status'])
                ->make(true);
        }
        return view('backend.layouts.our-service.index');
    }

    public function create()
    {
        return view('backend.layouts.our-service.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'           => 'required|string|max:255',
            'description'     => 'required|string|max:500000',
            'image'           => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'address'         => 'required|string|max:255',
            'annual_meter'    => 'required|string|max:255',
            'annual_tons'     => 'required|string|max:255',
            'per_year_client' => 'required|string|max:255',
            'annual_shipment' => 'required|string|max:255',
        ]);

        try {

            DB::beginTransaction();

            if ($request->hasFile('image')) {
                $image     = $request->file('image');
                $imageName = uploadImage($image, 'services');
            }

            $service = OurService::create([
                'title'           => $request->title,
                'slug'            => Str::slug($request->title),
                'description'     => $request->description,
                'image'           => $imageName,
                'address'         => $request->address,
                'annual_meter'    => $request->annual_meter,
                'annual_tons'     => $request->annual_tons,
                'per_year_client' => $request->per_year_client,
                'annual_shipment' => $request->annual_shipment,
            ]);

            if ($request->services && is_array($request->services)) {
                foreach ($request->services as $featureData) {
                    if ($featureData['feature_image']) {
                        $feature_image    = $featureData['feature_image'];
                        $FeatureImageName = uploadImage($feature_image, 'services/features');
                    } else {
                        $FeatureImageName = null;
                    }
                    $feature = $service->OurServiceFeatures()->create([
                        'feature_title'       => $featureData['feature_title'],
                        'feature_description' => $featureData['feature_description'],
                        'feature_image'       => $FeatureImageName,
                    ]);
                }
            }
            DB::commit();
            return redirect()->route('admin.services.index')->with('t-success', 'Service created successfully.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('t-error', $e->getMessage());
        }
    }

    public function status(int $id): JsonResponse
    {
        $data = OurService::findOrFail($id);
        if ($data->status == 'inactive') {
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

    public function destroy(int $id): JsonResponse
    {

        $data = OurService::findOrFail($id);

        if ($data->image) {
            unlink($data->image);
        }

        $feature = $data->OurServiceFeatures()->get();
        foreach ($feature as $featureData) {
            if ($featureData->feature_image) {
                unlink($featureData->feature_image);
            }
        }

        $data->delete();

        return response()->json([
            'success' => true,
            'message'   => 'Deleted successfully.',
        ]);
    }

    public function edit(int $id)
    {
        $data = OurService::with('OurServiceFeatures')->findOrFail($id);
        return view('backend.layouts.our-service.edit', compact('data'));
    }

    public function update(Request $request, int $id)
    {
        $request->validate([
            'title'           => 'required|string|max:255',
            'description'     => 'required|string|max:500000',
            'image'           => 'image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'address'         => 'required|string|max:255',
            'annual_meter'    => 'required|string|max:255',
            'annual_tons'     => 'required|string|max:255',
            'per_year_client' => 'required|string|max:255',
            'annual_shipment' => 'required|string|max:255',
        ]);

        $data = OurService::findOrFail($id);
        try {

            DB::beginTransaction();

            if ($request->hasFile('image')) {
                if ($data->image) {
                    unlink($data->image);
                }
                $image     = $request->file('image');
                $imageName = uploadImage($image, 'services');
            } else {
                $imageName = $data->image;
            }

            $service = OurService::findOrFail($id);
            $service->update([
                'title'           => $request->title,
                'slug'            => Str::slug($request->title),
                'description'     => $request->description,
                'image'           => $imageName,
                'address'         => $request->address,
                'annual_meter'    => $request->annual_meter,
                'annual_tons'     => $request->annual_tons,
                'per_year_client' => $request->per_year_client,
                'annual_shipment' => $request->annual_shipment,
            ]);

            if ($request->services && is_array($request->services)) {
                foreach ($request->services as $featureData) {
                    if (isset($featureData['feature_image']) && $featureData['feature_image']) {
                        $feature_image    = $featureData['feature_image'];
                        $FeatureImageName = uploadImage($feature_image, 'services/features');
                    }else{
                        $FeatureImageName = null;
                    }

                    $feature = $service->OurServiceFeatures()->create([
                        'feature_title'       => $featureData['feature_title'] ?? null,
                        'feature_description' => $featureData['feature_description'] ?? null,
                        'feature_image'       => $FeatureImageName,
                    ]);

                    if($FeatureImageName == null){
                        $feature->delete();
                    }
                }
            }
            DB::commit();
            return redirect()->route('admin.services.index')->with('t-success', 'Service updated successfully.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('t-error', $e->getMessage());
        }
    }

    public function destroyFeature(int $id)
    {
        $data = OurServiceFeature::findOrFail($id);
        if ($data->feature_image) {
            unlink($data->feature_image);
        }
        $data->delete();
        return redirect()->back()->with('t-success', 'Service feature deleted successfully.');
    }

    public function editFeature(int $id)
    {
        $data = OurServiceFeature::findOrFail($id);
        return view('backend.layouts.our-service.edit-feature', compact('data'));
    }

    public function updateFeature(Request $request, int $id)
    {
        $request->validate([
            'feature_title'       => 'required|string|max:255',
            'feature_description' => 'required|string|max:500000',
            'feature_image'       => 'image|mimes:jpeg,png,jpg,gif,svg|max:5120',
        ]);

        $data = OurServiceFeature::findOrFail($id);
        try {

            DB::beginTransaction();

            if ($request->hasFile('feature_image')) {
                if ($data->feature_image) {
                    unlink($data->feature_image);
                }
                $image     = $request->file('feature_image');
                $imageName = uploadImage($image, 'services/features');
            } else {
                $imageName = $data->feature_image;
            }

            $data->update([
                'feature_title'       => $request->feature_title,
                'feature_description' => $request->feature_description,
                'feature_image'       => $imageName,
            ]);

            DB::commit();
            return redirect()->route('admin.services.edit', $data->id)->with('t-success', 'Service feature updated successfully.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('t-error', $e->getMessage());
        }
    }
}
