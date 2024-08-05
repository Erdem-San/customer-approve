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
        Schema::create('approved_customers', function (Blueprint $table) {
            $table->id();
            $table->string('ad');
            $table->string('soyad');
            $table->string('ev_no');
            $table->string('posta_kodu');
            $table->string('sehir');
            $table->string('mail');
            $table->string('tel_no');
            $table->string('ip_address')->nullable();
            $table->string('user_agent')->nullable();
            $table->json('session_data')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('approved_customers');
    }
};