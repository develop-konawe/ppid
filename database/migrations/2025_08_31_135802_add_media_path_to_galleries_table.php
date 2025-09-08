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
        Schema::table('galleries', function (Blueprint $table) {
            // tambah kolom media_path dan ubah kolom media_url menjadi nullable
            $table->string('media_path')->nullable()->after('caption');
            $table->string('media_url')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('galleries', function (Blueprint $table) {
            $table->dropColumn('media_path');
            $table->string('media_url')->nullable(false)->change();
        });
    }
};
