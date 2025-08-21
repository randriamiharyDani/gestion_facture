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



        Schema::create('factures', function (Blueprint $table) {
            $table->id();
            $table->string('numero_facture')->unique();
            $table->unsignedBigInteger('client_id');
            $table->date('date_emission');
            $table->date('date_echeance');
            $table->enum('statut', ['payée', 'en attente', 'en retard'])->default('en attente');
            $table->decimal('total_ht', 10, 2)->default(0);
            $table->decimal('total_tva', 10, 2)->default(0);
            $table->decimal('total_ttc', 10, 2)->default(0);

            $table->text('notes')->nullable();
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('factures');
    }
};
