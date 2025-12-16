@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto p-6">
    <h2 class="text-2xl font-bold mb-4">Submitted Logbooks</h2>

    <table class="min-w-full bg-white">
        <thead>
            <tr>
                <th class="p-3">Student</th>
                <th class="p-3">Submitted At</th>
                <th class="p-3">Status</th>
                <th class="p-3">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($submissions as $s)
            <tr class="border-t">
                <td class="p-3">{{ $s->student->name }} ({{ $s->student->student_number }})</td>
                <td class="p-3">{{ $s->submitted_at->format('d M Y H:i') }}</td>
                <td class="p-3 capitalize">{{ $s->status }}</td>
                <td class="p-3">
                    <a href="{{ route('officer.submission.show', $s->id) }}" class="text-blue-600">Preview</a>
                    <a href="{{ route('officer.submission.download', $s->id) }}" class="ml-4 text-gray-600">Download</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
