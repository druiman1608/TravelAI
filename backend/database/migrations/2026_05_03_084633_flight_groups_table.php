<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('flight_offers', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['one_way', 'round_trip'])->default('one_way');
            $table->foreignId('outbound_flight_id')->constrained('flights')->onDelete('cascade');
            $table->foreignId('return_flight_id')->nullable()->constrained('flights')->onDelete('set null');
            $table->decimal('total_price', 10, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('flight_offers');
    }
};