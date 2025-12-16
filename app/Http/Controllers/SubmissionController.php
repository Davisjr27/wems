<?php
namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Logbook;
use App\Models\LogbookSubmission;
use Illuminate\Support\Facades\Auth;
use PDF; // barryvdh/laravel-dompdf
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class SubmissionController extends Controller
{
    public function create()
    {
        // Show summary of entries and "Submit" button
        $student = Auth::user();
        $entries = $student->logbooks()->orderBy('week')->get();

        return view('student.submission.create', compact('entries'));
    }

    public function store(Request $request)
    {
        $student = Auth::user();

        // optional validation: ensure there are entries
        $entries = $student->logbooks()->orderBy('week')->get();
        if ($entries->isEmpty()) {
            return back()->with('error','No logbook entries to submit.');
        }

        // generate PDF (see template at resources/views/student/submission/pdf.blade.php)
        $pdf = PDF::loadView('student.submission.pdf', [
            'student' => $student,
            'entries' => $entries,
        ])->setPaper('a4', 'portrait');

        // filename + storage
        $filename = 'logbook_'.$student->id.'_'.time().'.pdf';
        $path = 'logbook_submissions/'.$filename;

        // store PDF binary into public disk
        Storage::disk('public')->put($path, $pdf->output());

        // create submission record
        $submission = LogbookSubmission::create([
            'student_id' => $student->id,
            'title' => 'SIWES Logbook Submission',
            'pdf_path' => $path,
            'status' => 'pending',
            'submitted_at' => Carbon::now(),
        ]);

        // optionally notify officers (email, in-app)... omitted for brevity

        return redirect()->route('student.submission.index')
            ->with('success','Logbook submitted for officer review.');
    }

    public function index()
    {
        $submissions = Auth::user()->submissions()->latest()->get();
        return view('student.submission.index', compact('submissions'));
    }
}
