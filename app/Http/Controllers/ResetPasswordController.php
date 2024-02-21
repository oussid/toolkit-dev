<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ResetPassword;
use App\Mail\ResetPasswordMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ResetPasswordController extends Controller
{
    // SHOW FORGOT PASSWORD FORM
    public function showForgotPasswordForm () {
        return view('auth.forgot-password');
    }

    // SHOW RESET PASSWORD FORM
    public function showResetPasswordForm ($token) {
        $reset = DB::table('password_reset_tokens')->where('token', $token)->first();

        if (!$reset) {
            abort(404);
        }

        return view('auth.reset-password', compact('token'));
    }

    // GENERATE TOKEN & SEND PASSWORD RESET EMAIL
    public function sendResetPasswordEmail (Request $request) {
        $request->validate([
            'email' => 'required|email'
        ]);

        $user = DB::table('users')->where('email', $request->email)->first();

        if(!$user) {
            return redirect()->back()->with('error', 'Email was not found.');
        }

        $token = ResetPassword::where('email', $request->email);
        if($token) {
            $token->delete();
        }

        $token = Str::random(60);

        ResetPassword::create([
            'email' => $request->email,
            'token' => $token
        ]);

        // send email
        Mail::to($request->email)->send(new ResetPasswordMail($token));
        
        return redirect()->back()->with('success', 'A password reset link was sent to your email');
    }

    // VALIDATE TOKEN & RESET PASSWORD
    public function resetPassword (Request $request) {
        
        $request->validate([
            'token' => 'required',
            'password' => 'required|confirmed',
        ]);
        
        $token = ResetPassword::where('token', $request->token)->first();

        // token does not exist in db
        if (!$token) {
            abort(404);
        }

        // get user 
        $user = User::where('email', $token->email);
        if(!$user) {
            abort(404);
        }

        $user->update(['password' => Hash::make($request->password)]);

        DB::table('password_reset_tokens')->where('token', $request->token)->delete();

        // redirect to the login page with a success message
        return redirect()->route('login')->with('success', 'Your password has been reset!');
    }
}
