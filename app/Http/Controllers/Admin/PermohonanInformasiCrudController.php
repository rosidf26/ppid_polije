<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PermohonanInformasiRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class PermohonanInformasiCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class PermohonanInformasiCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\PermohonanInformasi::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/permohonan-informasi');
        CRUD::setEntityNameStrings('permohonan informasi', 'permohonan informasi');
        CRUD::denyAccess('create');
        CRUD::denyAccess('update');
        // Hide the Delete button
        CRUD::denyAccess('delete');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        // CRUD::column('kategori');
        // CRUD::column('nama_pemohon');
        // CRUD::column('alamat_pemohon');
        // CRUD::column('hp_pemohon');
        // CRUD::column('email_pemohon');
        // CRUD::column('ktp_pemohon');
        // CRUD::column('nama_pengguna');
        // CRUD::column('alamat_pengguna');
        // CRUD::column('hp_pengguna');
        // CRUD::column('email_pengguna');
        // CRUD::column('ktp_pengguna');
        // CRUD::column('nama_organisasi');
        // CRUD::column('telp_organisasi');
        // CRUD::column('email_organisasi');
        // CRUD::column('medsos_organisasi');
        // CRUD::column('nama_narahubung');
        // CRUD::column('telp_narahubung');
        // CRUD::column('ktp_narahubung');
        // CRUD::column('info_dibutuhkan');
        // CRUD::column('alasan_butuh');
        // CRUD::column('sumber_info');
        // CRUD::column('alamat_info');

        // tampilkan kategori dulu
        $this->crud->addColumn([
            'name'  => 'kategori',
            'label' => 'Kategori',
            'type'  => 'text',
            'wrapper' => [
                'element' => 'span',
                'class' => function ($crud, $column, $entry) {
                    return $entry->kategori === 'lembaga'
                        ? 'badge badge-kategori-lembaga'
                        : 'badge badge-primary';
                },
            ],
        ]);

        $this->crud->addColumn([
            'name'  => 'nama_display',
            'label' => 'Nama',
            'type'  => 'text',
            'searchLogic' => function ($query, $column, $searchTerm) {
                $query->orWhere(function ($q) use ($searchTerm) {
                    $q->where('nama_pemohon', 'like', '%' . $searchTerm . '%')
                        ->orWhere('nama_organisasi', 'like', '%' . $searchTerm . '%');
                });
            },
        ]);

        $this->crud->addColumn([
            'name'  => 'hp_display',
            'label' => 'HP',
            'type'  => 'text',
            'searchLogic' => function ($query, $column, $searchTerm) {
                $query->orWhere(function ($q) use ($searchTerm) {
                    $q->where('hp_pemohon', 'like', '%' . $searchTerm . '%')
                        ->orWhere('telp_organisasi', 'like', '%' . $searchTerm . '%');
                });
            },
        ]);

        $this->crud->addColumn([
            'name'  => 'email_display',
            'label' => 'Email',
            'type'  => 'text',
            'searchLogic' => function ($query, $column, $searchTerm) {
                $query->orWhere(function ($q) use ($searchTerm) {
                    $q->where('email_pemohon', 'like', '%' . $searchTerm . '%')
                        ->orWhere('email_organisasi', 'like', '%' . $searchTerm . '%');
                });
            },
        ]);

        $this->crud->addColumn([
            'name'  => 'created_date',
            'label' => 'Tanggal Masuk',
        ]);

        $this->crud->addColumn([
            'label' => 'Waktu Respon (Hari)',
            'type'  => 'model_function',
            'function_name' => 'getRerataDisplay',
            'searchLogic' => false,
        ]);

        $this->crud->addColumn([
            'name'  => 'status',
            'label' => 'Status',
            'type'  => 'text',
            'wrapper' => [
                'element' => 'span',
                'class' => function ($crud, $column, $entry) {
                    if ($entry->status === 'sudah direspon') {
                        return 'badge badge-success';   // hijau
                    }
                    return 'badge badge-danger';        // merah
                },
            ],
        ]);

        $this->crud->addFilter([
            'name'  => 'kategori',
            'type'  => 'dropdown',
            'label' => 'Kategori'
        ], [
            'perseorangan' => 'Perseorangan',
            'lembaga' => 'Lembaga',
        ], function ($value) {
            $this->crud->addClause('where', 'kategori', $value);
        });

        $this->crud->addButtonFromView('line', 'update_status_btn', 'update_status', 'beginning');
        $this->crud->addButtonFromView('top', 'refresh_datatable', 'refresh_datatable', 'beginning');

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']); 
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(PermohonanInformasiRequest::class);

        CRUD::field('kategori');
        CRUD::field('nama_pemohon');
        CRUD::field('alamat_pemohon');
        CRUD::field('hp_pemohon');
        CRUD::field('email_pemohon');
        CRUD::field('ktp_pemohon');
        CRUD::field('nama_pengguna');
        CRUD::field('alamat_pengguna');
        CRUD::field('hp_pengguna');
        CRUD::field('email_pengguna');
        CRUD::field('ktp_pengguna');
        CRUD::field('nama_organisasi');
        CRUD::field('telp_organisasi');
        CRUD::field('email_organisasi');
        CRUD::field('medsos_organisasi');
        CRUD::field('nama_narahubung');
        CRUD::field('telp_narahubung');
        CRUD::field('ktp_narahubung');
        CRUD::field('info_dibutuhkan');
        CRUD::field('alasan_butuh');
        CRUD::field('sumber_info');
        CRUD::field('alamat_info');

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number'])); 
         */
    }

    public function updateStatus($id)
    {
        $data = \App\Models\PermohonanInformasi::findOrFail($id);

        $days = $data->created_at
            ->copy()->startOfDay()
            ->diffInDays(now()->startOfDay());

        $data->status = 'sudah direspon';
        $data->rerata_menjawab = $days;   // hasilnya 4 untuk 5 → 9
        $data->save();
        return response()->json(['success' => true]);
    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
