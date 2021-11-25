<?php

use Uspdev\Replicado\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LocaluspController;
use App\Http\Controllers\PatrimonioController;

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
Route::resource('/user', UserController::class);
Route::resource('/localusp', LocaluspController::class);

// Route::get('/', function(Request $request){
//     if($request->numpat){
//         $numpat = $request->numpat;
//         return \App\Http\Livewire\BuscarPatrimonio::class;
//     }
// });

Route::get('/numpat/{numpat?}', \App\Http\Livewire\BuscarPatrimonio::class)->name('buscarPorNumpat');
Route::get('/buscarPorLocal/{codlocusp?}', [PatrimonioController::class, 'localusp'])->name('buscarPorLocal');
Route::get('/relatorio', [PatrimonioController::class, 'relatorio']);
// Route::get('/localusp/{codlocusp?}', [PatrimonioController::class, 'localusp']);

Route::get('/listarPorSala', [PatrimonioController::class, 'listarPorSala']);
// Route::get('/listarPorSala/{codlocusp?}', [PatrimonioController::class, 'listarPorSala']);
Route::get('/listarPorNumero', [PatrimonioController::class, 'listarPorNumero']);
