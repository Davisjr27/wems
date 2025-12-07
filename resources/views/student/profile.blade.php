@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-6 py-8">
    <h1 class="text-2xl font-bold mb-6">My Profile</h1>

    <div class="bg-white shadow rounded-lg p-6 space-y-4">

        <div>
            <label class="font-medium">Full Name</label>
            <div>{{ Auth::user()->name }}</div>
        </div>

        <div>
            <label class="font-medium">Email</label>
            <div>{{ Auth::user()->email }}</div>
        </div>

        <div>
            <label class="font-medium">Passport Photo</label>
            @if(Auth::user()->passport)
                <img src="{{ asset('storage/passports/' . Auth::user()->passport) }}" class="w-36 h-36 rounded-lg border mt-2">
            @else
                <div class="w-36 h-36 bg-gray-100 flex items-center justify-center rounded-lg border mt-2">
                    <span class="text-gray-400">No Photo</span>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
