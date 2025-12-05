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
        Schema::dropIfExists('pernyataan_keberatan');
    }
}
