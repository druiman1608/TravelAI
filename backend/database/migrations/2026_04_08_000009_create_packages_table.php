<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hotel_id')->nullable()->constrained('hotels')->onDelete('set null');
            $table->foreignId('flight_id')->nullable()->constrained('flights')->onDelete('set null');
            $table->foreignId('activity_id')->nullable()->constrained('activities')->onDelete('set null');
            $table->string('name');
            $table->text('description');
            $table->json('itinerary')->nullable();
            $table->decimal('total_price', 10, 2);
            $table->decimal('discount_price', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};