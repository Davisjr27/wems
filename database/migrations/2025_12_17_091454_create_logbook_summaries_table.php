<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
     Schema::create('logbook_summaries', function (Blueprint $table) {
            $table->id();

            // Student
            $table->foreignId('student_id')
                  ->constrained('users')
                  ->cascadeOnDelete();

            // Officer who reviewed
            $table->foreignId('officer_id')
                  ->nullable()
                  ->constrained('users')
                  ->nullOnDelete();

            // Summary content
            $table->longText('summary');

            // Approval state
            $table->enum('status', ['pending', 'approved', 'rejected'])
                  ->default('pending');

            $table->text('rejection_reason')->nullable();
            $table->timestamp('reviewed_at')->nullable();

            $table->timestamps();

            // Ensure ONE summary per student
            $table->unique('student_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('logbook_summaries');
    }
};
