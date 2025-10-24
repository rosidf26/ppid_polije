<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontpageController extends Controller
{
    public function index()
    {
        return view('frontpage.index');
    }

    public function sambutan()
    {
        // $pageTitle = ucwords(str_replace('-', ' ', request()->segment(1))); // Mengambil segment pertama (misal: "halaman-produk") dan mengubahnya jadi "Halaman Produk"
        // return view('frontpage.sambutan_dir', [
        //     'pageTitle' => $pageTitle,

        // ]);
        return view('frontpage.sambutan_dir');
    }

     public function profil()
    {
        return view('frontpage.profil_polije');
    }

    public function profil_ppid()
    {
        return view('frontpage.profil_ppid');
    }

    public function tupoksi()
    {
        return view('frontpage.tupoksi');
    }

    public function regulasi()
    {
        return view('frontpage.regulasi');
    }

    public function info_publik()
    {
        return view('frontpage.info_publik');
    }

    public function info_kecuali()
    {
        return view('frontpage.info_kecuali');
    }

    public function info_setiapsaat()
    {
        return view('frontpage.info_setiapsaat');
    }

    public function info_berkala()
    {
        return view('frontpage.info_berkala');
    }

    public function info_sertamerta()
    {
        return view('frontpage.info_sertamerta');
    }

    public function rekapitulasi()
    {
        return view('frontpage.rekapitulasi');
    }

    public function maklumat()
    {
        return view('frontpage.maklumat');
    }

     public function standar_pelayanan()
    {
        return view('frontpage.standar_pelayanan');
    }

     public function biaya_pelayanan()
    {
        return view('frontpage.biaya');
    }

    public function prosedur_permohonan()
    {
        return view('frontpage.prosedur_permohonan');
    }

    public function prosedur_keberatan()
    {
        return view('frontpage.prosedur_keberatan');
    }

     public function prosedur_sengketa()
    {
        return view('frontpage.prosedur_sengketa');
    }

     public function berita()
    {
        return view('frontpage.berita');
    }

     public function pengumuman()
    {
        return view('frontpage.pengumuman');
    }

     public function faq()
    {
        return view('frontpage.faq');
    }

    public function detail_berita()
    {
        return view('frontpage.detail_berita');
    }

     public function detail_pengumuman()
    {
        return view('frontpage.detail_pengumuman');
    }

    public function komentar()
    {
        return view('frontpage.kirim_komentar');
    }
}
