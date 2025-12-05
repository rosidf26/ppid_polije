<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PernyataanKeberatan extends Model
{
    protected $table = 'pernyataan_keberatan';

    protected $fillable = [
        'nama_pemohon',
        'pekerjaan_pemohon',
        'nama_kuasa_pemohon',
        'alasan_keberatan',
        'kasus_posisi'
    ];
}
