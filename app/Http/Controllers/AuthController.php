<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('auth.login');
    }

    // LOGIN
    public function login (Request $request) {
        $credentials = $request->validate([
            'email'=> 'required|email',
            'password'=> 'required',
        ]);

        if (Auth::attempt($credentials)){
            $user = Auth::user();
            Auth::login($user);
            return redirect('/')->with('success', 'Welcome back '. $user->name);
        }else{
            return redirect()->back()->with('error', 'Wrong email address or password');
        }
    }

    // LOGOUT
    public function logout (Request $request) {
        if (Auth::user()){
            Auth::logout();
            return redirect('/');
        }
        return redirect()->back();
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
