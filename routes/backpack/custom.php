<?php

use Illuminate\Support\Facades\Route;

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin')
    ),
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::crud('user', 'UserCrudController');
    Route::crud('tag', 'TagCrudController');
    Route::crud('article', 'ArticleCrudController');
    Route::crud('category', 'CategoryCrudController');
    Route::crud('faq', 'FaqCrudController');
    Route::crud('stakeholder', 'StakeholderCrudController');
    Route::crud('slideshow', 'SlideshowCrudController');
    Route::crud('comment', 'CommentCrudController');
    Route::crud('permohonan-informasi', 'PermohonanInformasiCrudController');

    Route::post(
        'permohonan-informasi/{id}/update-status',
        [\App\Http\Controllers\Admin\PermohonanInformasiCrudController::class, 'updateStatus']
    )->name('permohonan.updateStatus');
}); // this should be the absolute last line of this file