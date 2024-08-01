<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('ad');
            $table->string('soyad');
            $table->string('ev_no');
            $table->string('posta_kodu');
            $table->string('sehir');
            $table->string('mail');
            $table->string('tel_no');
            $table->string('unique_link')->nullable(); // Ensure 'unique_link' is nullable
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
