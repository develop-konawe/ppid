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
        Schema::table('opds', function (Blueprint $table) {
            $table->string('id_unit', 50)->nullable()->unique()->after('id');
            $table->string('tipe_unit', 10)->nullable()->after('singkatan');
            $table->text('keterangan')->nullable()->after('tipe_unit');
            $table->decimal('latitude', 10, 7)->nullable()->after('alamat');
            $table->decimal('longitude', 10, 7)->nullable()->after('latitude');
            $table->string('file_dasar_hukum')->nullable()->after('keterangan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('opds', function (Blueprint $table) {
            $table->dropColumn([
                'id_unit',
                'tipe_unit',
                'keterangan',
                'latitude',
                'longitude',
                'file_dasar_hukum',
            ]);
        });
    }
};

