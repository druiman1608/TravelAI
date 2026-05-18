<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->string('contact_name')->after('user_id')->nullable();
            $table->string('contact_dni')->after('contact_name')->nullable();
            $table->json('passengers_data')->after('extras')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropColumn(['contact_name', 'contact_dni', 'passengers_data']);
        });
    }
};