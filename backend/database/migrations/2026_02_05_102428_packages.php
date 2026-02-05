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
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hotel_id')->constrained('hotels')->onDelete('cascade');
            $table->foreignId('flight_id')->constrained('flights')->onDelete('cascade');
            $table->foreignId('activity_id')->constrained('activities')->onDelete('cascade');
            $table->decimal('total_price', 8, 2);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
