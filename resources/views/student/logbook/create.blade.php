@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-6 bg-white shadow rounded-lg mt-10">

    <h1 class="text-2xl font-bold mb-6">Add Weekly Logbook</h1>

    <form action="{{ route('student.logbook.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <div>
            <label class="font-medium">Week</label>
            <input type="text" name="week" class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="font-medium">Start Date</label>
                <input type="date" name="start_date" class="w-full border rounded px-3 py-2" required>
            </div>
            <div>
                <label class="font-medium">End Date</label>
                <input type="date" name="end_date" class="w-full border rounded px-3 py-2" required>
            </div>
        </div>

        <div>
            <label class="font-medium">Activities / Summary</label>
            <textarea name="activities" rows="4" class="w-full border rounded px-3 py-2" required></textarea>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="font-medium">Company Signature</label>
                <input type="file" name="company_signature" class="w-full border rounded px-3 py-2">
            </div>
            <div>
                <label class="font-medium">Company Stamp</label>
                <input type="file" name="company_stamp" class="w-full border rounded px-3 py-2">
            </div>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Submit Logbook</button>
        </div>
    </form>

</div>
@endsection
