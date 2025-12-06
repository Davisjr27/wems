@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-10">

    <h2 class="text-2xl font-bold mb-4">My Weekly Logbook Entries</h2>

    @if($entries->count() == 0)
        <p class="text-gray-600">No entries yet.</p>
    @else
        <div class="space-y-4">
            @foreach($entries as $entry)
                <div class="bg-white p-4 shadow rounded">
                    <h3 class="font-semibold">Week {{ $entry->week_number }}</h3>
                    <p class="text-gray-700">{{ $entry->summary }}</p>

                    <a href="{{ asset('storage/logbook_stamps/' . $entry->stamp_file) }}"
                       class="text-blue-500 underline mt-2 inline-block">
                        View Uploaded Stamp File
                    </a>
                </div>
            @endforeach
        </div>
    @endif

</div>
@endsection
