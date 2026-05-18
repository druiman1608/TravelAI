<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('hotels', function (Blueprint $table) {
            if (!Schema::hasColumn('hotels', 'extras')) {
                $table->json('extras')->nullable()->after('price_per_night');
            }
        });

        Schema::table('flights', function (Blueprint $table) {
            if (!Schema::hasColumn('flights', 'extras')) {
                $table->json('extras')->nullable()->after('price');
            }
        });

        Schema::table('activities', function (Blueprint $table) {
            if (!Schema::hasColumn('activities', 'extras')) {
                $table->json('extras')->nullable()->after('price');
            }
        });
    }

    public function down(): void
    {
        Schema::table('hotels', function (Blueprint $table) {
            $table->dropColumn('extras');
        });
        Schema::table('flights', function (Blueprint $table) {
            $table->dropColumn('extras');
        });
        Schema::table('activities', function (Blueprint $table) {
            $table->dropColumn('extras');
        });
    }
};