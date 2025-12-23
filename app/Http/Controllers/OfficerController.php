<?php

namespace App\Http\Controllers;

use App\Models\LogbookSummary;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OfficerController extends Controller
{
    public function dashboard()
    {
        $pendingSummaries = LogbookSummary::with('student')
            ->where('status', 'pending')
            ->get();

        return view('officer.dashboard', compact('pendingSummaries'));
    }

    public function profile()
    {
        return view('officer.profile');
    }

    public function viewStudentLogbook($studentId)
    {
        $student = User::where('role', 'student')->findOrFail($studentId);

        $entries = $student->logbooks()->orderBy('start_date')->get();

        return view('officer.students.logbook', compact('student', 'entries'));
    }

    public function viewStudentSummary($studentId)
    {
        $summary = LogbookSummary::with('student')
            ->where('student_id', $studentId)
            ->firstOrFail();

        return view('officer.summary-view', compact('summary'));
    }

    public function approveSummary($id)
    {
        $summary = LogbookSummary::findOrFail($id);

        $summary->update([
            'status' => 'approved',
            'officer_id' => auth()->id(),
            'reviewed_at' => now(),
            'rejection_reason' => null,
        ]);

        return back()->with('success', 'Summary approved.');
    }

    public function rejectSummary(Request $request, $id)
    {
        $request->validate([
            'rejection_reason' => 'required|string|min:5',
        ]);

        $summary = LogbookSummary::findOrFail($id);

        $summary->update([
            'status' => 'rejected',
            'officer_id' => auth()->id(),
            'reviewed_at' => now(),
            'rejection_reason' => $request->rejection_reason,
        ]);

        return back()->with('error', 'Summary rejected.');
    }
}
