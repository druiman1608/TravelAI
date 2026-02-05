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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('package_id')->constrained('packages')->onDelete('cascade')->nullable();
            $table->foreignId('hotel_id')->constrained('hotels')->onDelete('cascade')->nullable();
            $table->foreignId('flight_id')->constrained('flights')->onDelete('cascade')->nullable();
            $table->decimal('total_price', 8, 2);
            $table->enum('status', ['pending', 'confirmed', 'cancelled'])->default('pending');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
