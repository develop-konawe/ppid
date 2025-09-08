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
        Schema::table('announcements', function (Blueprint $table) {

            $table->boolean('is_active')->default(true)->after('file_path');
            $table->boolean('is_featured')->default(false)->after('is_active');
            $table->unsignedBigInteger('views')->default(0)->after('is_featured');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('announcements', function (Blueprint $table) {
            $table->dropColumn('is_featured');
            $table->dropColumn('views');
        });
    }
};
