<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentLogbook;
use Illuminate\Support\Facades\Auth;

class StudentLogbookController extends Controller
{
    // Show form (optional — you already embedded in dashboard)
    public function create()
    {
        return view('student.logbook.create');
    }

    // Store logbook entry
    public function store(Request $request)
    {
        $request->validate([
            'week_number' => 'required|integer',
            'summary' => 'required|string',
            'stamp_file' => 'required|file|mimes:jpg,png,jpeg,pdf|max:2048',
        ]);

        $fileName = time() . '.' . $request->stamp_file->extension();
        $request->stamp_file->storeAs('logbook_stamps', $fileName, 'public');

        StudentLogbook::create([
            'student_id' => Auth::id(),
            'week_number' => $request->week_number,
            'summary' => $request->summary,
            'stamp_file' => $fileName,
        ]);

        return back()->with('success', 'Logbook entry submitted successfully!');
    }
    // List all logbooks
    public function index()
    {
        $entries = StudentLogbook::where('student_id', Auth::id())
                    ->orderBy('week_number', 'asc')
                    ->get();

        return view('student.logbook.index', compact('entries'));
    }
}
