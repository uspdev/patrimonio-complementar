<?php

use App\Http\Controllers\CentrodespesaController;
use App\Http\Controllers\LocaluspController;
use App\Http\Controllers\PatrimonioController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/localusp/admin', [LocaluspController::class, 'admin'])->name('localusp.admin');
Route::resource('/localusp', LocaluspController::class);

Route::resource('/user', UserController::class);

Route::get('/numpat/{numpat?}', \App\Http\Livewire\BuscarPatrimonio::class)->name('buscarPorNumpat');

Route::get('/buscarPorLocal/{codlocusp?}', [PatrimonioController::class, 'buscarPorLocal'])->name('buscarPorLocal');
Route::get('/buscarPorResponsavel/{codpes?}', [PatrimonioController::class, 'buscarPorResponsavel'])->name('buscarPorResponsavel');
Route::get('/relatorio/{tipo?}', [PatrimonioController::class, 'relatorio'])->name('relatorio');

Route::get('/listarPorSala', [PatrimonioController::class, 'listarPorSala']);
// Route::get('/listarPorSala/{codlocusp?}', [PatrimonioController::class, 'listarPorSala']);
Route::get('/listarPorNumero', [PatrimonioController::class, 'listarPorNumero']);

Route::resource('/', PatrimonioController::class);

Route::resource('/cendsp', CentrodespesaController::class);
