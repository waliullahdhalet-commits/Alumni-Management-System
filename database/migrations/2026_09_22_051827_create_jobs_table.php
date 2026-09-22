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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('posted_by')->constrained('users')->restrictOnDelete();
            $table->string('title', 200);
            $table->string('company_name', 200);
            $table->longText('description');
            $table->longText('requirements');
            $table->string('location', 100);
            $table->enum('employment_type', ['full_time', 'part_time', 'contract', 'internship', 'remote']);
            $table->string('salary')->nullable();
            $table->date('deadline')->nullable();
            $table->string('application_email')->nullable();
            $table->string('posted_by')->nullable();
            $table->timestamps();
            $table->index('deadline');
            $table->index('company_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
