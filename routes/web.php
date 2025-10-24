<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontpageController;

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
// Route::get('/', function () {
//     return view('welcome');
// });

// Route untuk menampilkan data siswa
Route::get('/', [FrontpageController::class, 'index']);
Route::get('/sambutan-direktur', [FrontpageController::class, 'sambutan']);
Route::get('/profil-polije', [FrontpageController::class, 'profil']);
Route::get('/profil-ppid-polije', [FrontpageController::class, 'profil_ppid']);
Route::get('/tugas-dan-fungsi-ppid-polije', [FrontpageController::class, 'tupoksi']);
Route::get('/regulasi', [FrontpageController::class, 'regulasi']);
Route::get('/daftar-informasi-publik', [FrontpageController::class, 'info_publik']);
Route::get('/informasi-yang-dikecualikan', [FrontpageController::class, 'info_kecuali']);
Route::get('/informasi-setiap-saat', [FrontpageController::class, 'info_setiapsaat']);
Route::get('/informasi-berkala', [FrontpageController::class, 'info_berkala']);
Route::get('/informasi-serta-merta', [FrontpageController::class, 'info_sertamerta']);
Route::get('/rekapitulasi-permohonan-informasi-publik', [FrontpageController::class, 'rekapitulasi']);
Route::get('/maklumat-pelayanan', [FrontpageController::class, 'maklumat']);
Route::get('/standar-pelayanan', [FrontpageController::class, 'standar_pelayanan']);
Route::get('/biaya-layanan', [FrontpageController::class, 'biaya_pelayanan']);
Route::get('/prosedur-permohonan', [FrontpageController::class, 'prosedur_permohonan']);
Route::get('/prosedur-pengajuan-keberatan', [FrontpageController::class, 'prosedur_keberatan']);
Route::get('/prosedur-penyelesaian-sengketa', [FrontpageController::class, 'prosedur_sengketa']);
Route::get('/berita', [FrontpageController::class, 'berita']);
Route::get('/pengumuman', [FrontpageController::class, 'pengumuman']);
Route::get('/faq', [FrontpageController::class, 'faq']);
Route::get('/detail-berita', [FrontpageController::class, 'detail_berita']);
Route::get('/detail-pengumuman', [FrontpageController::class, 'detail_pengumuman']);
Route::get('/komentar', [FrontpageController::class, 'komentar']);