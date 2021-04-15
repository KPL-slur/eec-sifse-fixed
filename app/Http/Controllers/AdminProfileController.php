<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PasswordRequest;
use App\Http\Requests\AdminProfileRequest;
use Illuminate\Support\Facades\Hash;


class AdminProfileController extends Controller
{
    public function edit()
    {
        return view('profile.edit-admin');
    }

    // public function update(AdminProfileRequest $request)
    // {
    //     auth()->user()->update(['email' => $request->email]);
    //     dd($request);

    //     return back()->with('email_status', 'Email Updated!');
    // }

    public function password(PasswordRequest $request)
    {
        auth()->user()->update(['password' => Hash::make($request->get('password'))]);

        return back()->with('password_status', 'Password has succesfully changed!');
    }
}
