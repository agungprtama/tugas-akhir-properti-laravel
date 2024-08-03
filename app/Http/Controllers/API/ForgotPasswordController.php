<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Mail\SendCodeResetPassword;
use App\Models\ResetCodePassword;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
    public function index(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
        ]);

        // Check if the email exists in the users table
        $userExists = User::where('email', $request->email)->exists();

        if (!$userExists) {
            // return response(['message' => 'Email not found in the users table'], 400);
            return ResponseFormatter::error("", trans('passwords.sent'), 400);
        }

        ResetCodePassword::where('email', $request->email)->delete();

        $data['code'] = mt_rand(100000, 999999);

        $codeData = ResetCodePassword::create($data);

        $sendCodeResetPW = new SendCodeResetPassword($codeData->code);
        Mail::to($request->email)->send($sendCodeResetPW);

        // return response(['message' => trans('passwords.sent')], 200);
        return ResponseFormatter::success("", trans('passwords.sent'));
    }
}
