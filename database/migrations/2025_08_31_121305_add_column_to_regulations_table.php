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
        Schema::table('regulations', function (Blueprint $table) {
            $table->string('title')->after('id');
            $table->text('summary')->nullable()->after('title');
            $table->string('doc_url')->nullable()->after('summary');
            $table->date('issue_date')->nullable()->after('doc_url');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('regulation', function (Blueprint $table) {
            $table->dropColumn(['title', 'summary', 'doc_url', 'issue_date']);
        });
    }
};
