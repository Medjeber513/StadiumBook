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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('startGame',15);
            $table->string('endtGame',15);
            $table->string('date',15);
            $table->foreignId('stadium_id')->constrained('stadiums');
            $table->foreignId('player_id')->constrained('users');
            $table->enum('status',['confirmed','cancelled','pending'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_booking');
    }
};
