<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('logbook_submissions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id')->index();
            $table->string('title')->nullable(); // optional: "Final Logbook - SIWES 2025"
            $table->string('pdf_path')->nullable(); // storage path e.g. "logbook_submissions/..."
            $table->enum('status', ['pending','approved','rejected'])->default('pending');
            $table->unsignedBigInteger('officer_id')->nullable();
            $table->text('review_comment')->nullable();
            $table->timestamp('submitted_at')->nullable();
            $table->timestamp('reviewed_at')->nullable();
            $table->timestamps();

            $table->foreign('student_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('officer_id')->references('id')->on('users')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('logbook_submissions');
    }
};
