<?php

use App\Http\Controllers\PatrimonioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Uspdev\Replicado\DB;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::resource('/', PatrimonioController::class);

// Route::get('/', function(Request $request){
//     if($request->numpat){
//         $numpat = $request->numpat;
//         return \App\Http\Livewire\BuscarPatrimonio::class;
//     }
// });

Route::get('/numpat/{numpat?}', \App\Http\Livewire\BuscarPatrimonio::class);
Route::get('/localusp/{codlocusp?}', [PatrimonioController::class, 'localusp']);
// Route::get('/localusp/{codlocusp?}', [PatrimonioController::class, 'localusp']);

Route::get('/listarPorSala', [PatrimonioController::class, 'listarPorSala']);
// Route::get('/listarPorSala/{codlocusp?}', [PatrimonioController::class, 'listarPorSala']);
Route::get('/listarPorNumero', [PatrimonioController::class, 'listarPorNumero']);
