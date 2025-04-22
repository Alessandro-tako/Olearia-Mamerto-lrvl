<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveForeignKeyFromSessionsTable extends Migration
{
    public function up()
    {
        Schema::table('sessions', function (Blueprint $table) {
            // Rimuovi la foreign key che fa riferimento alla tabella users
            $table->dropForeign(['user_id']);
        });
    }

    public function down()
    {
        Schema::table('sessions', function (Blueprint $table) {
            // Ricrea la foreign key se necessario
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
}
