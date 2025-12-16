@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6">
    <h2 class="text-2xl font-bold mb-4">Submit Final Logbook</h2>

    <div class="bg-white p-4 rounded shadow mb-6">
        <h3 class="font-semibold mb-2">Entries to be included</h3>
        @foreach($entries as $e)
            <div class="border-b py-2">
                <div class="flex justify-between">
                    <div>Week {{ $e->week }}</div>
                    <div class="text-sm text-gray-500">{{ $e->start_date }} → {{ $e->end_date }}</div>
                </div>
                <p class="mt-1 text-sm">{{ \Illuminate\Support\Str::limit($e->activities,200) }}</p>
            </div>
        @endforeach
    </div>

    <form action="{{ route('student.submission.store') }}" method="POST">
        @csrf
        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Submit Final Logbook for Review</button>
    </form>
</div>
@endsection
