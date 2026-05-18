<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('flights', function (Blueprint $table) {
            $table->id();
            $table->string('flight_number');
            $table->foreignId('origin_loc_id')->constrained('locations');
            $table->foreignId('destination_loc_id')->constrained('locations');
            $table->string('airline');
            $table->dateTime('departure')->index();
            $table->dateTime('arrival');
            $table->integer('capacity');
            $table->decimal('price', 10, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('flights');
    }
};