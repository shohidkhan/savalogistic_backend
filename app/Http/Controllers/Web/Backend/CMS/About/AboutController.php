<?php

namespace App\Http\Controllers\Web\Backend\CMS\About;

use App\Enums\PageEnum;
use App\Enums\SectionEnum;
use App\Http\Controllers\Controller;
use App\Models\CMS;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index() {
        $data = CMS::where('page_name', PageEnum::ABOUT)
            ->where('section_name', SectionEnum::ABOUT)
            ->first();
        return view('backend.layouts.cms.about.about.index', compact('data'));
    }
    public function store(Request $request){
        // dd($request->all());
        $request->validate([
            'description' => 'required|string',
            'image_url' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $data = CMS::where('page_name', PageEnum::ABOUT)
            ->where('section_name', SectionEnum::ABOUT)
            ->first();

        if ($request->hasFile('image_url')) {
            // Delete old image if data exists and image_url is set
            if ($data && $data->image_url != null) {
                $previousImagePath = public_path($data->image_url);
                if (file_exists($previousImagePath)) {
                    unlink($previousImagePath);
                }
            }

            // Upload new image
            $image = $request->file('image_url');
            $imageName = uploadImage($image, 'cms/about');
        } else {
            // Use existing image if available
            $imageName = $data ? $data->image_url : null;
        }

       

        // Update or create CMS entry
        CMS::updateOrCreate(
            ['page_name' => PageEnum::ABOUT, 'section_name' => SectionEnum::ABOUT],
            [
                'description' => $request->description,
                'image_url' => $imageName,
            ]
        );

        // Redirect with appropriate message
        $message = $data ? 'Home Banner updated successfully.' : 'Home Banner created successfully.';
        return redirect()->back()->with('t-success', $message);

    }
}
