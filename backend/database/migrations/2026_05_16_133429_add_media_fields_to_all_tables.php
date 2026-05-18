<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('hotels', 'images')) {
            Schema::table('hotels', function (Blueprint $table) {
                $table->json('images')->nullable()->after('price_per_night');
            });
        }

        if (!Schema::hasColumn('activities', 'images')) {
            Schema::table('activities', function (Blueprint $table) {
                $table->json('images')->nullable()->after('type');
            });
        }

        if (!Schema::hasColumn('packages', 'images')) {
            Schema::table('packages', function (Blueprint $table) {
                $table->json('images')->nullable()->after('discount_price');
            });
        }

        if (!Schema::hasColumn('flights', 'image_url')) {
            Schema::table('flights', function (Blueprint $table) {
                $table->string('image_url')->nullable()->after('stops');
            });
        }

        if (!Schema::hasColumn('users', 'profile_photo_path')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('profile_photo_path', 2048)->nullable()->after('phone_number');
            });
        }
    }

    public function down(): void
    {
        Schema::table('hotels', function (Blueprint $table) {
            $table->dropColumn('images');
        });
        Schema::table('activities', function (Blueprint $table) {
            $table->dropColumn('images');
        });
        Schema::table('packages', function (Blueprint $table) {
            $table->dropColumn('images');
        });
        Schema::table('flights', function (Blueprint $table) {
            $table->dropColumn('image_url');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('profile_photo_path');
        });
    }
};