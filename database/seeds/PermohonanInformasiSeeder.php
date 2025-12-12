<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PermohonanInformasiSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create();

        $kategori_list = ['perseorangan', 'lembaga'];
        $sumber_info_list = ['pertanyaan', 'website', 'medsos'];

        $info_list = [
            'Permohonan informasi keterbukaan publik',
            'Data kegiatan akademik',
            'Laporan anggaran tahunan',
            'Informasi kegiatan kampus',
            'Dokumen layanan publik',
            'Ringkasan laporan kegiatan',
        ];

        for ($i = 1; $i <= 100; $i++) {

            $kategori = $kategori_list[array_rand($kategori_list)];

            // Tahun random 2020 - 2025
            $created = Carbon::create(
                rand(2020, 2025),
                rand(1, 12),
                rand(1, 28),
                rand(7, 16),
                rand(0, 59),
                0
            );

            // Status acak
            $status = rand(0, 1) ? 'diterima' : 'belum direspon';

            // Jika diterima, generate lama menjawab
            $rerata = $status === 'diterima' ? rand(0, 10) : null;

            $updated = $status === 'diterima'
                ? $created->copy()->addDays($rerata)
                : $created;

            DB::table('permohonan_informasi')->insert([

                // -- KATEGORI --
                'kategori' => $kategori,

                // -- PERSEORANGAN --
                'nama_pemohon'   => $kategori === 'perseorangan' ? $faker->name : null,
                'alamat_pemohon' => $kategori === 'perseorangan' ? $faker->address : null,
                'hp_pemohon'     => $kategori === 'perseorangan' ? $faker->phoneNumber : null,
                'email_pemohon'  => $kategori === 'perseorangan' ? $faker->email : null,
                'ktp_pemohon'    => $kategori === 'perseorangan' ? 'ktp_' . Str::random(10) . '.pdf' : null,

                'nama_pengguna'   => $kategori === 'perseorangan' ? $faker->name : null,
                'alamat_pengguna' => $kategori === 'perseorangan' ? $faker->address : null,
                'hp_pengguna'     => $kategori === 'perseorangan' ? $faker->phoneNumber : null,
                'email_pengguna'  => $kategori === 'perseorangan' ? $faker->email : null,
                'ktp_pengguna'    => $kategori === 'perseorangan' ? 'ktp_' . Str::random(10) . '.pdf' : null,

                // -- LEMBAGA --
                'nama_organisasi'   => $kategori === 'lembaga' ? $faker->company : null,
                'telp_organisasi'   => $kategori === 'lembaga' ? $faker->phoneNumber : null,
                'email_organisasi'  => $kategori === 'lembaga' ? $faker->companyEmail : null,
                'medsos_organisasi' => $kategori === 'lembaga' ? '@' . Str::random(8) : null,
                'nama_narahubung'   => $kategori === 'lembaga' ? $faker->name : null,
                'telp_narahubung'   => $kategori === 'lembaga' ? $faker->phoneNumber : null,
                'ktp_narahubung'    => $kategori === 'lembaga' ? 'ktp_' . Str::random(10) . '.pdf' : null,

                // -- KEBUTUHAN INFORMASI --
                'info_dibutuhkan' => $info_list[array_rand($info_list)],
                'alasan_butuh'    => $faker->sentence(10),
                'sumber_info'     => $sumber_info_list[array_rand($sumber_info_list)],
                'alamat_info'     => $faker->address,

                // -- STATUS & WAKTU --
                'status'          => $status,
                'rerata_menjawab' => $rerata,

                'created_at'      => $created,
                'updated_at'      => $updated,
            ]);
        }
    }
}
