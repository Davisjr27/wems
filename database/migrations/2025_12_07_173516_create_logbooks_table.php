<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('logbooks', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('user_id'); // student ID
        $table->string('week');
        $table->date('start_date');
        $table->date('end_date');
        $table->text('activities');
        $table->string('company_signature')->nullable();
        $table->string('company_stamp')->nullable();
        $table->timestamps();

        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logbooks');
    }
};
