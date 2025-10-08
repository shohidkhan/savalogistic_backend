<?php

namespace App\Http\Controllers\Web\Backend\Settings;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\SystemSetting;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class SystemSettingController extends Controller {
    /**
     * Display the system settings page.
     *
     * @return View
     */
    public function index() {

        $setting = SystemSetting::latest('id')->first();
        return view('backend.layouts.settings.system_settings', compact('setting'));
    }

    /**
     * Update the system settings.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(Request $request) {
        $validator = Validator::make($request->all(), [
            'title'          => 'nullable|string',
            'email'          => 'required|email',
            'system_name'    => 'nullable|string',
            'copyright_text' => 'nullable|string',
            'logo'           => 'nullable|image|mimes:png,jpg,jpeg,svg|max:2048',
            'favicon'        => 'nullable|image|mimes:png,jpg,jpeg,svg|max:2048',
            'address'    => 'nullable|string',
            'phone'    => 'nullable|string',
            'opening_time'    => 'nullable|string',

            'address2'    => 'nullable|string',
            'phone2'    => 'nullable|string',
            'opening_time2'    => 'nullable|string',
            'opening_time3'    => 'nullable|string',
            'opening_time4'    => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $data = SystemSetting::first();
        try {
            $setting                 = SystemSetting::firstOrNew();
            $setting->title          = $request->title;
            $setting->email          = $request->email;
            $setting->system_name    = $request->system_name;
            $setting->copyright_text = $request->copyright_text;
            $setting->logo           = $request->logo;
            $setting->favicon        = $request->favicon;

            $setting->address    = $request->address;
            $setting->address2    = $request->address2;
            $setting->phone    = $request->phone;
            $setting->phone2    = $request->phone2;
            $setting->opening_time    = $request->opening_time;
            $setting->opening_time2    = $request->opening_time2;
            $setting->opening_time4    = $request->opening_time4;
            $setting->opening_time3    = $request->opening_time3;

            if ($request->hasFile('logo')) {
                $setting->logo = uploadImage($request->file('logo'), 'logos');

                if ($data->logo) {
                    $previousImagePath = public_path($data->logo);
                    if (file_exists($previousImagePath)) {
                        unlink($previousImagePath);
                    }
                }
            }else {
                $setting->logo = $data->logo;
            }

            if ($request->hasFile('favicon')) {
                $setting->favicon = uploadImage($request->file('favicon'), 'favicons');

                if ($data->favicon) {
                    $previousImagePath = public_path($data->favicon);
                    if (file_exists($previousImagePath)) {
                        unlink($previousImagePath);
                    }
                }
            }else {
                $setting->favicon = $data->favicon;
            }


            $setting->save();
            return back()->with('t-success', 'Updated successfully');
        } catch (Exception $e) {
            return back()->with('t-error', $e->getMessage());
        }
    }
}
