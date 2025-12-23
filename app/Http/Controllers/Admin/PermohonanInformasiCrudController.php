<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PermohonanInformasiRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Barryvdh\DomPDF\Facade\Pdf;

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
        // tampilkan kategori dulu
        $this->crud->addColumn([
            'name' => 'kategori',
            'label' => 'Kategori',
            'type' => 'text',
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
            'name' => 'nama_display',
            'label' => 'Nama',
            'type' => 'text',
            'searchLogic' => function ($query, $column, $searchTerm) {
                $query->orWhere(function ($q) use ($searchTerm) {
                    $q->where('nama_pemohon', 'like', '%' . $searchTerm . '%')
                        ->orWhere('nama_organisasi', 'like', '%' . $searchTerm . '%')
                        ->orWhere('unik_request', 'like', '%' . $searchTerm . '%');
                });
            },
        ]);

        $this->crud->addColumn([
            'name' => 'hp_display',
            'label' => 'HP',
            'type' => 'text',
            'searchLogic' => function ($query, $column, $searchTerm) {
                $query->orWhere(function ($q) use ($searchTerm) {
                    $q->where('hp_pemohon', 'like', '%' . $searchTerm . '%')
                        ->orWhere('telp_organisasi', 'like', '%' . $searchTerm . '%');
                });
            },
        ]);

        $this->crud->addColumn([
            'name' => 'email_display',
            'label' => 'Email',
            'type' => 'text',
            'searchLogic' => function ($query, $column, $searchTerm) {
                $query->orWhere(function ($q) use ($searchTerm) {
                    $q->where('email_pemohon', 'like', '%' . $searchTerm . '%')
                        ->orWhere('email_organisasi', 'like', '%' . $searchTerm . '%');
                });
            },
        ]);

        $this->crud->addColumn([
            'name' => 'tgl_pengajuan_display',
            'label' => 'Tanggal Pengajuan',
        ]);

        $this->crud->addColumn([
            'name' => 'rerata_display',
            'label' => 'Waktu Respon (Hari)',
            'type' => 'text',
            'searchLogic' => false,
        ]);

        $this->crud->addColumn([
            'name' => 'status',
            'label' => 'Status',
            'type' => 'text',
            'wrapper' => [
                'element' => 'span',
                'class' => function ($crud, $column, $entry) {
                    if ($entry->status === 'diterima') {
                        return 'badge badge-success';   // hijau
                    } else if ($entry->status === 'ditolak') {
                        return 'badge badge-danger';
                    }
                    return 'badge badge-secondary';        // merah
                },
            ],
        ]);

        $this->crud->addFilter([
            'name' => 'kategori',
            'type' => 'dropdown',
            'label' => 'Kategori'
        ], [
            'perseorangan' => 'Perseorangan',
            'lembaga' => 'Lembaga',
        ], function ($value) {
            $this->crud->addClause('where', 'kategori', $value);
        });

        $this->crud->addFilter([
            'name' => 'status',
            'type' => 'dropdown',
            'label' => 'Status'
        ], [
            'belum direspon' => 'Belum Direspon',
            'diterima' => 'Diterima',
            'ditolak' => 'Ditolak',
        ], function ($value) {
            $this->crud->addClause('where', 'status', $value);
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
    // protected function setupCreateOperation()
    // {
    //     CRUD::setValidation(PermohonanInformasiRequest::class);

    //     CRUD::field('nama_pemohon');
    //     CRUD::field('alamat_pemohon');
    //     CRUD::field('hp_pemohon');
    //     CRUD::field('email_pemohon');
    //     CRUD::field('ktp_pemohon');
    //     CRUD::field('nama_pengguna');
    //     CRUD::field('alamat_pengguna');
    //     CRUD::field('hp_pengguna');
    //     CRUD::field('email_pengguna');
    //     CRUD::field('ktp_pengguna');
    //     CRUD::field('nama_organisasi');
    //     CRUD::field('telp_organisasi');
    //     CRUD::field('email_organisasi');
    //     CRUD::field('medsos_organisasi');
    //     CRUD::field('nama_narahubung');
    //     CRUD::field('telp_narahubung');
    //     CRUD::field('ktp_narahubung');
    //     CRUD::field('info_dibutuhkan');
    //     CRUD::field('alasan_butuh');
    //     CRUD::field('sumber_info');
    //     CRUD::field('alamat_info');

    //     /**
    //      * Fields can be defined using the fluent syntax or array syntax:
    //      * - CRUD::field('price')->type('number');
    //      * - CRUD::addField(['name' => 'price', 'type' => 'number'])); 
    //      */
    // }

    public function updateStatus($id)
    {
        $data = \App\Models\PermohonanInformasi::findOrFail($id);

        $status = request('status'); // diterima | ditolak
        $respon = request('respon');

        // validasi status
        if (!in_array($status, ['diterima', 'ditolak'], true)) {
            return response()->json([
                'error' => 'Status tidak valid'
            ], 422);
        }

        \DB::transaction(function () use ($data, $status, $respon) {

            // set tanggal respon (sekali saja)
            if (empty($data->tgl_direspon)) {
                $data->tgl_direspon = now()->toDateString();
            }

            // hitung waktu menjawab (diterima & ditolak)
            $data->waktu_menjawab = $data->hitungWaktuMenjawab();

            // set status & respon
            $data->status = $status;
            $data->respon = $respon;

            $data->save();
        });

        return response()->json(['success' => true]);
    }


    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    // protected function setupUpdateOperation()
    // {
    //     $this->setupCreateOperation();
    // }

    protected function setupShowOperation()
    {
        // Matikan auto-fetch kolom dari database !!!
        $this->crud->set('show.setFromDb', false);
        $entry = $this->crud->getCurrentEntry(); // ambil data yg sedang dilihat

        $this->crud->addColumn(['name' => 'unik_request', 'label' => 'Request ID', 'type' => 'null_fallback']);
        $this->crud->addColumn([
            'name' => 'status',
            'label' => 'Status Permohonan',
            'type' => 'model_function',
            'function_name' => 'getStatusBadge',
            'escaped' => false,
        ]);

        $this->crud->addColumn([
            'name' => 'kategori',
            'label' => 'Kategori',
            'type' => 'model_function',
            'function_name' => 'getKategoriBadge',
            'escaped' => false,
        ]);

        if ($entry->kategori === 'perseorangan') {

            // 🔵 Field khusus perseorangan
            $this->crud->addColumn(['name' => 'nama_pemohon', 'label' => 'Nama Pemohon', 'type' => 'null_fallback']);
            $this->crud->addColumn(['name' => 'alamat_pemohon', 'label' => 'Alamat Pemohon', 'type' => 'null_fallback']);
            // $this->crud->addColumn(['name' => 'hp_pemohon', 'label' => 'HP Pemohon', 'type'  => 'null_fallback']);
            $this->crud->addColumn([
                'name' => 'hp_pemohon',
                'label' => 'HP Pemohon',
                'type' => 'model_function',
                'function_name' => 'formatHpPemohonWA',
                'escaped' => false, // WAJIB agar <a> tidak difilter
            ]);
            $this->crud->addColumn(['name' => 'email_pemohon', 'label' => 'Email Pemohon', 'type' => 'null_fallback']);
            $this->crud->addColumn([
                'name' => 'ktp_pemohon',
                'label' => 'KTP Pemohon',
                'type' => 'model_function',
                'function_name' => 'getKtpPemohonLink',
                'escaped' => false, // WAJIB
            ]);
            // $this->crud->addColumn(['name' => 'ktp_pemohon', 'label' => 'KTP Pemohon', 'type'  => 'null_fallback']);

            $this->crud->addColumn(['name' => 'nama_pengguna', 'label' => 'Nama Pengguna', 'type' => 'null_fallback']);
            $this->crud->addColumn(['name' => 'alamat_pengguna', 'label' => 'Alamat Pengguna', 'type' => 'null_fallback']);
            $this->crud->addColumn(['name' => 'hp_pengguna', 'label' => 'HP Pengguna', 'type' => 'null_fallback']);
            $this->crud->addColumn(['name' => 'email_pengguna', 'label' => 'Email Pengguna', 'type' => 'null_fallback']);

        } else {

            // 🟣 Field khusus lembaga
            $this->crud->addColumn(['name' => 'nama_organisasi', 'label' => 'Nama Organisasi', 'type' => 'null_fallback']);
            $this->crud->addColumn(['name' => 'telp_organisasi', 'label' => 'Telp Organisasi', 'type' => 'null_fallback']);
            $this->crud->addColumn(['name' => 'email_organisasi', 'label' => 'Email Organisasi', 'type' => 'null_fallback']);
            $this->crud->addColumn(['name' => 'medsos_organisasi', 'label' => 'Medsos Organisasi', 'type' => 'null_fallback']);

            $this->crud->addColumn(['name' => 'nama_narahubung', 'label' => 'Nama Narahubung', 'type' => 'null_fallback']);
            $this->crud->addColumn([
                'name' => 'telp_narahubung',
                'label' => 'Telp Narahubung',
                'type' => 'model_function',
                'function_name' => 'formatHpNarahubungWA',
                'escaped' => false, // WAJIB agar <a> tidak difilter
            ]);
            $this->crud->addColumn([
                'name' => 'ktp_narahubung',
                'label' => 'KTP Narahubung',
                'type' => 'model_function',
                'function_name' => 'getKtpNarahubungLink',
                'escaped' => false, // WAJIB
            ]);

        }

        // 🟢 Field umum (selalu tampil)
        $this->crud->addColumn(['name' => 'info_dibutuhkan', 'label' => 'Info Dibutuhkan', 'type' => 'null_fallback']);
        $this->crud->addColumn(['name' => 'alasan_butuh', 'label' => 'Alasan Butuh', 'type' => 'null_fallback']);
        $this->crud->addColumn(['name' => 'sumber_info', 'label' => 'Sumber Informasi', 'type' => 'null_fallback']);
        $this->crud->addColumn(['name' => 'alamat_info', 'label' => 'Alamat Informasi', 'type' => 'null_fallback']);
        $this->crud->addColumn(['name' => 'respon', 'label' => 'Respon', 'type' => 'null_fallback']);
        $this->crud->addColumn(['name' => 'tgl_pengajuan_display', 'label' => 'Tanggal Pengajuan', 'type' => 'null_fallback']);
        $this->crud->addColumn(['name' => 'tgl_direspon_display', 'label' => 'Tanggal Direspon', 'type' => 'null_fallback']);
        $this->crud->addColumn(['name' => 'rerata_display', 'label' => 'Waktu Respon', 'type' => 'null_fallback']);


        $this->crud->addButtonFromView('line', 'back_button', 'back_button', 'beginning');

        if ($entry->status !== 'belum direspon') {
            $this->crud->addButtonFromView('line', 'export_pdf', 'export_pdf', 'beginning');
        }

        if ($entry->status === 'belum direspon') {
            $this->crud->addButtonFromView(
                'line',
                'update_status_btn',
                'update_status',
                'beginning'
            );
        }

    }

    public function exportPdf($id)
    {
        $data = \App\Models\PermohonanInformasi::findOrFail($id);

        // tentukan file yang dipakai sesuai kategori
        $view = $data->kategori === 'perseorangan'
            ? 'pdf.perseorangan'
            : 'pdf.lembaga';

        $pdf = Pdf::loadView($view, compact('data'))
            ->setPaper('A5', 'portrait');

        return $pdf->download($data->unik_request . '.pdf');
    }
}
