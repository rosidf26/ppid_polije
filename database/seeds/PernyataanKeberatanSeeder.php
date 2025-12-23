<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Faker\Factory as Faker;

class PernyataanKeberatanSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');

        // Ambil permohonan yang valid untuk keberatan
        $permohonanList = DB::table('permohonan_informasi')
            ->whereIn('status', ['diterima', 'ditolak'])
            ->get();

        $alasan_keberatan = [
            'permohonan informasi ditolak',
            'informasi berkala tidak disediakan',
            'permintaan informasi tidak ditanggapi',
            'permintaan informasi ditanggapi tidak sebagaimana yang diminta',
            'permintaan informasi tidak dipenuhi',
            'biaya yang dikenakan tidak wajar',
            'informasi disampaikan melebihi jangka waktu yang ditentukan',
        ];

        $status_list = ['belum direspon', 'diterima', 'ditolak'];

        foreach ($permohonanList as $permohonan) {

            // ±40% permohonan membuat keberatan (realistis)
            if (!$faker->boolean(40)) {
                continue;
            }

            // =========================
            // TANGGAL PENGAJUAN
            // =========================
            $tgl_pengajuan = Carbon::parse(
                $permohonan->tgl_direspon ?? $permohonan->tgl_pengajuan ?? $permohonan->created_at
            )->addDays(rand(1, 7));

            // =========================
            // STATUS KEBERATAN
            // =========================
            $status = $faker->randomElement($status_list);

            $tgl_direspon = null;
            $waktu_menjawab = null;
            $respon = null;

            if ($status !== 'belum direspon') {
                $waktu_menjawab = rand(1, 14);
                $tgl_direspon = (clone $tgl_pengajuan)->addDays($waktu_menjawab);
                $respon = $faker->sentence(12);
            }

            DB::table('pernyataan_keberatan')->insert([
                // =========================
                // RELASI
                // =========================
                'permohonan_id' => $permohonan->id,

                // =========================
                // IDENTITAS
                // =========================
                'nama_pemohon' => $permohonan->nama_pemohon
                    ?? $permohonan->nama_narahubung
                    ?? $faker->name,
                'pekerjaan_pemohon' => $faker->jobTitle,
                'nama_kuasa_pemohon' => $faker->boolean(20) ? $faker->name : null,

                // =========================
                // SUBSTANSI
                // =========================
                'alasan_keberatan' => $faker->randomElement($alasan_keberatan),
                'kasus_posisi' => $faker->paragraph(3),

                // =========================
                // STATUS & RESPON
                // =========================
                'status' => $status,
                'respon' => $respon,

                // =========================
                // WAKTU
                // =========================
                'tgl_pengajuan' => $tgl_pengajuan->toDateString(),
                'tgl_direspon' => $tgl_direspon ? $tgl_direspon->toDateString() : null,
                'waktu_menjawab' => $waktu_menjawab,

                // =========================
                // SYSTEM
                // =========================
                'unik_request' => 'KB-' . now()->format('YmdHis') . '-' . Str::upper(Str::random(6)),
                'created_at' => $tgl_pengajuan,
                'updated_at' => $tgl_direspon ?? $tgl_pengajuan,
            ]);
        }
    }
}
