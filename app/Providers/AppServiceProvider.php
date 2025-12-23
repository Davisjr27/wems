<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public static function redirectTo()
    {
        // $user = auth()->user();
        $user = Auth::user();

        return match ($user->role) {
            'student' => route('student.dashboard'),
            'officer' => route('officer.dashboard'),
            'admin' => route('admin.dashboard'),
            default => '/',
        };
    }

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
