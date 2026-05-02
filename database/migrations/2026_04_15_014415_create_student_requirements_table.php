<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('student_requirements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->index();
            $table->foreignId('requirement_id')->index();
            $table->enum('status', ['submitted', 'incomplete', 'complete', 'approved', 'rejected'])->default('incomplete');
            $table->text('admin_comment')->nullable();
            $table->string('file_path')->nullable();
            $table->boolean('is_onsite');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_requirements');
    }
};
