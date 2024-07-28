<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    //

    public function edit()
    {
        $user = Auth::user();
        return view('manageProfile', compact('user'));
    }

    public function update(Request $request)
    {
        $profile = Auth::user();
        $request->validate([
            'name' => 'required|string|min:1|max:255',
            'email' => 'required|email',
        ]);
        $profile->name = $request->input('name');
        $profile->email = $request->input('email');
        $profile->save();
        Session::put('statusCode', 'success');
        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully.');
    }
}
