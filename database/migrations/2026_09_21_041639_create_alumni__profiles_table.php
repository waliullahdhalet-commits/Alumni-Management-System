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
        Schema::create('alumni__profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained('users');
            $table->string('student_id', 50)->unique();
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->string('phone', 30);
            $table->enum('gender', ['male', 'female', 'other']);
            $table->date('date_of_birth');
            $table->string('profile_picture')->nullable();
            $table->text('address')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('about')->nullable();
            $table->year('admission_year')->nullable();
            $table->year('graduation_year')->nullable();
            $table->decimal('cgpa', 3, 2)->nullable();
            $table->enum('current_status', ['employed', 'self_employed', 'entrepreneur', 'higher_studies', 'looking_for_job', 'freelancer', 'other'])->nullable();
            $table->string('current_company', 150)->nullable();
            $table->string('current_designation', 150)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumni__profiles');
    }
};
