<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Backpack\CRUD\app\Models\Traits\CrudTrait;
use App\Models\PermohonanInformasi;

class PernyataanKeberatan extends Model
{
    use CrudTrait;
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

    protected $casts = [
        'tgl_pengajuan' => 'date',
        'tgl_direspon' => 'date',
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

    public function getTglPengajuanDisplayAttribute()
    {
        return $this->tgl_pengajuan
            ? tgl_indo($this->tgl_pengajuan)
            : '-';
    }

    public function getTglDiresponDisplayAttribute()
    {
        return $this->tgl_direspon
            ? tgl_indo($this->tgl_direspon)
            : '-';
    }


    public function getRerataDisplayAttribute()
    {
        return $this->waktu_menjawab !== null
            ? $this->waktu_menjawab . ' Hari'
            : '-';
    }

    public function getStatusBadge()
    {
        switch ($this->status) {
            case 'belum direspon':
                return '<span class="badge badge-secondary">Belum Direspon</span>';

            case 'diterima':
                return '<span class="badge badge-success">Diterima</span>';

            case 'ditolak':
                return '<span class="badge badge-danger">Ditolak</span>';

            default:
                return '<span class="badge badge-light">-</span>';
        }
    }

    public function getPermohonanLink()
    {
        if (!$this->permohonan)
            return '-';

        return '<a href="' . url('admin/permohonan-informasi/' . $this->permohonan->id . '/show') . '" target="_blank">
        ' . $this->permohonan->unik_request . '
    </a>';
    }

    public function getStatusPermohonanBadge()
    {
        if (!$this->permohonan) {
            return '<span class="badge badge-secondary">-</span>';
        }

        switch ($this->permohonan->status) {
            case 'diterima':
                return '<span class="badge badge-success">Diterima</span>';
            case 'ditolak':
                return '<span class="badge badge-danger">Ditolak</span>';
            default:
                return '<span class="badge badge-secondary">Belum Direspon</span>';
        }
    }

    public function hitungWaktuMenjawab()
    {
        if (!$this->tgl_pengajuan || !$this->tgl_direspon) {
            return null;
        }

        return $this->tgl_pengajuan
            ->startOfDay()
            ->diffInDays(
                $this->tgl_direspon->startOfDay()
            );
    }
}
