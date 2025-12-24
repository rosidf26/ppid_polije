<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BackpackGoogleController;
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

Route::post('/kirim-permohonan-informasi', 'BlangkoController@storePermohonan')->name('permohonan.store');
Route::get('/permohonan-informasi/sukses/{unik_request}', 'BlangkoController@successPermohonan')->name('permohonan.success');
Route::get('/permohonan-informasi/download/{unik_request}', 'BlangkoController@downloadPermohonan')->name('permohonan.download');
// Cek status permohonan
Route::get('/cek-status-permohonan', 'BlangkoController@checkPermohonan')
    ->name('permohonan.check');

Route::post('/hasil-cek-status-permohonan', 'BlangkoController@resultCheckPermohonan')
    ->name('permohonan.result');

Route::get('/rekapitulasi-permohonan-informasi', 'BlangkoController@recapPermohonan')->name('recap.grafik_permohonan');

Route::get('/rekapitulasi-permohonan-informasi/data/{year}', 'BlangkoController@getTahunPermohonan')->name('recap.tahun_permohonan');

// Route::middleware('web')->group(function () {

Route::get('/cari-permohonan', 'BlangkoController@searchPermohonan')
    ->name('permohonan.search');

Route::post('/hasil-cari-permohonan', 'BlangkoController@resultSearchPermohonan')
    ->name('permohonan.result_search');

Route::post('/kirim-pernyataan-keberatan', 'BlangkoController@storeKeberatan')->name('keberatan.store');

Route::get('/pernyataan-keberatan/sukses/{unik_request}', 'BlangkoController@successKeberatan')->name('keberatan.success');

Route::get('/pernyataan-keberatan/download/{unik_request}', 'BlangkoController@downloadKeberatan')->name('keberatan.download');

Route::get('/cek-status-keberatan', 'BlangkoController@checkKeberatan')
    ->name('keberatan.check');

Route::post('/hasil-cek-status-keberatan', 'BlangkoController@resultCheckKeberatan')
    ->name('keberatan.result');

Route::get('/rekapitulasi-pernyataan-keberatan', 'BlangkoController@recapKeberatan')->name('rekap.grafik_keberatan');

Route::get('/rekapitulasi-pernyataan-keberatan/data/{year}', 'BlangkoController@getTahunKeberatan')->name('rekap.tahun_keberatan');
// });
Route::get('/', 'PageController@index')
    ->name('beranda');

Route::post('/contact-response', 'PageController@contact_response')
    ->name('contact_us_response');

Route::get('/faq', 'PageController@faq')
    ->name('faq');

Route::get('/komentar', 'PageController@comment')
    ->name('comment');

Route::get('/cari-berita', 'PageController@search_news')
    ->name('search.news');

Route::get('/cari-pengumuman', 'PageController@search_announce')
    ->name('search.announce');

Route::get('/clear-cache', 'PageController@clear_cache')
    ->name('clear_cache');

Route::get('/kategori/{category?}', 'PageController@category')
    ->where(['category' => '[a-zA-Z0-9\-]+'])
    ->name('category_publikasi');

Route::get('/{page_slug}', 'PageController@page')
    ->where(['page_slug' => '[a-zA-Z0-9\-]+'])
    ->name('news-page_slug');

Route::get('/{category}/{article_slug}', 'PageController@news_detail')
    ->where(['category' => '[a-zA-Z0-9\-]+', 'article_slug' => '[a-zA-Z0-9\-]+'])
    ->name('news-detail');

Route::any('core/elfinder/connector', 'ElfinderController@showConnector')
    ->name('core.elfinder.connector');

Route::post('/kirim-komentar', 'KomentarController@store')->name('comment.submit');

Route::get('/berita/tag/{slug}', 'PageController@tag_news')->name('tag.filter_news');

Route::get('/pengumuman/tag/{slug}', 'PageController@tag_announce')->name('tag.filter_announce');

// Route::get('/e-blangko/{slug}', 'PageController@informasiPublik')->name('form.blangko');

Route::group([
    'prefix' => 'admin',
    'middleware' => ['web'],
], function () {
    Route::get('login/google', [BackpackGoogleController::class, 'redirectToGoogle'])
        ->name('backpack.auth.google.redirect');

    Route::get('login/google/callback', [BackpackGoogleController::class, 'handleGoogleCallback'])
        ->name('backpack.auth.google.callback');
});


// Proses verifikasi permohonan

