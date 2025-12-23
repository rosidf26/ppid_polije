<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PermohonanInformasiSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create('id_ID');

        $kategori_list = ['perseorangan', 'lembaga'];
        $sumber_info_list = ['pertanyaan', 'website', 'medsos'];
        $status_list = ['belum direspon', 'diterima', 'ditolak'];

        $info_list = [
            'Permohonan informasi keterbukaan publik',
            'Data kegiatan akademik',
            'Laporan anggaran tahunan',
            'Informasi kegiatan kampus',
            'Dokumen layanan publik',
            'Ringkasan laporan kegiatan',
        ];

        for ($i = 0; $i < 100; $i++) {

            $kategori = $faker->randomElement($kategori_list);
            $status = $faker->randomElement($status_list);

            // ===============================
            // TANGGAL PENGAJUAN
            // ===============================
            $tgl_pengajuan = Carbon::create(
                rand(2020, 2025),
                rand(1, 12),
                rand(1, 28)
            );

            // ===============================
            // LOGIKA RESPON
            // ===============================
            $tgl_direspon = null;
            $waktu_menjawab = null;
            $respon = null;

            if ($status !== 'belum direspon') {
                $waktu_menjawab = rand(1, 14);
                $tgl_direspon = (clone $tgl_pengajuan)->addDays($waktu_menjawab);
                $respon = $faker->sentence(8);
            }

            DB::table('permohonan_informasi')->insert([

                // ===== KATEGORI =====
                'kategori' => $kategori,

                // ===== PERSEORANGAN =====
                'nama_pemohon' => $kategori === 'perseorangan' ? $faker->name : null,
                'alamat_pemohon' => $kategori === 'perseorangan' ? Str::limit($faker->address, 255, '') : null,
                'hp_pemohon' => $kategori === 'perseorangan' ? $faker->numerify('08##########') : null,
                'email_pemohon' => $kategori === 'perseorangan' ? $faker->safeEmail : null,
                'ktp_pemohon' => $kategori === 'perseorangan'
                    ? 'ktp_pemohon/' . Str::random(15) . '.pdf'
                    : null,

                // ===== PENGGUNA INFORMASI =====
                'nama_pengguna' => $kategori === 'perseorangan' ? $faker->name : null,
                'alamat_pengguna' => $kategori === 'perseorangan' ? Str::limit($faker->address, 255, '') : null,
                'hp_pengguna' => $kategori === 'perseorangan' ? $faker->numerify('08##########') : null,
                'email_pengguna' => $kategori === 'perseorangan' ? $faker->safeEmail : null,
                'ktp_pengguna' => $kategori === 'perseorangan'
                    ? 'ktp_pengguna/' . Str::random(15) . '.pdf'
                    : null,

                // ===== LEMBAGA =====
                'nama_organisasi' => $kategori === 'lembaga' ? $faker->company : null,
                'telp_organisasi' => $kategori === 'lembaga' ? $faker->numerify('0###########') : null,
                'email_organisasi' => $kategori === 'lembaga' ? $faker->companyEmail : null,
                'medsos_organisasi' => $kategori === 'lembaga' ? '@' . Str::lower(Str::random(8)) : null,
                'nama_narahubung' => $kategori === 'lembaga' ? $faker->name : null,
                'telp_narahubung' => $kategori === 'lembaga' ? $faker->numerify('08##########') : null,
                'ktp_narahubung' => $kategori === 'lembaga'
                    ? 'ktp_narahubung/' . Str::random(15) . '.pdf'
                    : null,

                // ===== INFORMASI =====
                'info_dibutuhkan' => $faker->randomElement($info_list),
                'alasan_butuh' => $faker->paragraph(2),
                'sumber_info' => $faker->randomElement($sumber_info_list),
                'alamat_info' => $faker->boolean ? $faker->url : null,

                // ===== STATUS =====
                'status' => $status,
                'respon' => $respon,
                'tgl_pengajuan' => $tgl_pengajuan->toDateString(),
                'tgl_direspon' => $tgl_direspon ? $tgl_direspon->toDateString() : null,
                'waktu_menjawab' => $waktu_menjawab,

                // ===== SYSTEM =====
                'unik_request' => 'REQ-' . now()->format('YmdHis') . '-' . Str::upper(Str::random(6)),
                'created_at' => $tgl_pengajuan,
                'updated_at' => $tgl_direspon ?? $tgl_pengajuan,
            ]);
        }
    }
}
