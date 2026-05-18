<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('package_id')->nullable()->constrained('packages')->onDelete('set null');
            $table->foreignId('hotel_id')->nullable()->constrained('hotels')->onDelete('set null');
            $table->foreignId('hotel_room_id')->nullable()->constrained('hotel_rooms')->onDelete('set null');
            $table->foreignId('flight_id')->nullable()->constrained('flights')->onDelete('set null');
            $table->foreignId('activity_id')->nullable()->constrained('activities')->onDelete('set null');
            $table->decimal('total_price', 10, 2);
            $table->string('contact_email');
            $table->string('contact_phone');
            $table->json('extras')->nullable();
            $table->enum('status', ['pending', 'confirmed', 'cancelled'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};