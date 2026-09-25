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
        Schema::create('academic_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('alumni_profile_id')->constrained('alumni_profiles')->cascadeOnDelete();
            $table->string('degree', 150);
            $table->string('department', 100)->nullable();
            $table->string('institution', 200);
            $table->date('start_year')->nullable();
            $table->date('end_year')->nullable();
            $table->string('grade')->nullable();
            $table->decimal('cgpa', 3, 2)->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
            $table->index('alumni_profile_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('academic_records');
    }
};
