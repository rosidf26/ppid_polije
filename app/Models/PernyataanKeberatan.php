<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\PermohonanInformasi;

class PernyataanKeberatan extends Model
{
    protected $table = 'pernyataan_keberatan';

    protected $fillable = [
        // relasi
        'permohonan_id',

        // identitas
        'nama_pemohon',
        'pekerjaan_pemohon',
        'nama_kuasa_pemohon',

        // substansi
        'alasan_keberatan',
        'kasus_posisi',

        // status & respon
        'status',
        'respon',

        // waktu
        'tgl_pengajuan',
        'tgl_direspon',
        'waktu_menjawab',

        // sistem
        'unik_request',
    ];

    public function permohonan()
    {
        return $this->belongsTo(
            PermohonanInformasi::class,
            'permohonan_id',
            'id'
        );
    }

    public function sudahDirespon()
    {
        return in_array($this->status, ['diterima', 'ditolak']);
    }
}
