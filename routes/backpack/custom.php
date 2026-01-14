<?php

use Illuminate\Support\Facades\Route;

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix' => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin')
    ),
    'namespace' => 'App\Http\Controllers\Admin',
], function () { // custom admin routes

    Route::get('dashboard', 'DashboardController@index')
        ->middleware('permission:lihat dashboard')
        ->name('backpack.dashboard');

    Route::post(
        'permohonan-informasi/{id}/update-status',
        'PermohonanInformasiCrudController@updateStatus'
    )->name('permohonan.updateStatus');

    Route::post(
        'pernyataan-keberatan/{id}/update-status',
        'PernyataankeberatanCrudController@updateStatus'
    )->name('keberatan.updateStatus');

    Route::get(
        'permohonan-informasi/{id}/export-pdf',
        'PermohonanInformasiCrudController@exportPdf'
    )
        ->middleware('permission:export permohonan')
        ->name('permohonan.exportPdf');

    Route::get(
        'pernyataan-keberatan/{id}/export-pdf',
        'PernyataankeberatanCrudController@exportPdf'
    )->name('keberatan.exportPdf');

    Route::crud('user', 'UserCrudController');
    Route::crud('tag', 'TagCrudController');
    Route::crud('article', 'ArticleCrudController');
    Route::crud('category', 'CategoryCrudController');
    Route::crud('faq', 'FaqCrudController');
    Route::crud('stakeholder', 'StakeholderCrudController');
    Route::crud('slideshow', 'SlideshowCrudController');
    Route::crud('comment', 'CommentCrudController');
    Route::crud('permohonan-informasi', 'PermohonanInformasiCrudController');
    Route::crud('pernyataan-keberatan', 'PernyataankeberatanCrudController');
}); // this should be the absolute last line of this file