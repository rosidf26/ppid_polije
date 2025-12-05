<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PermohonanInformasiRequest;
use App\Http\Requests\KeberatanRequest;
use App\Models\PermohonanInformasi;
use App\Models\PernyataanKeberatan;

class BlangkoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index($slug = null)
    // {
    //     // Normalisasi slug biar aman (lowercase)
    //     $slug = strtolower($slug);

    //     switch ($slug) {
    //         case 'permohonan-informasi':
    //             return view('frontpage.page-templates.permintaan_informasi');  // VIEW A

    //         case 'pernyataan-keberatan':
    //             return view('frontpage.page-templates.pernyataan_keberatan');  // VIEW B

    //         default:
    //             abort(404);  // Jika slug tidak dikenali
    //     }
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function permohonanSubmit(PermohonanInformasiRequest $request)
    {
        $data = $request->validated();
        try {

            /* =======================================================
         * 1. HANDLE FILE UPLOAD (SEMENTARA)
         * =======================================================*/

            // KTP Pemohon
            if ($request->hasFile('ktp_pemohon')) {
                $data['ktp_pemohon'] = $request->file('ktp_pemohon')
                    ->store('ktp_pemohon', 'public');
            }

            // KTP Pengguna
            if ($request->hasFile('ktp_pengguna')) {
                $data['ktp_pengguna'] = $request->file('ktp_pengguna')
                    ->store('ktp_pengguna', 'public');
            }

            // KTP Lembaga – Organisasi
            if ($request->hasFile('ktp_narahubung')) {
                $data['ktp_narahubung'] = $request->file('ktp_narahubung')
                    ->store('ktp_narahubung', 'public');
            }

            /* =======================================================
         * 2. INSERT DATABASE
         * Model: PermohonanInformasi
         * =======================================================*/

            PermohonanInformasi::create($data);

            /* =======================================================
         * 3. Jika berhasil simpan → return sukses
         * =======================================================*/

            return redirect('/e-blangko-permohonan-informasi')->with('success', 'Permohonan informasi Anda berhasil terkirim. Estimasi waktu respons adalah 3-5 hari kerja, dan kami mohon kesabaran Anda untuk menunggu, Terimakasih.');
        } catch (\Exception $e) {

            /* =======================================================
         * 4. HAPUS FILE JIKA DATABASE GAGAL
         * =======================================================*/

            if (!empty($data['ktp_pemohon'])) {
                \Storage::disk('public')->delete($data['ktp_pemohon']);
            }

            if (!empty($data['ktp_pengguna'])) {
                \Storage::disk('public')->delete($data['ktp_pengguna']);
            }

            if (!empty($data['ktp_narahubung'])) {
                \Storage::disk('public')->delete($data['ktp_narahubung']);
            }

            /* =======================================================
         * 5. Return error ke user dengan pesan aman
         * =======================================================*/

            return back()
                ->withErrors(['db_error' => 'Terjadi kesalahan pada server, silakan coba lagi.'])
                ->withInput();
        }
    }

    public function keberatanSubmit(KeberatanRequest $request)
    {
        $data = $request->validated();
        try {


            PernyataanKeberatan::create($data);

            return redirect('/e-blangko-pernyataan-keberatan')->with('success', 'Pernyataan keberatan Anda berhasil terkirim. Estimasi waktu respons adalah 3-5 hari kerja, dan kami mohon kesabaran Anda untuk menunggu, Terimakasih.');
        } catch (\Exception $e) {

            return back()
                ->withErrors(['db_error' => 'Terjadi kesalahan pada server, silakan coba lagi.'])
                ->withInput();
        }
    }

    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
