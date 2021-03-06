<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocaluspsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('localusps', function (Blueprint $table) {
            $table->id();
            $table->integer('codlocusp')->unique();
            $table->string('setor');
            $table->string('andar')->nullable();
            $table->string('nome')->nullable();
            $table->json('replicado')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('localusps');
    }
}
