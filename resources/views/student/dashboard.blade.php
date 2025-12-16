@extends('layouts.app')

@section('content')
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
                <div class="bg-white shadow p-6 rounded-xl text-center">
                    <h3 class="text-lg font-semibold mb-3">Passport Photo</h3>

                    @if (Auth::user()->photo)
                        <img src="{{ asset('storage/' . Auth::user()->photo) }}"
                            class="w-36 h-36 mx-auto rounded-lg border shadow object-cover">
                    @else
                        <div class="w-36 h-36 mx-auto bg-gray-100 flex items-center justify-center rounded-lg border">
                            <span class="text-gray-400">No Photo</span>
                        </div>
                    @endif
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
                <div x-data="logbookForm()" class="max-w-3xl mx-auto bg-white shadow-lg rounded-2xl p-8 mb-12">
                    <h2 class="text-3xl font-bold mb-8 text-center text-gray-800">Submit Weekly Logbook</h2>

                    <form action="{{ route('student.logbook.store') }}" method="POST" enctype="multipart/form-data"
                        class="space-y-6">
                        @csrf

                        {{-- Week Number --}}
                        <div>
                            <label for="week" class="block text-gray-700 font-medium mb-2">Week Number</label>
                            <input type="number" name="week" id="week" min="1"
                                class="w-full border border-gray-300 rounded-xl p-3 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400 shadow-sm"
                                placeholder="Enter week number" required>
                        </div>

                        {{-- Start & End Dates --}}
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="start_date" class="block text-gray-700 font-medium mb-2">Start Date</label>
                                <input type="date" name="start_date" id="start_date"
                                    class="w-full border border-gray-300 rounded-xl p-3 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400 shadow-sm"
                                    required>
                            </div>
                            <div>
                                <label for="end_date" class="block text-gray-700 font-medium mb-2">End Date</label>
                                <input type="date" name="end_date" id="end_date"
                                    class="w-full border border-gray-300 rounded-xl p-3 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400 shadow-sm"
                                    required>
                            </div>
                        </div>

                        {{-- Weekly Activities --}}
                        <div>
                            <label for="activities" class="block text-gray-700 font-medium mb-2">Weekly Summary /
                                Activities</label>
                            <textarea name="activities" id="activities" rows="6"
                                class="w-full border border-gray-300 rounded-xl p-3 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400 shadow-sm"
                                placeholder="Describe what you did this week..." required></textarea>
                        </div>

                        {{-- Optional Work Image --}}
                        <div x-data="{ fileName: '', fileUrl: '' }">
                            <label for="work_image" class="block text-gray-700 font-medium mb-2">Optional Work Image</label>
                            <input type="file" name="work_image" id="work_image" @change="previewFile($event)"
                                class="w-full border border-gray-300 rounded-xl p-3 bg-gray-50 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-sm"
                                accept="image/*">
                            <p class="text-gray-500 text-sm mt-1">Optional: Upload a screenshot or photo of your work. JPG,
                                PNG max 2MB.
                            </p>

                            <!-- File preview -->
                            <template x-if="fileUrl">
                                <div class="mt-4">
                                    <img :src="fileUrl" alt="Work Image Preview"
                                        class="w-48 h-48 object-contain border rounded-lg">
                                    <p class="text-gray-700 mt-2 font-medium" x-text="fileName"></p>
                                </div>
                            </template>
                        </div>


                        {{-- Upload Company Stamp --}}
                        <div x-data="{ fileName: '', fileUrl: '' }">
                            <label for="company_stamp" class="block text-gray-700 font-medium mb-2">Upload Company
                                Stamp</label>
                            <input type="file" name="company_stamp" id="company_stamp" @change="previewFile($event)"
                                class="w-full border border-gray-300 rounded-xl p-3 bg-gray-50 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-sm"
                                accept="image/*" required>
                            <p class="text-gray-500 text-sm mt-1">Accepted formats: JPG, PNG • Max size: 2MB</p>

                            <!-- File preview -->
                            <template x-if="fileUrl">
                                <div class="mt-4">
                                    <img :src="fileUrl" alt="Company Stamp Preview"
                                        class="w-48 h-48 object-contain border rounded-lg">
                                    <p class="text-gray-700 mt-2 font-medium" x-text="fileName"></p>
                                </div>
                            </template>
                        </div>

                        {{-- Submit Button --}}
                        <div class="flex justify-end">
                            <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-6 py-3 rounded-xl shadow-md transition-all duration-200">
                                Submit Logbook
                            </button>
                        </div>
                    </form>
                </div>

            </div>

        </div>


    </div>
@endsection
