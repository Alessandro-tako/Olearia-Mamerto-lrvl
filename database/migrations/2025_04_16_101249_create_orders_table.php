<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->decimal('total_amount', 8, 2);  // Importo totale dell'ordine
            // Impostiamo 'paid' come valore predefinito, e aggiungiamo 'confirmed' e 'shipped'
            $table->enum('status', ['Pagato e in attesa', 'Confermato', 'Spedito', 'cancellato'])->default('Pagato e in attesa');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
