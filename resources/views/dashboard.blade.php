@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-10">

    {{-- Dashboard Header --}}
    <div class="bg-white shadow p-6 rounded-lg mb-6">
        <h2 class="text-2xl font-bold mb-2">Student Dashboard</h2>
        <p class="text-gray-600">Welcome, {{ Auth::user()->name }}</p>
    </div>

    {{-- Passport Display --}}
    <div class="bg-white shadow p-6 rounded-lg mb-6">
        <h3 class="text-xl font-semibold mb-4">Your Passport Photo</h3>

        @if(Auth::user()->passport)
            <img src="{{ asset('storage/passports/' . Auth::user()->passport) }}"
                 class="w-32 h-32 rounded border object-cover">
        @else
            <p class="text-gray-500 text-sm">No passport uploaded yet.</p>
        @endif
    </div>

    {{-- Weekly Logbook Form --}}
    <div class="bg-white shadow p-6 rounded-lg">
        <h3 class="text-xl font-bold mb-4">Weekly Logbook Entry</h3>

        <form action="{{ route('student.logbook.store') }}"
              method="POST"
              enctype="multipart/form-data">
            @csrf

            {{-- Week Number --}}
            <div class="mb-4">
                <label class="block mb-1 font-medium">Week Number</label>
                <input type="number" name="week_number"
                       class="w-full border p-2 rounded"
                       placeholder="e.g. 1" required>
            </div>

            {{-- Weekly Summary --}}
            <div class="mb-4">
                <label class="block mb-1 font-medium">Weekly Summary</label>
                <textarea name="summary" rows="4"
                          class="w-full border p-2 rounded"
                          placeholder="Describe what you did this week..."
                          required></textarea>
            </div>

            {{-- Upload Stamped Document --}}
            <div class="mb-4">
                <label class="block mb-1 font-medium">
                    Upload Company Stamped/Signature Page (Scanned)
                </label>
                <input type="file" name="stamp_file"
                       class="w-full border p-2 rounded bg-white"
                       accept="image/*,application/pdf"
                       required>
                <p class="text-xs text-gray-500 mt-1">
                    Accepted: JPG, PNG, PDF (Max 2MB)
                </p>
            </div>

            {{-- Submit Button --}}
            <button type="submit"
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Submit Logbook Entry
            </button>
        </form>
    </div>

</div>
@endsection
