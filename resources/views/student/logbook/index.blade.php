@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto px-6 py-8">
        <h2 class="text-2xl font-bold mb-6">My Logbook Submissions</h2>

        @if ($logbooks->isEmpty())
            <p class="text-gray-500">No logbook entries yet. <a href="{{ route('student.logbook.create') }}"
                    class="text-blue-600 underline">Create one now</a>.</p>
        @else
            <div class="mb-6">
                <a href="{{ route('student.submission.create') }}" class="bg-green-600 hover:bg-green-700 text-white font-medium px-6 py-3 rounded-xl shadow-md transition-all duration-200">
                    Submit All Entries to Officer
                </a>
            </div>
            <div class="grid md:grid-cols-2 gap-4">
                <div class="max-w-6xl mx-auto px-6 py-8">

                    @foreach ($logbooks as $logbook)
                        <div
                            class="p-4 bg-white rounded-lg shadow flex flex-col md:flex-row items-start md:items-center gap-4">
                            <div class="flex-1">
                                <strong>Week {{ $logbook->week }}</strong> ({{ $logbook->start_date }} →
                                {{ $logbook->end_date }})
                                <p class="text-gray-700 mt-2">{{ $logbook->activities }}</p>
                            </div>
                            <div>
                                @if ($logbook->company_stamp)
                                    <img src="{{ asset('storage/' . $logbook->company_stamp) }}"
                                        class="w-32 h-32 object-contain border rounded-lg">
                                @else
                                    <div class="w-32 h-32 flex items-center justify-center border rounded-lg text-gray-400">
                                        No Stamp
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        @endif
    </div>
@endsection
