<?php
namespace App\Http\Controllers\Officer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LogbookSubmission;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class SubmissionReviewController extends Controller
{
    public function index()
    {
        // List all pending submissions
        $submissions = LogbookSubmission::with('student')->orderBy('submitted_at','desc')->get();
        return view('officer.submission.index', compact('submissions'));
    }

    public function show($id)
    {
        $submission = LogbookSubmission::with('student')->findOrFail($id);
        return view('officer.submission.show', compact('submission'));
    }

    public function approve(Request $request, $id)
    {
        $submission = LogbookSubmission::findOrFail($id);
        $submission->update([
            'status' => 'approved',
            'officer_id' => Auth::id(),
            'review_comment' => $request->comment,
            'reviewed_at' => Carbon::now(),
        ]);

        // Optionally: append officer stamp/sign to PDF or store separate approval record

        return redirect()->route('officer.submission.index')->with('success','Submission approved.');
    }

    public function reject(Request $request, $id)
    {
        $submission = LogbookSubmission::findOrFail($id);
        $submission->update([
            'status' => 'rejected',
            'officer_id' => Auth::id(),
            'review_comment' => $request->comment,
            'reviewed_at' => Carbon::now(),
        ]);

        return redirect()->route('officer.submission.index')->with('success','Submission rejected.');
    }

    // Optional: download original PDF
    public function download($id)
    {
        $submission = LogbookSubmission::findOrFail($id);
        return response()->file(storage_path('app/public/' . $submission->pdf_path));
    }
}
