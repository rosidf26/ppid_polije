<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermohonanInformasi extends Model
{
    protected $table = 'permohonan_informasi';

    protected $fillable = [
        'kategori',

        // perseorangan
        'nama_pemohon',
        'alamat_pemohon',
        'hp_pemohon',
        'email_pemohon',
        'ktp_pemohon',

        // pengguna informasi
        'nama_pengguna',
        'alamat_pengguna',
        'hp_pengguna',
        'email_pengguna',
        'ktp_pengguna',

        // lembaga
        'nama_organisasi',
        'telp_organisasi',
        'email_organisasi',
        'medsos_organisasi',

        'nama_narahubung',
        'telp_narahubung',
        'ktp_narahubung',

        // info
        'info_dibutuhkan',
        'alasan_butuh',
        'sumber_info',
        'alamat_info',
    ];
}
