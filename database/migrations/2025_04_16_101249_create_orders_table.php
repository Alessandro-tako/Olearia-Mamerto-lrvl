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

            // Collegamento opzionale all'utente
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null'); // Modifica onDelete()

            // Snapshot dati utente
            $table->string('user_name')->nullable();
            $table->string('user_email')->nullable();

            $table->decimal('total_amount', 8, 2);

            $table->enum('status', ['Pagato e in attesa', 'Confermato', 'Spedito', 'Annullato'])->default('Pagato e in attesa');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
