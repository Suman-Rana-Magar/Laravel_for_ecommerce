<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    public function show()
    {
        return view('verification.show');
    }

    // public function verity(EmailVerificationRequest $request)
    // {
    //     $request->fulfill();
    // }
    public function verify(Request $request, $id, $token)
    {
        $user = User::find($id);
        
        if (!$user) {
            return redirect('/register')->with('error', 'Invalid verification link.');
        }
        if ($user->email_verified == 1) {
            return redirect('/login')->with('success', 'Email already verified.');
        }
        // dd($user);

        $email_verification_token = $user->email_verification_token;

        if(!$email_verification_token == $token)
        {
            return redirect('/register')->with('error','Unable to verify this email, please try again later !');
        }
        // dd($email_verification_token);

        $user->email_verified = 1;
        $user->email_verification_token = null;
        $user->email_verified_at = now();
        $user->update();

        return redirect('/login')->with('success', 'Email verified successfully. You can now log in.');
    }

    public function resend($id)
    {
        $user = User::find($id);
        if ($user->email_verified == 1) {
            return redirect('/login');
        }
        // dd($user);
        $user->sendEmailVerificationNotification();

        return back()->with('success', 'Verification email resent.');
    }
}
