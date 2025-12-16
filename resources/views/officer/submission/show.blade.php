@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto p-6">
    <div class="flex gap-6">
        <div class="w-1/3 bg-white p-4 rounded shadow">
            <h3 class="font-semibold mb-2">Student</h3>
            <p class="font-medium">{{ $submission->student->name }}</p>
            <p class="text-sm text-gray-600">{{ $submission->student->student_number }}</p>
            <p class="mt-3"><strong>Email:</strong> {{ $submission->student->email }}</p>
            <p><strong>Phone:</strong> {{ $submission->student->phone }}</p>
        </div>

        <div class="flex-1 bg-white p-4 rounded shadow">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold">SIWES Final Logbook Preview</h3>
                <div class="flex gap-2">
                    @if($submission->status == 'pending')
                    <form action="{{ route('officer.submission.approve', $submission->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="comment" value="Approved">
                        <button class="px-3 py-1 bg-green-600 text-white rounded">Approve</button>
                    </form>
                    <button @click="document.getElementById('reject-form').classList.toggle('hidden')"
                        class="px-3 py-1 bg-red-600 text-white rounded">Reject</button>
                    @endif
                </div>
            </div>

            @if($submission->pdf_path)
                <iframe src="{{ asset('storage/' . $submission->pdf_path) }}" class="w-full h-[700px] border"></iframe>
            @else
                <p class="text-gray-500">No PDF available</p>
            @endif

            <form id="reject-form" class="hidden mt-4" action="{{ route('officer.submission.reject', $submission->id) }}" method="POST">
                @csrf
                <textarea name="comment" class="w-full border rounded p-2" placeholder="Rejection reason (optional)"></textarea>
                <div class="mt-2 flex gap-2">
                    <button type="submit" class="px-3 py-1 bg-red-600 text-white rounded">Submit Rejection</button>
                    <button type="button" onclick="document.getElementById('reject-form').classList.add('hidden')" class="px-3 py-1 border rounded">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
