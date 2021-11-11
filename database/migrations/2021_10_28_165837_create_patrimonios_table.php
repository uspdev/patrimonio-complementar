<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatrimoniosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patrimonios', function (Blueprint $table) {
            $table->id();
            $table->integer('numpat');
            $table->string('usuario')->nullable();
            $table->string('local')->nullable();

            $table->datetime('conferido_em')->nullable();
            $table->foreignId('user_id')->constrained('users');

            $table->string('setor')->nullable();
            $table->string('codlocusp')->nullable();
            $table->string('codpes')->nullable();
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
        Schema::dropIfExists('patrimonios');
    }
}
