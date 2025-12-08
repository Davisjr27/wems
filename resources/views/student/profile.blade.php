@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded-xl shadow">

    <h2 class="text-2xl font-bold mb-6">Student Profile</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <!-- Passport Photo -->
        <div class="flex flex-col items-center">
            <h3 class="text-lg font-semibold mb-3">Passport Photo</h3>

            @if (Auth::user()->photo)
                <img src="{{ asset('storage/passports/' . Auth::user()->photo) }}"
                     class="w-40 h-40 rounded-lg border object-cover shadow">
            @else
                <div class="w-40 h-40 bg-gray-100 rounded-lg border flex items-center justify-center">
                    <span class="text-gray-400">No Photo</span>
                </div>
            @endif
        </div>

        <!-- Student Details -->
        <div class="md:col-span-2 space-y-4">
            <div>
                <label class="font-semibold text-gray-600">Full Name:</label>
                <p class="text-gray-800">{{ Auth::user()->name }}</p>
            </div>

            <div>
                <label class="font-semibold text-gray-600">Email:</label>
                <p class="text-gray-800">{{ Auth::user()->email }}</p>
            </div>

            <div>
                <label class="font-semibold text-gray-600">Matric Number:</label>
                <p class="text-gray-800">{{ Auth::user()->student_number ?? 'Not Provided' }}</p>
            </div>

            <div>
                <label class="font-semibold text-gray-600">Department:</label>
                <p class="text-gray-800">{{ Auth::user()->department ?? 'Not Provided' }}</p>
            </div>

            {{-- <div>
                <label class="font-semibold text-gray-600">Level:</label>
                <p class="text-gray-800">{{ Auth::user()->level ?? 'Not Provided' }}</p>
            </div> --}}
        </div>

    </div>

</div>
@endsection
