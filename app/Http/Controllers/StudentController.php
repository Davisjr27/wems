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
            'passport' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $file = $request->file('passport');

        // Create a clean file name
        $filename = 'passport_'.Auth::id().'_'.time().'.'.$file->getClientOriginalExtension();

        // Store inside storage/app/public/passports
        $file->storeAs('public/passports', $filename);

        // Save filename to database (column: photo)
        $user = Auth::user();
        $user->photo = $filename;
        $user->save();

        return back()->with('success', 'Passport updated successfully!');
    }
}
