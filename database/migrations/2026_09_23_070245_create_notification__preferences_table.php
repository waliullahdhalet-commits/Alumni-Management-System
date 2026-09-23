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
        Schema::create('notification__preferences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained('users')->cascadeOnDelete();
            $table->boolean('job_notifications')->default(true);            
            $table->boolean('event_notifications')->default(true);            
            $table->boolean('workshop_notifications')->default(true);            
            $table->boolean('announcement_notifications')->default(true);            
            $table->boolean('community_notifications')->default(true);
            $table->boolean('card_notifications')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notification__preferences');
    }
};
