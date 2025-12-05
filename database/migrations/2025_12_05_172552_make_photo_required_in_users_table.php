<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Set a default photo path for existing users with null photo
        DB::table('users')->whereNull('photo')->update(['photo' => 'default-avatar.png']);

        Schema::table('users', function (Blueprint $table) {
            $table->string('photo')->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('photo')->nullable()->change();
        });
    }
};
