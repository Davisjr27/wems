<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function dashboard()
    {
        return view('student.dashboard');
    }

    public function profile()
    {
        return view('student.profile');
    }

    public function updatePassport(Request $request)
    {
        $request->validate([
            'passport' => 'required|image|max:2048'
        ]);

        $user = Auth::user();

        // delete old passport
        if ($user->passport && file_exists(storage_path('app/public/passports/' . $user->passport))) {
            unlink(storage_path('app/public/passports/' . $user->passport));
        }

        // rename file cleanly
        $newName = 'passport_' . $user->id . '.' . $request->passport->extension();

        $request->passport->storeAs('public/passports', $newName);

        $user->passport = $newName;
        $user->save();

        return back()->with('success', 'Passport updated successfully.');
    }
}
