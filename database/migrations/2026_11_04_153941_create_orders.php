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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('ref')->unique();
            $table->dateTime('date_depot');
            $table->dateTime('livraison_prev');
            $table->dateTime('date_recup');
            $table->decimal('montant_total',10,2);
            $table->enum('statut',['reçue','en traitement','prête','récupérée']);
            $table->timestamps();
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
