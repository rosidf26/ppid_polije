<?php

namespace App\Providers;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Carbon::setLocale('id');

        // tombol kembali GLOBAL untuk halaman SHOW
        CRUD::addButtonFromView('show', 'back_button', 'back_button', 'beginning');
    }
}
