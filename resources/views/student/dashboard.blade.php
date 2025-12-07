@extends('layouts.app')

@section('content')
    {{-- // Flash Messages --}}
    @if (session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-lg border border-green-300">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="mb-4 p-4 bg-red-100 text-red-800 rounded-lg border border-red-300">
            {{ session('error') }}
        </div>
    @endif

    @if (session('warning'))
        <div class="mb-4 p-4 bg-yellow-100 text-yellow-800 rounded-lg border border-yellow-300">
            {{ session('warning') }}
        </div>
    @endif

    @if (session('info'))
        <div class="mb-4 p-4 bg-blue-100 text-blue-800 rounded-lg border border-blue-300">
            {{ session('info') }}
        </div>
    @endif

    <div class="max-w-7xl mx-auto py-10 px-4">

        {{-- HEADER --}}
        <div class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white p-6 rounded-xl shadow-md mb-8">
            <h2 class="text-3xl font-semibold">Student Dashboard</h2>
            <p class="text-blue-100 mt-1">Welcome, {{ Auth::user()->name }}</p>
        </div>

        {{-- 2-COLUMN GRID --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

            {{-- LEFT SIDEBAR CARD --}}
            <div class="md:col-span-1 space-y-6">

                {{-- Passport --}}
                <div x-data="{ open: false }" class="bg-white shadow p-6 rounded-xl text-center">
                    <h3 class="text-lg font-semibold mb-3">Passport Photo</h3>

                    @if (Auth::user()->passport)
                        <img src="{{ asset('storage/passports/' . Auth::user()->passport) }}"
                            class="w-36 h-36 mx-auto rounded-lg border shadow object-cover">
                    @else
                        <div class="w-36 h-36 mx-auto bg-gray-100 flex items-center justify-center rounded-lg border">
                            <span class="text-gray-400">No Photo</span>
                        </div>
                    @endif

                    <button @click="open = true" class="mt-3 inline-block text-blue-600 text-sm underline">
                        Change Photo
                    </button>

                    <!-- Modal -->
                    <div x-show="open" x-transition
                        class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">

                        <div @click.away="open = false" class="bg-white p-6 rounded-xl shadow-xl w-96">

                            <h2 class="text-lg font-semibold mb-4">Upload New Passport</h2>

                            <form action="{{ route('student.passport.update') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                <input type="file" name="passport" accept="image/*" required
                                    class="w-full border rounded-lg p-2 mb-4">

                                <div class="flex justify-end gap-2">
                                    <button type="button" @click="open = false"
                                        class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded-lg">
                                        Cancel
                                    </button>

                                    <button type="submit"
                                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                        Upload
                                    </button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>


                {{-- Shortcuts --}}
                <div class="bg-white shadow p-6 rounded-xl">
                    <h3 class="text-lg font-semibold mb-4">Quick Actions</h3>

                    <ul class="space-y-3">
                        <li>
                            <a href="{{ route('student.logbook.index') }}"
                                class="block bg-blue-50 hover:bg-blue-100 p-3 rounded-lg text-blue-700 font-medium">
                                📘 View My Logbook Entries
                            </a>
                        </li>
                    </ul>
                </div> <br><br>

                {{-- Download PDF --}}

                <a href="{{ route('student.logbook.pdf') }}"
                    class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg shadow">
                    Download Full Logbook PDF
                </a>

            </div>

            {{-- RIGHT CONTENT --}}
            <div class="md:col-span-2">

                {{-- FORM CARD --}}
                <div class="bg-white shadow p-8 rounded-xl mb-8">
                    <h3 class="text-2xl font-semibold mb-6">Submit Weekly Logbook</h3>

                    <form action="{{ route('student.logbook.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- Week Number --}}
                        <div class="mb-6">
                            <label class="block mb-2 font-medium">Week Number</label>
                            <input type="number" name="week_number"
                                class="w-full border-gray-300 p-3 rounded-lg shadow-sm focus:ring focus:ring-blue-200"
                                placeholder="Enter week number" required>
                        </div>

                        {{-- Weekly Summary --}}
                        <div class="mb-6">
                            <label class="block mb-2 font-medium">Weekly Summary</label>
                            <textarea name="summary" rows="5"
                                class="w-full border-gray-300 p-3 rounded-lg shadow-sm focus:ring focus:ring-blue-200"
                                placeholder="Describe your weekly activities..." required></textarea>
                        </div>

                        {{-- Upload Stamp/Signature --}}
                        <div class="mb-6">
                            <label class="block mb-2 font-medium">Upload Stamped Page</label>
                            <input type="file" name="stamp_file"
                                class="w-full border-gray-300 p-3 rounded-lg bg-white shadow-sm"
                                accept="image/*,application/pdf" required>
                            <p class="text-gray-500 text-sm mt-1">Accepted: JPG, PNG, PDF • Max: 2MB</p>
                        </div>

                        <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-lg shadow">
                            Submit Weekly Entry
                        </button>
                    </form>
                </div>

            </div>

        </div>


    </div>
@endsection
