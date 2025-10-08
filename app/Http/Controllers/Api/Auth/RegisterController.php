<?php

namespace App\Http\Controllers\Api\Auth;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Driver;
use App\Models\EmailOtp;
use App\Models\Supplier;
use App\Traits\ApiResponse;
use App\Mail\RegistationOtp;
use Illuminate\Http\Request;
use GuzzleHttp\Promise\Create;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller {

    use ApiResponse;

    /**
     * Send a Register (OTP) to the user via email.
     *
     * @param  \App\Models\User  $user
     * @return void
     */

    private function sendOtp($user) {
        $code = rand(1000, 9999);

        // Store verification code in the database
        $verification = EmailOtp::updateOrCreate(
            ['user_id' => $user->id],
            [
                'verification_code' => $code,
                'expires_at'        => Carbon::now()->addMinutes(15),
            ]
        );

        Mail::to($user->email)->send(new RegistationOtp($user, $code));
    }

    /**
     * Register User
     *
     * @param  \Illuminate\Http\Request  $request  The HTTP request with the register query.
     * @return \Illuminate\Http\JsonResponse  JSON response with success or error.
     */

    public function userRegister(Request $request) {

        $rules = [
            'name'           => 'required|string|max:255',
            'email'          => 'required|email|unique:users,email',
            'role'           => 'nullable|in:supplier,driver,user',
            'password'       => [
                'required',
                'string',
                'min:8',
            ],
        ];

        if ($request->input('role') == 'supplier') {
            $rules['company_name'] = 'required|string|max:255';
            $rules['cif'] = 'required|string|max:255';
        }

        if($request->input('role') == 'driver') {
            $rules['truck_number'] = 'required|string|max:255';
            $rules['reference_code'] = 'required|string|max:255';
        }

        $messages = [
            'password.min' => 'The password must be at least 8 characters long.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            DB::beginTransaction();
            // Find the user by ID
            $user                 = new User();
            $user->name           = $request->input('name');
            $user->email          = $request->input('email');
            $user->password       = Hash::make($request->input('password'));
            // $user->role           = $request->input('role');
            $user->email_verified_at = now();

            $user->save();

            if ($request->input('role') == 'supplier') {
               Supplier::create([
                   'user_id' => $user->id,
                   'company_name' => $request->input('company_name'),
                   'cif' => $request->input('cif'),
               ]);
            }

            if($request->input('role') == 'driver') {
                Driver::create([
                    'user_id' => $user->id,
                    'truck_number' => $request->input('truck_number'),
                    'reference_code' => $request->input('reference_code'),
                ]);
            }

            $token = JWTAuth::fromUser($user);

            $user->setAttribute('token', $token);

            if($request->input('role') == 'supplier') {
               $user->load('supplier');
            }

            if($request->input('role') == 'driver') {
                $user->load('driver');
            }

            DB::commit();
            return $this->success($user, 'User registered successfully', 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error([], $e->getMessage(), 500);
        }
    }

    /**
     * Verify the OTP sent to the user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function otpVerify(Request $request) {

        // Validate the request
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'otp' => 'required|numeric|digits:4',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), "Validation Error", 422);
        }

        try {
            // Retrieve the user by email
            $user = User::where('email', $request->input('email'))->first();

            $verification = EmailOtp::where('user_id', $user->id)
            ->where('verification_code', $request->input('otp'))
            ->where('expires_at', '>', Carbon::now())
            ->first();


            if ($verification) {

                $user->email_verified_at = Carbon::now();
                $user->save();

                $verification->delete();

                $token = JWTAuth::fromUser($user);

                $user->setAttribute('token', $token);

                return $this->success($user, 'OTP verified successfully', 200);
            } else {

                return $this->error([], 'Invalid or expired OTP', 400);
            }
        } catch (\Exception $e) {
            return $this->error([], $e->getMessage(), 500);
        }
    }

    /**
     * Resend an OTP to the user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function otpResend(Request $request) {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), "Validation Error", 422);
        }

        try {
            // Retrieve the user by email
            $user = User::where('email', $request->input('email'))->first();

            $this->sendOtp($user);

            return $this->success($user, 'OTP has been sent successfully.', 200);
        } catch (\Exception $e) {
            return $this->error([], $e->getMessage(), 500);
        }
    }
}
