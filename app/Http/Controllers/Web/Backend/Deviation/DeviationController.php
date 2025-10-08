<?php

namespace App\Http\Controllers\Web\Backend\Deviation;

use App\Http\Controllers\Controller;
use App\Models\Deviation;
use Illuminate\Http\Request;

class DeviationController extends Controller
{
    public function index() {

        $data = Deviation::latest('id')->first();
        return view('backend.layouts.deviation.index', compact('data'));
    }
    public function update(Request $request) {
        $request->validate([
            'deviation' => 'required|numeric',
        ]);
        $data = Deviation::first();

        if (!$data) {
            $data = new Deviation();
        }

        $data->deviation = $request->deviation;
        $data->save();

        return redirect()->back()->with('t-success', 'Deviation updated.');
    }
}
