<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Backpack\CRUD\app\Models\Traits\CrudTrait;

class PermohonanInformasi extends Model
{
    use CrudTrait;
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

    public function getNamaDisplayAttribute()
    {
        return $this->kategori === 'lembaga'
            ? $this->nama_organisasi
            : $this->nama_pemohon;
    }

    public function getHpDisplayAttribute()
    {
        return $this->kategori === 'lembaga'
            ? $this->telp_organisasi
            : $this->hp_pemohon;
    }

    public function getEmailDisplayAttribute()
    {
        return $this->kategori === 'lembaga'
            ? $this->email_organisasi
            : $this->email_pemohon;
    }

    public function getCreatedDateAttribute()
    {
        return tgl_indo($this->created_at);
    }

    public function getRerataDisplay()
    {
        return $this->rerata_menjawab !== null
            ? $this->rerata_menjawab
            : '-';
    }
}
