<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermohonanInformasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permohonan_informasi', function (Blueprint $table) {
            $table->id();
            // -----------------------------
            // KATEGORI PEMOHON
            // -----------------------------
            $table->enum('kategori', ['perseorangan', 'lembaga']);

            // -------------------------------------------------
            // DATA PERSEORANGAN (NULL JIKA KATEGORI = LEMBAGA)
            // -------------------------------------------------
            $table->string('nama_pemohon', 150)->nullable();
            $table->string('alamat_pemohon', 255)->nullable();
            $table->string('hp_pemohon', 20)->nullable();
            $table->string('email_pemohon', 150)->nullable();
            $table->string('ktp_pemohon', 255)->nullable(); // path file

            // -------------------------------------------------
            // DATA PENGGUNA INFORMASI (opsional)
            // -------------------------------------------------
            $table->string('nama_pengguna', 150)->nullable();
            $table->string('alamat_pengguna', 255)->nullable();
            $table->string('hp_pengguna', 20)->nullable();
            $table->string('email_pengguna', 150)->nullable();
            $table->string('ktp_pengguna', 255)->nullable();

            // -------------------------------------------------
            // DATA LEMBAGA (NULL JIKA KATEGORI = PERSEORANGAN)
            // -------------------------------------------------
            $table->string('nama_organisasi', 150)->nullable();
            $table->string('telp_organisasi', 20)->nullable();
            $table->string('email_organisasi', 150)->nullable();
            $table->string('medsos_organisasi', 255)->nullable();

            // -------------------------------------------------
            // DATA NARAHUBUNG LEMBAGA
            // -------------------------------------------------
            $table->string('nama_narahubung', 150)->nullable();
            $table->string('telp_narahubung', 20)->nullable();
            $table->string('ktp_narahubung', 255)->nullable();

            // -------------------------------------------------
            // INFORMASI PERMOHONAN (WAJIB SEMUA)
            // -------------------------------------------------
            $table->text('info_dibutuhkan');
            $table->text('alasan_butuh');

            $table->enum('sumber_info', ['pertanyaan', 'website', 'medsos']);
            $table->string('alamat_info', 255)->nullable();

            // timestamps
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permohonan_informasi');
    }
}
