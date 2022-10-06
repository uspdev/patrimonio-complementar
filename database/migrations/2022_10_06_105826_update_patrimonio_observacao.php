<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePatrimonioObservacao extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('patrimonios', function (Blueprint $table) {
            // cria coluna obs
            $table->text('obs')->after('replicado')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('patrimonios', function (Blueprint $table) {
            $table->dropColumn('obs');
        });
    }
}
