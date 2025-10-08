<?php

namespace App\Http\Controllers\Web\Backend\Blog;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
         if ($request->ajax()) {
            $data = Blog::with('category')->latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('image', function ($data) {
                    $url = asset($data->image);
                    if(empty($data->image)){
                        $url = asset('backend/images/placeholder/image_placeholder.png');
                    }
                    return '<img src="' . $url . '" width="50" height="50" class="rounded-circle" alt="image">';
                })

                ->addColumn('category_id',function($data){
                    $category=$data->category->name;
                    return $category;
                })

                ->addColumn('short_description',function($data){
                    $short_desc=$data->short_description;

                    $short_desc_content = strlen($short_desc) > 60 ? substr($short_desc,0,50).'...':$short_desc;

                    return "$short_desc_content";
                })

                ->addColumn('title',function($data){
                    $title=$data->title;

                    $titleContent= strlen($data) > 30 ? substr($title,0,30).'...':$title;

                    return $titleContent;

                })

                ->addColumn('published_date',function($data){
                    $dateFormate=Carbon::parse($data->published_date)->format('d M Y');
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
                              <a href="' . route('admin.blog.edit', ['blog' => $data->id]) . '" class="text-white btn btn-primary" title="Edit">
                              <i class="bi bi-pencil"></i>
                              </a>
                              <a href="#" onclick="showDeleteConfirm(' . $data->id . ')" type="button" class="text-white btn btn-danger" title="Delete">
                              <i class="bi bi-trash"></i>
                            </a>
                            </div></div>';
                })
                ->rawColumns(['action','status','image','published_date','short_description','category_id','title'])
                ->make(true);
        }
        return view('backend.layouts.blog.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories=Category::latest()->get();
        return view('backend.layouts.blog.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required|string|max:255',
            'category_id'=>'required',
            'image'=>'nullable|image|mimes:jpeg,png,jpg,gif',
            'author'=>'required|string',
            'short_description'=>'nullable|string',
            'long_description'=>'required|string',
        ]);

        if($request->hasFile('image')){
            $image = $request->file('image');
            $imageName = uploadImage($image, 'blog');
        }

        $publish_date=Carbon::now()->format('y-m-d');

        Blog::create([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'image' => $request->file('image') ? $imageName : null,
            'author' => $request->author,
            'published_date' => $publish_date,
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,
        ]);
        return to_route('admin.blog.index')->with('t-success', 'blog member created successfully.');
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
        $data = Blog::findOrFail($id);
        $categories=Category::latest()->get();
        return view('backend.layouts.blog.edit', compact('data','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $request->validate([
            'title'=>'required|string|max:255',
            'category_id'=>'required',
            'image'=>'nullable|image|mimes:jpeg,png,jpg,gif',
            'author'=>'required|string',
            'short_description'=>'nullable|string',
            'long_description'=>'required|string',
        ]);
        $blog = Blog::findOrFail($id);
         if($request->hasFile('image')){
            if($blog && $blog->image != null){
               $previousImagePath = public_path($blog->image);
                if (file_exists($previousImagePath)) {
                    unlink($previousImagePath);
                }
            }
            $image = $request->file('image');
            $imageName = uploadImage($image, 'blog');
        }else {
            $imageName = $blog->image; // Keep the existing image if no new image is uploaded
        }

        // return $request->all();

        $blog->title = $request->title;
        $blog->category_id = $request->category_id;
        $blog->image = $imageName;
        $blog->author = $request->author;
        $blog->published_date = $request->published_date ?? $blog->published_date;
        $blog->short_description = $request->short_description;
        $blog->long_description = $request->long_description;
        $blog->save();
        return to_route('admin.blog.index')->with('t-success', 'blog member updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $blog= Blog::findOrFail($id);

        if($blog && $blog->image != null){
            $previousImagePath = public_path($blog->image);
            if (file_exists($previousImagePath)) {
                unlink($previousImagePath);
            }
        }
        $blog->delete();
        return response()->json([
            'success' => true,
            'message' => 'Member deleted successfully.',
        ]);
    }

    public function  status($id){

        $data = Blog::findOrFail($id);

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
