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
        Schema::create('customers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('voornaam', 191)->nullable();
            $table->string('tussenvoegsel', 191)->nullable();
            $table->string('achternaam', 191)->nullable();
            $table->string('straatnaam', 191)->nullable();
            $table->string('geboortedatum', 191)->nullable();
            $table->string('email', 191)->nullable();
            $table->string('huisnummer', 191)->nullable();
            $table->string('toevoeging', 191)->nullable();
            $table->string('postcode', 191)->nullable();
            $table->string('woonplaats', 191)->nullable();
            $table->string('telefoonnummer', 191)->nullable();
            $table->string('unique_link', 191)->nullable();
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
