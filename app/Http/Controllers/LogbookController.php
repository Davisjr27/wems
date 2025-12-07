<?php

namespace App\Http\Controllers;

use App\Models\Logbook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogbookController extends Controller
{
    public function index()
    {
        $logbooks = Auth::user()->logbooks()->latest()->get(); // fetch student's logbooks

        return view('student.logbook.index', compact('logbooks'));
    }

    public function create()
    {
        return view('student.logbook.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'week' => 'required|integer',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'activities' => 'required|min:10',
            'company_stamp' => 'required|image|max:2048', // only one image
        ]);

        $stampName = null;
        if ($request->hasFile('company_stamp')) {
            $stampName = 'stamp_'.time().'.'.$request->company_stamp->extension();
            $request->company_stamp->storeAs('public/stamps', $stampName);
        }

        $workImageName = null;
        if ($request->hasFile('work_image')) {
            $workImageName = 'work_'.time().'.'.$request->work_image->extension();
            $request->work_image->storeAs('public/work_images', $workImageName);
        }

        Logbook::create([
            'user_id' => Auth::id(),
            'week' => $request->week,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'activities' => $request->activities,
            'company_stamp' => $stampName,
            'work_image' => $workImageName,
        ]);

        return redirect()->route('student.logbook.index')
            ->with('success', 'Logbook submitted successfully!');
    }

    public function download($id)
    {
        // Only fetch logbook for the authenticated student
        $log = Logbook::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        // Pass $log to the PDF Blade view
        return view('student.logbook.pdf', compact('log'));

        // Optional: for real PDF download using DOMPDF
        // $pdf = PDF::loadView('student.logbook.pdf', compact('log'));
        // return $pdf->download('logbook_week_'.$log->week.'.pdf');
    }
}
