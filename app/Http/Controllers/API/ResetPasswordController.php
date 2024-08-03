<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\ResetCodePassword;
use App\Models\User;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    public function index(Request $request)
    {
        // dd($request->code);
        $passwordReset = ResetCodePassword::firstWhere('code', $request->code);
        // dd($passwordReset);
        // if ($passwordReset->isExpire()) {
        //     return $this->jsonResponse(null, trans('passwords.code_is_expire'), 422);
        // }

        $user = User::firstWhere('email', $passwordReset->email);

        $user->update($request->only('password'));

        $passwordReset->delete();

        // return $this->jsonResponse(null, trans('site.password_has_been_successfully_reset'), 200);
        // return response(['message' => trans('site.password_has_been_successfully_reset')], 200);

        return ResponseFormatter::success("", trans('site.password_has_been_successfully_reset'));
    }
}
