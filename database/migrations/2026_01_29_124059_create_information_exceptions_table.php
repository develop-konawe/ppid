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
        Schema::create('information_exceptions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('public_information_id')
                ->constrained('public_informations')
                ->onDelete('cascade');

            $table->text('exception_reason');
            $table->string('legal_basis');     // Pasal UU / Perki
            $table->date('valid_until')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('information_exceptions');
    }
};
