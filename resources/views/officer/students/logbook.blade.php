<x-app-layout>
    <div class="p-6">
<h2 class="text-xl font-bold mb-4">Logbook for {{ $student->name }}</h2>

<table class="w-full border border-gray-300 rounded-lg">
    <thead class="bg-gray-100">
        <tr>
            <th class="p-2 border">Date</th>
            <th class="p-2 border">Activity</th>
            <th class="p-2 border">Hours</th>
        </tr>
    </thead>
    <tbody>
        @foreach($entries as $entry)
            <tr>
                <td class="p-2 border">{{ $entry->date }}</td>
                <td class="p-2 border">{{ $entry->activity }}</td>
                <td class="p-2 border">{{ $entry->hours }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<a href="{{ route('officer.student.summary', $student->id) }}"
    class="px-4 py-2 bg-blue-600 text-white rounded-lg">
    Preview Final Summary
</a>





</x-app-layout>
