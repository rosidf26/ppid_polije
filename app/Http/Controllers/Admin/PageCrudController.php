<?php

namespace App\Http\Controllers\Admin;

use Backpack\PageManager\app\Http\Controllers\Admin\PageCrudController as Original;

class PageCrudController extends Original
{
    public function setup()
    {
        parent::setup();

        if (!backpack_user()->can('tambah halaman')) {
            $this->crud->denyAccess('create');
        }

        if (!backpack_user()->can('ubah halaman')) {
            $this->crud->denyAccess('update');
        }

        if (!backpack_user()->can('hapus halaman')) {
            $this->crud->denyAccess('delete');
        }

        // Admin otomatis full CRUD
    }
}
