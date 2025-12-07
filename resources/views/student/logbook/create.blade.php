@extends('layouts.app')

@section('content')
<br>
    <div x-data="logbookForm()" class="max-w-3xl mx-auto bg-white shadow-lg rounded-2xl p-8 mb-12">
        <h2 class="text-3xl font-bold mb-8 text-center text-gray-800">Submit Weekly Logbook</h2>

        <form action="{{ route('student.logbook.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
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
                <label for="activities" class="block text-gray-700 font-medium mb-2">Weekly Summary / Activities</label>
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
                <p class="text-gray-500 text-sm mt-1">Optional: Upload a screenshot or photo of your work. JPG, PNG max 2MB.
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
                <label for="company_stamp" class="block text-gray-700 font-medium mb-2">Upload Company Stamp</label>
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

    <script src="//unpkg.com/alpinejs" defer></script>
    <script>
        function logbookForm() {
            return {
                previewFile(event) {
                    const file = event.target.files[0];
                    if (!file) return;

                    this.fileName = file.name;
                    this.fileUrl = URL.createObjectURL(file);
                }
            }
        }
    </script>
@endsection
