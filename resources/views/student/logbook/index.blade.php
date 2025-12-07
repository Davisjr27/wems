@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-6 py-8">
    <h2 class="text-2xl font-bold mb-6">My Logbook Submissions</h2>

    @if($logbooks->isEmpty())
        <p class="text-gray-500">No logbook entries yet. <a href="{{ route('student.logbook.create') }}" class="text-blue-600 underline">Create one now</a>.</p>
    @else
        <div class="grid md:grid-cols-2 gap-4">
            @foreach($logbooks as $log)
                <div class="bg-white p-4 rounded-lg shadow">
                    <h3 class="font-semibold">{{ $log->week }}</h3>
                    <p class="text-sm text-gray-600">{{ $log->start_date }} → {{ $log->end_date }}</p>
                    <p class="mt-2">{{ Str::limit($log->activities, 100) }}</p>

                    <div class="mt-2 flex gap-2">
                        <a href="{{ route('student.logbook.download', $log->id) }}" class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700">Download PDF</a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
