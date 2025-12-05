<!-- resources/views/student/dashboard.blade.php -->
<x-app-layout>
    <div class="py-8 px-6">
        <h1 class="text-3xl font-bold mb-6">Student Dashboard</h1>

        <!-- Student Info Card -->
        <div class="bg-white shadow rounded-xl p-6 mb-6">
            <h2 class="text-xl font-semibold mb-4">Your Profile</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <p class="text-sm text-gray-600">Name:</p>
                    <p class="font-medium">{{ auth()->user()->name }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Email:</p>
                    <p class="font-medium">{{ auth()->user()->email }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Student Number:</p>
                    <p class="font-medium">{{ auth()->user()->student_number ?? 'Not set' }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Department:</p>
                    <p class="font-medium">{{ auth()->user()->department ?? 'Not set' }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Phone:</p>
                    <p class="font-medium">{{ auth()->user()->phone ?? 'Not set' }}</p>
                </div>
            </div>
        </div>


    </div>
</x-app-layout>
