<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::table('kla_complaints', function (Blueprint $table) {
            $table->string('status')->default('pending')->change();
            $table->string('attachment')->nullable()->after('message');
            $table->text('internal_notes')->nullable()->after('attachment');
        });
    }
    public function down(): void { 
        Schema::table('kla_complaints', function (Blueprint $table) {
            $table->dropColumn(['attachment', 'internal_notes']);
        });
    }
};
