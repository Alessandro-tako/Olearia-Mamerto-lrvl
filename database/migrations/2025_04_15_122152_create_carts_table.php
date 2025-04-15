<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    /**
     * Esegui le migrazioni.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('article_id')->constrained()->onDelete('cascade');
            $table->integer('quantity')->default(1);  // La quantità dell'articolo nel carrello
            $table->timestamps();
        });
    }    

    /**
     * Reverti le migrazioni.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carts');
    }
}
