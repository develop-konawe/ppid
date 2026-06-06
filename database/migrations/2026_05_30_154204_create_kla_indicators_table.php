<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('kla_indicators', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('kla_indicator_categories')->cascadeOnDelete();
            $table->foreignId('cluster_id')->nullable()->constrained('kla_clusters')->nullOnDelete();
            $table->string('name');
            $table->string('target_value')->nullable();
            $table->string('unit')->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('kla_indicators'); }
};
