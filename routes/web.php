<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KomentarController;

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


    Route::get('/', 'PageController@index')
        ->name('beranda');

    Route::post('/contact-response', 'PageController@contact_response')
        ->name('contact_us_response');

    Route::get('/faq', 'PageController@faq')
        ->name('faq');

     Route::get('/komentar', 'PageController@komentar')
        ->name('komentar');

    Route::get('/cari-berita', 'PageController@search_news')
        ->name('search_news');

    Route::get('/cari-pengumuman', 'PageController@search_announce')
        ->name('search_announce');

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
    
    Route::post('/kirim_komentar', [KomentarController::class, 'store'])->name('komentar.store');

    Route::get('/berita/tag/{slug}', 'PageController@tag')->name('tag.filter');

    Route::get('/pengumuman/tag/{slug}', 'PageController@tag_announce')->name('tag.filter_announce');
