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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('created_by')->constrained('users')->restrictOnDelete();
            $table->string('title', 200);
            $table->longText('description')->nullable();
            $table->enum('event_type', ['meetup', 'seminar', 'webinar', 'job_fair', 'reunion', 'other']);
            $table->enum('event_mode', ['physical', 'online', 'hybrid']);
            $table->string('venue');
            $table->string('meeting_url')->nullable();
            $table->time('start_time');
            $table->time('end_time')->nullable();
            $table->date('registeration_deadline');
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
