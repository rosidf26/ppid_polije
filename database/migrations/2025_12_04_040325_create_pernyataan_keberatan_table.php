<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePernyataanKeberatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pernyataan_keberatan', function (Blueprint $table) {
            $table->id();
            // RELASI WAJIB
            $table->unsignedBigInteger('permohonan_id');

            $table->string('nama_pemohon');
            $table->string('pekerjaan_pemohon')->nullable();
            $table->string('nama_kuasa_pemohon')->nullable();

            $table->enum('alasan_keberatan', [
                'permohonan informasi ditolak',
                'informasi berkala tidak disediakan',
                'permintaan informasi tidak ditanggapi',
                'permintaan informasi ditanggapi tidak sebagaimana yang diminta',
                'permintaan informasi tidak dipenuhi',
                'biaya yang dikenakan tidak wajar',
                'informasi disampaikan melebihi jangka waktu yang ditentukan'
            ]);

            $table->text('kasus_posisi')->nullable();
            // STATUS & RESPON
            $table->enum('status', [
                'belum direspon',
                'diterima',
                'ditolak'
            ])->default('belum direspon');

            $table->text('respon')->nullable();

            // WAKTU PENANGANAN
            // Tanggal resmi pengajuan
            $table->date('tgl_pengajuan')
                ->nullable()
                ->comment('Tanggal resmi permohonan diajukan');

            // Tanggal permohonan direspon PPID
            $table->date('tgl_direspon')
                ->nullable()
                ->comment('Tanggal permohonan direspon');

            $table->integer('waktu_menjawab')
                ->nullable()
                ->comment('Jumlah hari');

            $table->string('unik_request', 50)->nullable()->unique();

            $table->timestamps();

            // FOREIGN KEY
            $table->foreign('permohonan_id')
                ->references('id')
                ->on('permohonan_informasi')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pernyataan_keberatan');
    }
}
