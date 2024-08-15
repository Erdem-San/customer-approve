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
            $table->string('voornaam', 191)->nullable();
            $table->string('tussenvoegsel', 191)->nullable();
            $table->string('achternaam', 191)->nullable();
            $table->string('straatnaam', 191)->nullable();
            $table->string('geboortedatum')->nullable();
            $table->string('email')->nullable();
            $table->string('huisnummer', 191)->nullable();
            $table->string('toevoeging', 191)->nullable();
            $table->string('postcode', 191)->nullable();
            $table->string('woonplaats', 191)->nullable();
            $table->string('telefoonnummer', 191)->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->string('user_agent', 255)->nullable();
            $table->text('session_data')->nullable(); // JSON yerine TEXT
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
