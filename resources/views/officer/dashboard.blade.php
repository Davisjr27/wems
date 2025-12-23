@extends('layouts.app')

@section('content')
    <h2 class="text-xl font-semibold mb-4">Students SIWES Summary</h2>

@if ($students->isEmpty())
    <p class="text-gray-500">No students found.</p>
@else
    <table class="w-full border rounded-lg overflow-hidden">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-3 text-left">Name</th>
                <th class="p-3 text-left">Matric No</th>
                <th class="p-3 text-left">Department</th>
                <th class="p-3 text-left">Status</th>
                <th class="p-3 text-left">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
                <tr class="border-t">
                    <td class="p-3">{{ $student->name }}</td>
                    <td class="p-3">{{ $student->student_number }}</td>
                    <td class="p-3">{{ $student->department }}</td>
                    <td class="p-3">
                        <span class="px-2 py-1 rounded text-sm
                            @if($student->summary_status === 'approved') bg-green-100 text-green-700
                            @elseif($student->summary_status === 'rejected') bg-red-100 text-red-700
                            @else bg-yellow-100 text-yellow-700 @endif">
                            {{ ucfirst($student->summary_status) }}
                        </span>
                    </td>
                    <td class="p-3">
                        <a href="{{ route('officer.student.view', $student->id) }}"
                           class="text-indigo-600 hover:underline">
                            View Summary
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif

// display summary status
@if(auth()->user()->logbookSummary)
    <p>Status:
        <span class="font-semibold">
            {{ auth()->user()->logbookSummary->status }}
        </span>
    </p>

    @if(auth()->user()->logbookSummary->status === 'rejected')
        <p class="text-red-600">
            Reason: {{ auth()->user()->logbookSummary->rejection_reason }}
        </p>
    @endif
@else
    <p>No summary submitted yet.</p>
@endif


@endSection
