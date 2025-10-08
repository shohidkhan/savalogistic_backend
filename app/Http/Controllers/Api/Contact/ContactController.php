<?php

namespace App\Http\Controllers\Api\Contact;

use App\Http\Controllers\Controller;
use App\Mail\ContactMail;
use App\Models\Contact;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    use ApiResponse;

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'name'=>'required|string|max:255',
            'email'=>'required|email',
            'message'=>'required|string',
        ]);

        if($validator->fails()){
            return $this->error($validator->errors(),$validator->errors()->first(),422);
        }

        $contact=Contact::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'message'=>$request->message,
        ]);

        $admin=User::where('role','admin')->first();

        Mail::to($admin->email)->send(new ContactMail($contact));


        return $this->success([],'Thank you for message.',200);
    }
}
