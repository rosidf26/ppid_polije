<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Backpack\CRUD\app\Models\Traits\CrudTrait;
use App\Models\PernyataanKeberatan;

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
        'status',
        'respon',
        'tgl_pengajuan',
        'tgl_direspon',
        'waktu_menjawab',
        'unik_request',
    ];

    protected $casts = [
        'tgl_pengajuan' => 'date',
        'tgl_direspon' => 'date',
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

    /* =======================
     |  BUSINESS LOGIC
     ======================= */

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

    public function getRerataDisplayAttribute()
    {
        return $this->waktu_menjawab !== null
            ? $this->waktu_menjawab . ' Hari'
            : '-';
    }

    public function formatHpPemohonWA()
    {
        if (!$this->hp_pemohon) {
            return '-';
        }

        // Normalisasi nomor (hapus spasi dan simbol)
        $number = preg_replace('/\D/', '', $this->hp_pemohon);

        // Jika mulai dengan 0 → jadikan 62
        if (substr($number, 0, 1) === '0') {
            $number = '62' . substr($number, 1);
        }

        // Jika mulai dengan +62 → jadikan 62
        if (substr($number, 0, 3) === '620') {
            $number = '62' . substr($number, 3);
        }

        $waUrl = "https://wa.me/" . $number;

        return '<a href="' . $waUrl . '" target="_blank" class="btn btn-outline-success btn-xs">
                <i class="la la-whatsapp"></i> ' . $this->hp_pemohon . '
            </a>';
    }

    public function formatHpNarahubungWA()
    {
        if (!$this->telp_narahubung) {
            return '-';
        }

        // Normalisasi nomor (hapus spasi dan simbol)
        $number = preg_replace('/\D/', '', $this->telp_narahubung);

        // Jika mulai dengan 0 → jadikan 62
        if (substr($number, 0, 1) === '0') {
            $number = '62' . substr($number, 1);
        }

        // Jika mulai dengan +62 → jadikan 62
        if (substr($number, 0, 3) === '620') {
            $number = '62' . substr($number, 3);
        }

        $waUrl = "https://wa.me/" . $number;

        return '<a href="' . $waUrl . '" target="_blank" class="btn btn-outline-success btn-xs">
                <i class="la la-whatsapp"></i> ' . $this->telp_narahubung . '
            </a>';
    }

    public function getKtpPemohonLink()
    {
        if (!$this->ktp_pemohon) {
            return '<span class="text-muted">-</span>';
        }

        // sesuaikan path jika beda
        $url = asset('storage/' . $this->ktp_pemohon);

        return '<a href="' . $url . '" target="_blank" class="btn btn-xs btn-outline-primary">
                <i class="la la-id-card"></i> Lihat KTP
            </a>';
    }

    public function getKtpNarahubungLink()
    {
        if (!$this->ktp_narahubung) {
            return '<span class="text-muted">-</span>';
        }

        // sesuaikan path jika beda
        $url = asset('storage/' . $this->ktp_narahubung);

        return '<a href="' . $url . '" target="_blank" class="btn btn-xs btn-outline-primary">
                <i class="la la-id-card"></i> Lihat KTP
            </a>';
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

    public function getKategoriBadge()
    {
        switch ($this->kategori) {
            case 'perseorangan':
                return '<span class="badge badge-primary">Perseorangan</span>';

            case 'lembaga':
                return '<span class="badge badge-kategori-lembaga">Lembaga</span>';

            default:
                return '<span class="badge badge-light">-</span>';
        }
    }

    // RELASI UNTUK KEPERLUAN E-BLANGKO
    public function pernyataanKeberatan()
    {
        return $this->hasOne(
            PernyataanKeberatan::class,
            'permohonan_id',
            'id'
        );
    }

    public function sudahDirespon()
    {
        return in_array($this->status, ['diterima', 'ditolak']);
    }

    public function getAlamatLinkAttribute()
    {
        if (!$this->alamat_info) {
            return '-';
        }
        return '<a href="' . $this->alamat_info . '" target="_blank">' . $this->alamat_info . '</a>';
    }
}
