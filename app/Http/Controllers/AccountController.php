<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return view('account.index', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();

        return view('account.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('account.index')
            ->with('success', 'Profile updated successfully.');
    }

    public function password()
    {
        return view('account.password');
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            return back()
                ->withErrors([
                    'current_password' => 'The current password is incorrect.',
                ]);
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('account.index')
            ->with('success', 'Password changed successfully.');
    }
}