<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PemasukanController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\ImportController;

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

Route::get('/', [HomeController::class, 'index']);

Route::get('/pemasukan', [PemasukanController::class, 'index']);
Route::post('/pemasukan/add', [PemasukanController::class, 'add']);
Route::post('/pemasukan/edit/{id}', [PemasukanController::class, 'edit']);
Route::post('/pemasukan/delete/{id}', [PemasukanController::class, 'delete']);

Route::get('/pengeluaran', [PengeluaranController::class, 'index']);
Route::post('/pengeluaran/add', [PengeluaranController::class, 'add']);
Route::post('/pengeluaran/edit/{id}', [PengeluaranController::class, 'edit']);
Route::post('/pengeluaran/delete/{id}', [PengeluaranController::class, 'delete']);

Route::get('/laporan', [LaporanController::class, 'index']);

Route::get('/export/excel/pemasukan', [ExportController::class, 'export_excel_pemasukan']);
Route::get('/export/excel/pengeluaran', [ExportController::class, 'export_excel_pengeluaran']);
Route::get('/export/excel/laporan', [ExportController::class, 'export_excel_laporan']);

Route::post('/import/excel/pemasukan', [ImportController::class, 'export_excel_pemasukan']);
Route::post('/import/excel/pengeluaran', [ImportController::class, 'export_excel_pengeluaran']);