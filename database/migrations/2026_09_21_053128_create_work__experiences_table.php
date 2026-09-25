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
        Schema::create('work__experiences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('alumni_profile_id')->constrained('alumni_profiles')->cascadeOnDelete();
            $table->string('company_name', 100);
            $table->string('designation', 100);
            $table->text('job_description')->nullable();
            $table->enum('employment_type', ['full_time', 'part_time', 'internship', 'contract', 'remote']);
            $table->string('location', 100)->nullable();
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->boolean('currently_working')->default(false);
            $table->timestamps();
            $table->index(['alumni_profile_id', 'currently_working']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('work__experiences');
    }
};
