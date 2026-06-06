<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('kla_indicator_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('indicator_id')->constrained('kla_indicators')->cascadeOnDelete();
            $table->year('year');
            $table->string('value');
            $table->text('notes')->nullable();
            $table->string('status')->default('draft');
            $table->foreignId('verified_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('kla_indicator_progress'); }
};
