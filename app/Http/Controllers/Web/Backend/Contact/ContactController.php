<?php

namespace App\Http\Controllers\Web\Backend\Contact;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ContactController extends Controller
{
     public function index(Request $request)
    {
         if ($request->ajax()) {
            $data = Contact::latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()

                ->addColumn('message',function($data){
                    $short_desc=$data->message;

                    $short_desc_content = strlen($short_desc) > 100 ? substr($short_desc,0,100).'...':$short_desc;

                    return "$short_desc_content";
                })


                ->addColumn('action', function ($data) {
                    return '<div class="text-center"><div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                              <a href="' . route('admin.contact.edit', ['id' => $data->id]) . '" class="text-white btn btn-primary" title="Edit">
                              <i class="fa-solid fa-eye"></i>
                              </a>
                              <a href="#" onclick="showDeleteConfirm(' . $data->id . ')" type="button" class="text-white btn btn-danger" title="Delete">
                              <i class="bi bi-trash"></i>
                            </a>
                            </div></div>';
                })
                ->rawColumns(['action','status'])
                ->make(true);
        }
        return view('backend.layouts.contact.index');
    }


    public function edit($id){
        $data=Contact::findOrFail($id);

        return view('backend.layouts.contact.edit',compact('data'));
    }

    public function destroy($id){
        $Contact=Contact::findOrFail($id);
        if(!$Contact){
            return response()->json([
            'success' => false,
            'message' => 'Not found the contact.',
        ]);
        }
        $Contact->delete();

        return response()->json([
            'success' => true,
            'message' => 'Contact deleted successfully.',
        ]);
    }
}
