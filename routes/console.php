<?php

use App\Models\Patrimonio;
use App\Models\User;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
 */

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('importarUsuarios {arquivo}', function ($arquivo) {

    if (!is_file($arquivo)) {
        echo 'arquuivo inválido';
        die(PHP_EOL);
    }

    if (!User::find(1)) {
        echo 'sem usuário criado. Faça login 1x';
        die(PHP_EOL);
    }

    require $arquivo;

    Patrimonio::upsert($patrimonios, ['numpat'], ['usuario']);

})->purpose('Importar usuários na tabela de patrimonios');

Artisan::command('importarLocais {arquivo}', function ($arquivo) {

    if (!is_file($arquivo)) {
        echo 'arquivo inválido';
        die(PHP_EOL);
    }

    require $arquivo;

    \DB::table('localusps')->upsert($locais, ['codlocusp'], ['setor', 'andar', 'nome']);

})->purpose('Importar locais');
