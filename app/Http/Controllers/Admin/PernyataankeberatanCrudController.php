<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PernyataankeberatanRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Barryvdh\DomPDF\Facade\Pdf;

/**
 * Class PernyataankeberatanCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class PernyataankeberatanCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Pernyataankeberatan::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/pernyataan-keberatan');
        CRUD::setEntityNameStrings('pernyataan keberatan', 'pernyataan keberatan');
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

        $this->crud->addColumn([
            'name' => 'nama_pemohon',
            'label' => 'Nama Pemohon',
            'type' => 'text',
            'searchLogic' => true,
        ]);

        $this->crud->addColumn([
            'name' => 'alasan_keberatan',
            'label' => 'Alasan Keberatan',
            'type' => 'text',
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

        // $this->crud->addButtonFromView('line', 'update_keberatan_btn', 'update_keberatan', 'beginning');
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
    //     CRUD::setValidation(PernyataankeberatanRequest::class);

    //     CRUD::field('permohonan_id');
    //     CRUD::field('nama_pemohon');
    //     CRUD::field('pekerjaan_pemohon');
    //     CRUD::field('nama_kuasa_pemohon');
    //     CRUD::field('alasan_keberatan');
    //     CRUD::field('kasus_posisi');
    //     CRUD::field('status');
    //     CRUD::field('respon');
    //     CRUD::field('tgl_pengajuan');
    //     CRUD::field('tgl_direspon');
    //     CRUD::field('waktu_menjawab');
    //     CRUD::field('unik_request');
    // }

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

    protected function setupShowOperation()
    {
        // Matikan auto-fetch kolom dari database !!!
        $this->crud->set('show.setFromDb', false);
        $entry = $this->crud->getCurrentEntry(); // ambil data yg sedang dilihat

        $this->crud->addColumn(['name' => 'unik_request', 'label' => 'Nomor Permohonan Keberatan', 'type' => 'null_fallback']);
        $this->crud->addColumn([
            'name' => 'status',
            'label' => 'Status Permohonan Keberatan',
            'type' => 'model_function',
            'function_name' => 'getStatusBadge',
            'escaped' => false,
        ]);

        $this->crud->addColumn(['name' => 'nama_pemohon', 'label' => 'Nama Pemohon', 'type' => 'null_fallback']);
        $this->crud->addColumn(['name' => 'pekerjaan_pemohon', 'label' => 'Pekerjaan Pemohon', 'type' => 'null_fallback']);
        $this->crud->addColumn(['name' => 'nama_kuasa_pemohon', 'label' => 'Nama Kuasa Pemohon', 'type' => 'null_fallback']);
        $this->crud->addColumn(['name' => 'alasan_keberatan', 'label' => 'Alasan Keberatan', 'type' => 'null_fallback']);
        $this->crud->addColumn(['name' => 'kasus_posisi', 'label' => 'Kasus Posisi', 'type' => 'null_fallback']);

        $this->crud->addColumn(['name' => 'tgl_pengajuan_display', 'label' => 'Tanggal Pengajuan', 'type' => 'null_fallback']);

        $this->crud->addColumn(['name' => 'tgl_pengajuan_display', 'label' => 'Tanggal Pengajuan', 'type' => 'null_fallback']);


        $this->crud->addButtonFromView('line', 'back_button', 'back_button', 'beginning');

        if ($entry->status !== 'belum direspon') {
            $this->crud->addColumn(['name' => 'tgl_direspon_display', 'label' => 'Tanggal Direspon', 'type' => 'null_fallback']);
            $this->crud->addColumn(['name' => 'rerata_display', 'label' => 'Waktu Respon', 'type' => 'null_fallback']);
            $this->crud->addColumn(['name' => 'respon', 'label' => 'Respon PPID', 'type' => 'null_fallback']);
            if (backpack_user()->can('export keberatan')) {
                $this->crud->addButtonFromView('line', 'export_pdf', 'export_pdf', 'beginning');
            }
        }

        /* ===============================
         * PEMBATAS / SEPARATOR
         * =============================== */
        $this->crud->addColumn([
            'name' => 'RIWAYAT_PERMOHONAN_INFORMASI',
            'type' => 'custom_html',
            'value' => '',
        ]);

        /* ===============================
         * DATA PERMOHONAN INFORMASI
         * =============================== */

        $this->crud->addColumn([
            'label' => 'Nomor Permohonan Informasi',
            'name' => 'permohonan.unik_request',
            'type' => 'model_function',
            'function_name' => 'getPermohonanLink',
        ]);

        $this->crud->addColumn([
            'label' => 'Nama Pemohon',
            'name' => 'permohonan.nama_display',
            'type' => 'text',
        ]);

        $this->crud->addColumn([
            'label' => 'Status Permohonan Informasi',
            'name' => 'status_permohonan',
            'type' => 'model_function',
            'function_name' => 'getStatusPermohonanBadge',
            'escaped' => false, // WAJIB agar HTML badge tampil
        ]);

        if (backpack_user()->can('respon keberatan')) {
            $this->crud->addButtonFromView(
                'line',
                'update_keberatan_btn',
                'update_keberatan',
                'beginning'
            );
        }

    }

    public function updateStatus($id)
    {
        $data = \App\Models\PernyataanKeberatan::findOrFail($id);

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

    public function exportPdf($id)
    {
        $data = \App\Models\PernyataanKeberatan::findOrFail($id);

        // tentukan file yang dipakai sesuai kategori
        $view = 'pdf.keberatan';

        $pdf = Pdf::loadView($view, compact('data'))
            ->setPaper('A5', 'portrait');

        return $pdf->download($data->unik_request . '.pdf');
    }

}
