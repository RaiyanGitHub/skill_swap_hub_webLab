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
        Schema::create('swap_requests', function (Blueprint $table) {
    $table->id();
    $table->foreignId('sender_id')->constrained('users')->cascadeOnDelete();
    $table->foreignId('receiver_id')->constrained('users')->cascadeOnDelete();

    // who learns what and who teaches what
    $table->string('skill_offered');   // sender knows
    $table->string('skill_requested'); // sender wants

    $table->enum('status', ['pending','accepted','completed','rejected'])->default('pending');

    $table->timestamps();
        $table->unique([
            'sender_id',
            'receiver_id',
            'skill_offered',
            'skill_requested'
        ]);

    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('swap_requests');
    }
};
