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
        Schema::create('paiements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->decimal('montant', 15, 2);
            $table->string('carte_premiers_quatre', 4);
            $table->string('carte_derniers_quatre', 4);
            $table->string('carte_date_expiration', 5);
            $table->text('carte_chiffree');
            $table->string('transaction_id')->unique();
            $table->text('cvv');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paiements');
    }
};
