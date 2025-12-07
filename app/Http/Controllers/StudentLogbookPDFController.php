<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Logbook;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class StudentLogbookPDFController extends Controller
{
    public function generate()
    {
        $student = Auth::user();
        $logs = Logbook::where('user_id', $student->id)->orderBy('week_number', 'asc')->get();

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
