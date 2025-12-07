<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\StudentLogbook;
use Illuminate\Support\Facades\Auth;
use PDF;

class StudentLogbookPDFController extends Controller
{
    public function generate()
    {
        $student = Auth::user();
        $logs = StudentLogbook::where('student_id', $student->id)
                    ->orderBy('week_number', 'asc')
                    ->get();

        $officer = (object)[
            'signature' => 'officer_signature.png', // placeholder
            'stamp' => 'officer_stamp.png',         // placeholder
            'name' => 'SIWES Officer'
        ];

        $pdf = PDF::loadView('student.logbook.pdf', [
            'student' => $student,
            'logs' => $logs,
            'officer' => $officer
        ])->setPaper('a4', 'portrait');

        return $pdf->stream('SIWES_Logbook.pdf');
    }
}
