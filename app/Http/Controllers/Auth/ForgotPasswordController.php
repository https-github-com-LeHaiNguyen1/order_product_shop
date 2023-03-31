<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;
    public function sendResetLinkEmail(Request $request)
{
    $this->validateEmail($request);

    $response = $this->broker()->sendResetLink(
        $request->only('email')
    );

    return $response == Password::RESET_LINK_SENT
                ? redirect()->route('login')->with('status', trans($response))
                : back()->withErrors(
                    ['email' => trans($response)]
                );
}
}
